<?php

namespace Publishers\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;
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
        return redirect()->route('auth.index');
    }
}
