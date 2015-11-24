<?php

namespace Publishers\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', ['user' => Auth::user()]);
    }
}
