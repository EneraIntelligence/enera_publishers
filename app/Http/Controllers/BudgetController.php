<?php

namespace Publishers\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = auth()->user();
        return view('budget.index', [
            'admin' => $admin,
            'movements' => $admin->movements,
            'campaigns' => $admin->campaigns,
        ]);
    }


    public function deposits()
    {
        $admin = auth()->user();
        return view('budget.deposits', [
            'admin' => $admin,
            'movements' => $admin->movements,
            'campaigns' => $admin->campaigns,
        ]);
    }

    public function invoices($id)
    {
//        validar que el invoice sea valido y exista
        return view('budget.invoices', ['user' => Auth::user()]);
    }
}
