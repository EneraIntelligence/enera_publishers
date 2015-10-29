<?php

namespace Publishers\Http\Controllers;

use Illuminate\Http\Request;
use Publishers\Campaign;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;
use Auth;
use Publishers\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $this->user = Auth::user();
        $all = Campaign::where('client_id', '55846348a826cafe2f905bc1')->limit(10)->get();
        $active = Campaign::where('administrator_id', Auth::user()->_id)->where('status' , 'active')->count();
        $closed = Campaign::where('administrator_id', Auth::user()->_id)->where('status' , 'closed')->count();
        $canceled = Campaign::where('administrator_id', Auth::user()->_id)->where('status' , 'canceled')->count();
        return view('profile.index', ['user' => Auth::user(), 'all' => $all, 'active' => $active, 'closed' => $closed, 'canceled' => $canceled]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
//     * @param  int  $id
     * @return Response
     */
    public function edit()
    {
//        $this->user = Auth::user();
        return view('profile.edit', ['user' => Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    public function charts()
    {
        $this->user = Auth::user();
        $campaigns = Campaign::where('client_id', Auth::user()->id)->where('status' , 'active')->count();
        $closed = Campaign::where('client_id', Auth::user()->id)->where('status' , 'closed')->count();
        $canceled = Campaign::where('client_id', Auth::user()->id)->where('status' , 'canceled')->count();
        $all = Campaign::where('client_id')->get();
        return view('profile.charts', ['user' => Auth::user(), 'campaign' => $campaigns, 'closed' => $closed, 'canceled' => $canceled, 'all' => $all]);
    }

    public function editProfile($data)
    {   $hola = \Input::get('user_edit_uname_control');
        $respuesta = array("suscces" => $hola);
        return json_encode($respuesta);
    }
}
