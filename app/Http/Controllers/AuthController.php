<?php

namespace Publishers\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;
use Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function login()
    {
        $validator = Validator::make(Input::all(), [
            'email' => 'required|email|min:6|max:250',
            'password' => 'required|alphanum|min:8|max:16',
        ]);
        if ($validator->passes()) {
            if (auth()->attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {
                return redirect()->route('home');
            } else {
                return redirect()->route('auth.index')->with('error', 'El correo y/o la contraseña es incorrecta.');
            }
        } else {
            return redirect()->route('auth.index')->withErrors($validator);
        }
    }
}
