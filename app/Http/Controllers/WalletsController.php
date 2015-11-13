<?php

namespace Publishers\Http\Controllers;

use Illuminate\Http\Request;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;

class WalletsController extends Controller
{
    /**
     * Muestra los fondos en la cuenta y los movimiento recientes
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('wallets.index');
    }


}
