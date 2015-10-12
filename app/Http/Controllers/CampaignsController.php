<?php

namespace Publishers\Http\Controllers;

use Illuminate\Http\Request;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;
use Auth;
use Publishers\Campaign;

class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO consultar db con user id y solo9 traer campañas correspondientes
        //Auth::user()->_id

        $campaigns = Campaign::all();
        $campaigns[1]->status="pending";
        $campaigns[2]->status="rejected";
        $campaigns[3]->status="ended";
        $campaigns[4]->status="canceled";

        $campaigns[4]->name="Encuesta fb";

        $campaigns[0]->company="Coca-cola";
        $campaigns[1]->company="Biozoo";
        $campaigns[2]->company="Peisi";
        $campaigns[3]->company="Enera";
        $campaigns[4]->company="Facebook xD";

        $campaigns[2]->action="mailing_list";
        $campaigns[3]->action="captcha";
        $campaigns[4]->action="survey";
/*
        $campaigns[] = $campaigns[0];
        $campaigns[] = $campaigns[1];
        $campaigns[] = $campaigns[2];
        $campaigns[] = $campaigns[3];
        $campaigns[] = $campaigns[4];

        $campaigns[] = $campaigns[0];
        $campaigns[] = $campaigns[1];
        $campaigns[] = $campaigns[2];
        $campaigns[] = $campaigns[3];
        $campaigns[] = $campaigns[4];*/

        return view('campaigns.index',compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
