<?php

namespace Publishers\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Hash;
use Input;
use Mail;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;
use Publishers\Jobs\newAdminJob;
use Publishers\ValidationCode;
use Publishers\Administrator;
use Validator;
use Publishers\Role;

class AuthController extends Controller
{
    /**
     * Vista del formulario
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('auth.index');
    }

    /**
     * Recepcion y comprobacion de usuario y contraseña
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function login()
    {
        $validator = Validator::make(Input::all(), [
            'email' => 'required|email|min:6|max:250',
            'password' => 'required|alpha_num|min:8|max:16',
        ]);
        if ($validator->passes()) {
            $admin = Administrator::where('email', Input::get('email'))->first();
            if ($admin && $admin->status == 'active') {
                if (auth()->attempt(['email' => Input::get('email'), 'password' => Input::get('password'), 'status' => 'active'], Input::get('login_page_stay_signed'))) {
                    return redirect()->route('home');
                } else {
                    return redirect()->route('auth.index')->with('error', 'El correo y/o la contraseña son incorrectos.');
                }
            } elseif ($admin && $admin->status != 'active') {
                return redirect()->route('auth.index')->with('error', 'Debe validar su cuenta antes de ingresar.');
            } else {
                return redirect()->route('auth.index')->with('error', 'El correo y/o la contraseña son incorrectos.');
            }
        } else {
            return redirect()->route('auth.index')->withErrors($validator);
        }
    }

    /**
     * Salir del sistema
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route('auth.index')->with('registro', 'no');
    }

    /**
     *
     */
    public function signUp()
    {
        // TODO: Encontrar la forma de seleccionar idioma en global
        // App::setLocale('es');

        $validator = Validator::make(Input::all(), [
//            'nombre' => array('regex:[^[a-zA-Z]+$|\s*[a-zA-Z]$]'),
            'nombre' => array('regex:[^([a-zA-Z ñáéíóú]{2,60})$]'),
            'apellido' => array('regex:[^([a-zA-Z ñáéíóú]{2,60})$]'),
            'email' => 'required|email|max:250',
            'password' => 'required|alpha_num|min:8|max:16',
//            'estado' => 'required|max:250|alpha',
//            'ciudad' => 'required|max:250|alpha'
        ]);
        /**     despues de las validaciones    **/
        if ($validator->passes()) {
            $confirmation_code = md5(Input::get('email'));
            $password = Hash::make(Input::get('password')); //encrypta la contraseña
            /***+*****   verifico si el correo esta registrado     *************/
            if (Administrator::where('email', Input::get('email'))->count() > 0) {
                $validator->errors()->add('email', 'este correo ya esta registrado');
                return redirect()->route('auth.register')->withErrors($validator);
            } else {
                /***+*****  consulta que guarda el usuario, documento en mongo *************/
                $newAdmin = Administrator::create(array(
                    'name' => [
                        'first' => Input::get('nombre'),
                        'last' => Input::get('apellido')
                    ],
                    'email' => Input::get('email'),
                    'password' => $password,
                    'rol_id' => Role::where('name', 'Usuario Externo')->first()->_id,
                    'client_id' => 0,
                    'status' => 'pending',
                    'giftcards' => [],
                ));
                //se agrega el wallet
                $newAdmin->wallet()->create(['current' => 0]);
                /**********      si el usuario se creo se manda  el correo de confirmacion        ***************/
                if ($newAdmin) {    //se crea el registro del token para mandarlo con el correo
                    $Token = ValidationCode::create(array(
                        'administrator_id' => $newAdmin->id, 'type' => 'validationEmail', 'token' => $confirmation_code
                    ));
                    if ($Token->count() > 0) {
//                        echo 'se guardo la tabla de token';
                        //se manda correo de confirmacion
                        $data=[
                            'session' => session('_token'),
                            'nombre' => Input::get('nombre'),
                            'apellido' => Input::get('apellido'),
                            'email' => Input::get('email'),
                            'id_usuario' => $newAdmin->id,
                            'confirmation_code' => $confirmation_code
                        ];
                        $correo = Input::get('email');
                        $nombre = Input::get('nombre');
                        Mail::send('emails.verify', ['data' => $data], function ($message) use ($correo, $nombre) {
                            $message->from('notificacion@enera.mx', 'Enera Intelligence');
                            $message->to($correo, $nombre)->subject('Confirmacion de registro');
                        });

                        return redirect()->route('auth.register')->with('success', 'registro-success');
                    } else {  //valida si se guardo el token
                        $validator->errors()->add('registro', 'no se pudo enviar correo de confirmacion');
                        return redirect()->route('auth.register')->withErrors($validator);
                    }
                } else {  //fin del if que valida si se creo el usuario para mandar el correo
                    $validator->errors()->add('registro', 'no se pudo completar el registro intenta mas tarde');
                    return redirect()->route('auth.register')->withErrors($validator);
                }
            }//fin del else que valida si el correo ya esta registrado
        } else {
//            $registro='error';
            $validator->errors()->add('registro', 'error');
            return redirect()->route('auth.register')->withErrors($validator);
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function verify($id, $token) //verifica los codigos que llegan
    {
        $code = ValidationCode::where('token', $token)->first();// busco el codigo en la base de datos
        if ($code != null && $code->count() > 0) //si el codigo exite
        {
            if ($code->administrator_id == $id) //verifico si el token es el mismo
            {
                $tipo = $code->type;
                /*** se compara que tipo de codigo es   ***/
                switch ($tipo) {
                    case 'resetPassword':
                        $data['id'] = $id;
                        $data['token'] = $token;
                        return redirect()->route('auth.newpassword')->with('data', $data);
                        break;
                    case 'validationEmail':
                        $admin = Administrator::find($id);
                        if ($admin && $admin->status != 'active') {
                            $admin->status = 'active';   //cambio el status de pending a active
                            $admin->save();
                            /**    se agrega el historial de cuando se cambio a activo     **/
                            $admin->history()->create(array('previous_status' => 'pending'));
                            /**    se borra el validation code     **/
                            $code->delete();
                            //  se regresa al login con mensaje de que se activo cuenta
                            return redirect()->route('auth.index')->with('data', 'active');
                        } else {
                            return redirect()->route('auth.index')->with('data', 'invalido');
                        }
                        break;
                    default:
                        return redirect()->route('auth.index')->with('data', 'invalido');
                        break;
                }
            } else {
                /*echo 'codigo no valido';
                dd($code);*/
                return redirect()->route('auth.index')->with('data', 'invalido');
            }
        } else {
            return redirect()->route('auth.index')->with('data', 'invalido');
        }

    }

    public function restore()   //manda correo para recuperar contraseña
    {
        $validator = Validator::make(Input::all(), [
            'reset_password_email' => 'required|email|max:250'
       ]);

        if ($validator->passes()) {
            $admin = Administrator::where('email', Input::get('reset_password_email'))->first();
            if ($admin != null) {
                if ($admin && $admin->status == 'active') {
                    $confirmation_code = md5(Input::get('reset_password_email')).date('Ymdhms');
                    $data['correo'] = $admin->email;
                    $data['nombre'] = $admin->name['first'];
                    $data['apellido'] = $admin->name['last'];
                    $data['session'] = session('_token');
                    $data['id_usuario'] = $admin->_id;
                    $data['confirmation_code'] = $confirmation_code;
                    $correo = $admin->email;
                    $nombre = $admin->name['first'];
                    $Token = ValidationCode::create(array(
                        'administrator_id' => $admin->_id, 'type' => 'resetPassword', 'token' => $confirmation_code
                    ));

                    Mail::send('emails.resetpass', ['data' => $data], function ($message) use ($correo, $nombre) {
                        $message->from('notificacion@enera.mx', 'Enera Intelligence');
                        $message->to($correo, $nombre)->subject('Recuperacion de contraseña');
                    });
                    return redirect()->route('auth.index')->with('reset_msg2', 'se a enviado un mail a tu correo: <strong>' . Input::get('reset_password_email') . '</strong> . Para restablecer la contraseña');
                } else if ($admin && $admin->status == 'pending') {
                    return redirect()->route('auth.index')->with('reset_msg2', 'la cuenta <strong>' . Input::get('reset_password_email') . '</strong> no se ha activado todavía. por favor activa tu cuenta primero ');
                }
            } else {
                return redirect()->route('auth.index')->with('reset_msg2', 'se a enviado un mail a tu correo: <strong>' . Input::get('reset_password_email') . '</strong> . Para restablecer la contraseña');
            }
        } else {
            return redirect()->route('auth.index')->withErrors($validator);
        }
    }

    public function newpassword() //vista solo valida, si no traes variables te regresa a login
    {
        $data = session('data');
        if ($data != null || session('cc') != null) {
            return view('auth.newpassword')->with('data', $data);
        } else {
            $status = 'Introduce la dirección de correo electrónico que usaste para crear la cuenta';
        }
        return redirect()->route('auth.index')->with('reset_msg', $status);
    }

    public function newpass() //post recibe la nueva contraseña y la pone
    {
        $validator = Validator::make(Input::all(), [
            'password' => 'required|alpha_num|min:8|max:16',
            'confirma_contraseña' => 'required|alpha_num|min:8|max:16',
            'u' => 'required',
            't' => 'required'
        ]);

        if ($validator->passes()) {
            $new = Hash::make(Input::get('password'));
            $admin = Administrator::where('_id', Input::get('u'))->first();
            if ($admin != null) {
                $admin->password = $new;
                $admin->save();
                /**    se agrega el historial de cuando se cambio a activo     **/
                $admin->history()->create(array('previous_status' => 'cambio de contraseña'));
                /**    se borra el validation code     **/
                $code = ValidationCode::where('token', Input::get('t'))->first();// busco el codigo en la base de datos y lo borro
                $code->delete();
                return redirect()->route('auth.index')->with('reset_msg2', 'se ha cambiado la contraseña');
            } else {
                return redirect()->route('auth.index')->with('data', 'invalido');
            }
        } else {
            return redirect()->route('auth.index')->with('data', 'invalido');
        }

    }

    public function remove()
    {
        echo Input::get('id').'<br>';
        if (Input::get('id') != null) {
            echo 'si trae datos';

            $tokens = ValidationCode::where('administrator_id', Input::get('id'))->get();// busco el codigo en la base de datos y lo borro
            foreach ($tokens as $k => $v) { //se recorre el arreglo con todos los tokens que alla creado y se borran
                $tokens[$k]->delete();
            }
//            $tokens = ValidationCode::where('administrator_id', Input::get('id'))->get();
            return redirect()->route('auth.index')->with('reset_msg2', 'tu solicitud de cancelacion se ha procesado');
        } else {
            echo 'no trae datos';
            return redirect()->route('auth.index');
        }
    }

    public function terms()
    {
        return view('dashboard.terms', [
            'hideTermsFooter'=>true
        ]);
    }

}
