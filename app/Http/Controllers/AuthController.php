<?php

namespace Publishers\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Hash;
use Input;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;
use Validator;
use Publishers\Administrator;

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
        return redirect()->route('auth.index');
    }

    /**
     *
     */
    public function signUp()
    {
//        dd(Input::all());
        App::setLocale('es');
        $validator = Validator::make(Input::all(), [
//            'nombre' => array('regex:[^[a-zA-Z]+$|\s*[a-zA-Z]$]'),
            'nombre' => array('regex:[^([a-z ñáéíóú]{2,60})$]'),
            'apellido' => array('regex:[^([a-z ñáéíóú]{2,60})$]'),
            'email' => 'required|email|max:250',
            'password' => 'required|alpha_num|min:8|max:16',
//            'estado' => 'required|max:250|alpha',
//            'ciudad' => 'required|max:250|alpha'
        ]);
/**     despues de las validaciones    **/
        if ($validator->passes()) {
            $password = Hash::make(Input::get('password')); //encrypta la contraseña
//            dd($password);
//  consulta que guarda el documento en mongo
            Administrator::create(array('name' => ['first' => Input::get('nombre'), 'last' => Input::get('apellido')],
                'email' => Input::get('email'), 'password' => $password,
//                'location'=>['country'=>'mexico','state'=>Input::get('estado'),'city'=>Input::get('ciudad')],
                'rol_id' => 'usuario', 'status' => 'block'
            ));
//            echo 'se guardo';
            return redirect()->route('auth.index')->with('success', 'registro-success');
        } else {
            return redirect()->route('auth.index')->withErrors($validator);
        }
        /*echo Input::get('register_name');
        echo Input::get('register_apellido');
        echo Input::get('register_email');
        echo Input::get('register_password');
        echo Input::get('register_password_repeat');
        echo Input::get('register_Estado');
        echo Input::get('register_munucipio');
        dd('hola prueba');*/
    }
}
