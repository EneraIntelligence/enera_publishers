<?php

namespace Publishers\Http\Controllers;

use Illuminate\Http\Request;
use Publishers\Administrator;
use Publishers\Campaign;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;
use Auth;
use Input;
use Redirect;
use Storage;
use Publishers\Branche;
use Publishers\Item;
use Publishers\Libraries\FileCloud;

//use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $all = Campaign::where('client_id', Auth::user()->_id)->limit(10)->get();
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

        $campaigns = Campaign::where('client_id', Auth::user()->id)->where('status' , 'active')->count();
        $closed = Campaign::where('client_id', Auth::user()->id)->where('status' , 'closed')->count();
        $canceled = Campaign::where('client_id', Auth::user()->id)->where('status' , 'canceled')->count();
        $all = Campaign::where('client_id')->get();
        return view('profile.charts', ['user' => Auth::user(), 'campaign' => $campaigns, 'closed' => $closed, 'canceled' => $canceled, 'all' => $all]);
    }

    public function editProfile(){

        $user = Administrator::where('_id', Auth::user()->_id)->first();
        $user->name = (object) array('first' => ucwords(Input::get('name')), 'last' => ucwords(Input::get('lastname')));
        $user->phones = (object)array('number' => Input::get('phone'), 'type' => ucwords(Input::get('type')));
        $user->socialnetwork = (object) array('facebook' => Input::get('facebook'), 'twitter' => Input::get('twitter'), 'googleplus' => Input::get('google'), 'linkedin' => Input::get('linkedin'));
        $user->save();

//        para la foto del usuario
        $filesystem = new FileCloud();
        $file = Input::file('user_edit_avatar_control');
        if($file && $file->isValid() && $this->correct_size($file))
        {
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move(storage_path().'/app',$filename);

            //get uploaded file and copy it to cloud
            $uploadedFile = Storage::get($filename);
            $fileSaved = $filesystem->put($filename, $uploadedFile );
            //delete server file
            Storage::delete($filename);
        }else
        {
            if(!$file->isValid())
                return 'error! no file uploaded';
            if(!$file->isValid())
                return 'error! File not valid';
            if(!$this->correct_size($file))
                return 'error! File size must be 100x100';
        }


        return redirect()->action('UserController@index');
//        return $user;
    }


    private function correct_size($photo)
    {
        $maxHeight = 100;
        $maxWidth = 100;
        list($width, $height) = getimagesize($photo);
        return ( ($width <= $maxWidth) && ($height <= $maxHeight) );
    }
}
