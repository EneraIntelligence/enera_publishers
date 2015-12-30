<?php

namespace Publishers\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Hash;
use Input;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;
use Publishers\Jobs\newAdminJob;
use Publishers\ValidationCode;
use Publishers\Administrator;
use Validator;

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
            if (auth()->attempt(['email' => Input::get('email'), 'password' => Input::get('password')], Input::get('login_page_stay_signed'))) {
                return redirect()->route('home');
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
        App::setLocale('es');
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
//            $confirmation_code = str_random(30);
            $confirmation_code = Hash::make(Input::get('email'));
//            $data['aleatorio'] = uniqid(); //Genera un id único para identificar la cuenta a traves del correo.
            $password = Hash::make(Input::get('password')); //encrypta la contraseña
/***+*****  consulta que guarda el documento en mongo *************/
            $newAdmin= Administrator::create(array('name' => ['first' => Input::get('nombre'), 'last' => Input::get('apellido')],
                'email' => Input::get('email'), 'password' => $password,
                'rol_id' => 'usuario', 'status' => 'pending'
            ));
            //                'location'=>['country'=>'mexico','state'=>Input::get('estado'),'city'=>Input::get('ciudad')],

//            dd($newAdmin);
/********** si el usuario se creo se llama el job para mandarle el correo de confirmacion ***************/
            if($newAdmin){
                echo 'se guardo el usuario';
                $Token = validationCode::create(array(
                    'administrator_id'=> $newAdmin->_id,'type'=>'validationEmail', 'token'=>$confirmation_code
                ));
                if($Token->count() > 0){
                    echo 'se guardo la tabla de token';
                }
                //se  crea un array con los datos que se ocupan para formar el correo
                $data['nombre']=Input::get('nombre');
                $data['apellido']=Input::get('apellido');
                $data['email']=Input::get('email');
                $data['id_usuario']=$newAdmin->_id;  //usuario
                $data['confirmation_code']=$confirmation_code;  //codigo generado para validar el correo
//                dd($data);
                //se llama el job mandar correo confirmacion
                $this->dispatch(new newAdminJob([
                    'session' => session('_token'),
                    $data
                ]));
                return redirect()->route('auth.index')->with('success', 'registro-success');
            }
        } else {
            return redirect()->route('auth.index')->withErrors($validator);
        }
    }

    public function register()
    {
        return redirect()->route('auth.index')->with('registro', 'registrar');
    }

    public function verify($id,$token)
    {
        echo 'verificando <br>';
        $code = ValidationCode::where('administrator_id','=',$id)->first();// busco el codigo en la base de datos
        if($code->count() > 0){ //si se encuentra el usuario
            if($code->token==$token){  //verifico si el token es el mismo
                $admin= Administrator::where('_id','=',$id)->first();
                $admin->status = 'active';   //cambio el status de pending a active
                $admin->save();
                //  se regresa al login con mensaje de que se activo cuenta
                return redirect()->route('auth.index')->with('data', 'active');
            }else{
                return redirect()->route('auth.index')->with('data','invalido');
            }
        }else{
            return redirect()->route('auth.index')->with('data','invalido');
        }
//        return 'verificando';

    }
}
