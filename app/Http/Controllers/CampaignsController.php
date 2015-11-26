<?php

namespace Publishers\Http\Controllers;

use DateTime;
use MongoDate;
use Publishers\CampaignLog;
use Publishers\Libraries\CampaignStyleHelper;
use Validator;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Sftp\SftpAdapter;
use League\Flysystem\Filesystem;
use Input;
use Illuminate\Http\Request;
use Auth;
use Publishers\Campaign;
use Publishers\Branche;
use Publishers\Item;
use Publishers\Subcampaign;
use Publishers\Libraries\FileCloud;
use Mail;

class CampaignsController extends Controller
{

    public function  __construct()
    {
        $this->filecloud = new FileCloud();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Obteniendo campañas del user loggeado
        //$admin_id = Auth::user()->_id;
        //$campaigns = Campaign::where('status', 'active')->latest()->get();

        //CityBranchesScript::saveCityBranches();

        $campaigns = Auth::user()->campaigns()->latest()->get();

        return view('campaigns.index', ['campaigns' => $campaigns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('campaigns');
        } else {
            $campaignName = $request->get('name');

            //get branches data
            $branches = Branche::all();
//          $branches = Branche::where('accept_ads', true)->get();

            $noCreateBtn = true;

            return view('campaigns.create', compact('branches', 'noCreateBtn', 'campaignName'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $res = array("success"=>false);
            echo json_encode($res);
        }
        else
        {
            $name = $request->get('name');

            redirect('campaigns/new?name='.$name);
            $res = array("success"=>true);
            echo json_encode($res);

        }*/


        //Image to sftp code  ---->

        $filesystem = new FileCloud();

        $file = Input::file('image');

        if ($file && $file->isValid() && $this->correct_size($file)) {
            //set newly generated filename and upload to server storage
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move(storage_path() . '/app', $filename);

            //get uploaded file and copy it to cloud
            $uploadedFile = Storage::get($filename);
            $fileSaved = $filesystem->put($filename, $uploadedFile);
            //delete server file
            Storage::delete($filename);

            //creating campaign
            $campaign = new Campaign();
            $campaign->administrator_id = Auth::user()->_id;
            $campaign->client_id = "???";//TODO tomar esto
            $campaign->name = "test " . time();//TODO tomar de input
            $campaign->branches = [];
            $campaign->filters = (object)array();
            $campaign->interaction = (object)array('name' => "banner");
            $campaign->content = (object)array('image' => $filename);
            $campaign->status = "pending";
            $campaign->save();

            //created item related to campaign
            $item = new Item();
            $item->filename = $filename;
            $item->administrator_id = Auth::user()->_id;
            $item->type = 'image';
            $item->campaign_id = $campaign->_id;
            $item->save();

            return "File " . $filename . " saved: " . $fileSaved;
        } else {
            if (!$file->isValid())
                return 'error! no file uploaded';
            if (!$file->isValid())
                return 'error! File not valid';
            if (!$this->correct_size($file))
                return 'error! File size must be 100x100';
        }


    }

    public function mailing($id)
    {
        $campaign = Campaign::find($id); //busca la campaña

        if ($campaign && $campaign->administrator_id == auth()->user()->_id) {
            //the user can manage the campaign:

            return view('campaigns.mailing', array("campaign_id" => $id));//, compact('branches', 'noCreateBtn', 'campaignName'));

        } else {
            //not the user's campaign
            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
        }
    }

    public function sendMailing(Request $request)
    {
        //TODO falta validar campaña con usuario

        $campaign_id = Input::get("campaign_id");

        $campaign = Campaign::find($campaign_id); //get the campaign

        if( !isset($campaign->mailing_list) || count($campaign->mailing_list)<=0 )
        {
            //no mails on the campaign mailing list
            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
        }

        if ($campaign && $campaign->administrator_id == auth()->user()->_id)
        {

            //the user can manage the campaign

            //getting input fields
            $from = Input::get("from");
            $from_mail = Input::get("from_mail");
            $subject = Input::get("subject");
            $content = Input::get("content");

            //save subcampaign on DB
            $subCampaign = new Subcampaign();
            $subCampaign->campaign_id=$campaign_id;
            $subCampaign->from=$from;
            $subCampaign->from_mail=$from_mail;
            $subCampaign->subject=$subject;
            $subCampaign->content=$content;
            $subCampaign->save();

            //setup mail data
            $mail = array(
                "from"=>$from,
                "from_mail"=>$from_mail,
                "subject"=>$subject,
                "content"=>$content
            );

            Mail::send('emails.test', ['content' => $mail["content"]], function ($m) use ($mail) {
                $m->from($mail["from_mail"], $mail["from"]);

                //TODO tomar mails de campaña y mandar a todos
                $m->to("me@ederdiaz.com", "Eder")->subject($mail["subject"]);
            });

            //TODO mostrar vista de subcampaña
            return "mail enviado!"; //view('campaigns.create', compact('branches', 'noCreateBtn', 'campaignName'));

        }
        else
        {
            //not the user's campaign
            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
        }
    }

    /**
     * @param Request $request
     */
    public function saveItem(Request $request)
    {
        //echo "{success: 'true'}";


        if (Input::get("imgToSave") == ".banner-1") {
            //saving small image
            $file = Input::file('image_small');
            $imageType = "small";
        } else {
            //saving large image
            $file = Input::file('image_large');
            $imageType = "large";

        }


        $fc = new FileCloud();

        //$file = Input::file('image');

        //if ($file && $file->isValid() && $this->correct_size($file)) {
        if ($file && $file->isValid()) {
            //set newly generated filename and upload to server storage
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move(storage_path() . '/app', $filename);

            //get uploaded file and copy it to cloud
            $uploadedFile = Storage::get($filename);
            $fileSaved = $fc->put($filename, $uploadedFile);
            //delete server file
            Storage::delete($filename);

            //created item related to campaign
            $item = new Item();
            $item->filename = $filename;
            $item->administrator_id = Auth::user()->_id;
            $item->type = 'image';
            //$item->campaign_id = $campaign->_id;
            $item->save();

            $res = array('success' => true, 'filename' => $filename, 'item_id' => $item->_id, 'imageType' => $imageType);

            echo json_encode($res);

        } else {
            $res = array('success' => false, 'msg' => 'error');
            /*
            if (!$file->isValid())
                echo 'error! no file uploaded';
            if (!$file->isValid())
                echo 'error! File not valid';
            if (!$this->correct_size($file))
                echo 'error! File size must be 100x100';*/

            echo json_encode($res);
        }


    }

    private
    function correct_size($photo)
    {
        $maxHeight = 100;
        $maxWidth = 100;
        list($width, $height) = getimagesize($photo);
        return (($width <= $maxWidth) && ($height <= $maxHeight));
    }

    /**
     * Display the specified resource.
     * Muestra la información de una campaña
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->genderAge($id);

        $campaign = Campaign::find($id); //busca la campaña

        if ($campaign && $campaign->administrator_id == auth()->user()->_id) {

            //este arreglo se usa para poder convertir los numeros de los dias a letras
            $semana = array(0 => '', 1 => 'lunes', 2 => 'martes', 3 => 'miércoles', 4 => 'jueves', 5 => 'viernes', 6 => 'sabado', 7 => 'domingo');

            $imagen = $this->filecloud->getImagen('image.png');

            /******     saca el color y el icono que se va a usar regresa un array  ********/
            //$sColor = new StatusColor();
            $color = [];
            $color['icon'] = CampaignStyleHelper::getStatusIcon($campaign->status);
            $color['color'] = CampaignStyleHelper::getStatusColor($campaign->status);


            /****  conversion de fechas de segundos a formato Y-m-d  ****/
//            $campaign['filters']['date']['start'] = date('Y-m-d', $campaign['filters']['date']['start']->sec);
//            $campaign['filters']['date']['end'] = date('Y-m-d', $campaign['filters']['date']['end']->sec);

            /****  OBTENER PORCENTAJE DEL TIEMPO TRANSCURRIDO ****/
            $start = new DateTime(date('Y-m-d H:i:s', $campaign->filters['date']['start']->sec));
            $end = new DateTime(date('Y-m-d H:i:s', $campaign->filters['date']['end']->sec));

            switch ($campaign->status) {
                case 'pending':
                    $porcentaje = 0.0;
                    break;
                case 'rejected':
                    $porcentaje = 0.0;
                    break;
                case 'ended':
                    $ended = new DateTime($campaign->history->where('status', 'ended')->first()->date);
                    $total = $start->diff($end);
                    $diff = $start->diff($ended);
                    $porcentaje = $diff->format('%a') / $total->format('%a');
                    break;
                case 'active':
                    $today = new DateTime();
                    $total = $start->diff($end);
                    $diff = $start->diff($today);
                    $porcentaje = $diff->format('%a') / $total->format('%a');
                    break;
                case 'canceled':
                    $canceled = new DateTime($campaign->history->where('status', 'canceled')->first()->date);
                    $total = $start->diff($end);
                    $diff = $start->diff($canceled);
                    $porcentaje = $diff->format('%a') / $total->format('%a');
                    break;
            }

            $campaign->porcentaje = $porcentaje;
            return view('campaigns.show', [$campaign, 'cam' => $campaign]);
        } else {
            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $id
     * @return mixed
     */
    private function genderAge($id)
    {   //        $today =date( "Y-m-d",mktime(0, 0, 0, date("m"),date("d")-5, date("Y")));
        //se obtiene de los logs los usuarios de 5 dias atras
        $log=array();
        $fecha = new MongoDate(strtotime("-5 days"));
        $a=$fecha->toDateTime();
        $fecha = $a->setTime(0,0,0) ;
        $Logs = CampaignLog::groupBy('user')->where('campaign_id',$id)
            ->where('updated_at', '>', $fecha)->get(array('user'));
        if($Logs==null){
            return null;
        }else{
            $Logs=$Logs->toArray();
            foreach ($Logs as $clave => $valor) {
                var_dump($valor['user']);
                $log['users'][$clave]['gender'] =$valor['user']['gender'];
                $Log['users'][$clave]['age'] =$valor['user']['age'];
            }
        }

//        dd($log);
        return $Log;
    }

}
