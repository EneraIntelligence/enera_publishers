<?php

namespace Publishers\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use League\Flysystem\Sftp\SftpAdapter;
use League\Flysystem\Filesystem;
use Input;
use Illuminate\Http\Request;
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
        //colors and style vars
        $status_values = array(
            'active'=>'1',
            'pending' => '2',
            'ended' => '3',
            'close' => '3',
            'rejected' => '4',
            'canceled' => '5'
        );

        $status_colors = array(
            'active'=>'uk-text-success',
            'pending'=>'uk-text-primary',
            'rejected'=>'uk-text-danger',
            'ended'=>'md-color-blue-900',
            'close'=>'md-color-blue-900',
            'canceled'=>'md-color-grey-500'
        );

        $campaign_icons = array(
            ''=>'picture_in_picture',
            'banner'=>'picture_in_picture',
            'video'=>'ondemand_video',
            'mailing_list'=>'mail',
            'captcha'=>'spellcheck',
            'survey'=>'assignment'
        );

        //Obteniendo campañas del user loggeado
        $admin_id = Auth::user()->_id;
        $campaigns = Campaign::where('administrator_id', $admin_id)->latest()->get();


        //hardcoded testing data
        /*
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

        $campaigns[] = new Campaign();
        $campaigns[6]->_id = "1";
        $campaigns[6]->status = "active";
        $campaigns[6]->name = "Mails DQ";
        $campaigns[6]->company = "Dairy Queen";
        $campaigns[6]->action = "mailing_list";

        $campaigns[] = new Campaign();
        $campaigns[7]->_id = "2";
        $campaigns[7]->status = "pending";
        $campaigns[7]->name = "adivina la marca";
        $campaigns[7]->company = "Nike";
        $campaigns[7]->action = "captcha";
        */

        return view('campaigns.index',compact('campaigns','campaign_icons', 'status_colors', 'status_values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $adapter = new SftpAdapter([
            'host' => '192.241.236.240',
            'port' => 22,
            'username' => 'forge',
            'password' => '9X0I9k3EFgYIejMRT0T8',
            'privateKey' => 'c:/Users/Eder/key',
            'root' => '/home/forge/prueba',
            'timeout' => 10,
            'directoryPerm' => 0755
        ]);

        $filesystem = new Filesystem($adapter);

        $file = Input::file('image');

        if($file->isValid())
        {
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move(storage_path().'/app',$filename);

            $uploadedFile = Storage::get($filename);

            $fileSaved = $filesystem->put($filename, $uploadedFile );

            Storage::delete($filename);

            return "File ". $filename ." saved: ".$fileSaved;
        }
        else
        {
            return 'error! File not valid';
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = Campaign::find($id);
        $campaign = $campaign['original'];
//        dd($campaign);
        return view('campaigns.show',compact('campaign'));
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
