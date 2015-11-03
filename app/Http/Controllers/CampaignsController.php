<?php

namespace Publishers\Http\Controllers;

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
use Publishers\Libraries\FileCloud;
use Publishers\Libraries\StatusColor;


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
            'active' => '1',
            'pending' => '2',
            'ended' => '3',
            'close' => '3',
            'rejected' => '4',
            'canceled' => '5'
        );

        $status_colors = array(
            'active' => 'uk-text-success',
            'pending' => 'uk-text-primary',
            'rejected' => 'uk-text-danger',
            'ended' => 'md-color-blue-900',
            'close' => 'md-color-blue-900',
            'canceled' => 'md-color-grey-500'
        );

        $campaign_icons = array(
            '' => 'picture_in_picture',
            'banner' => 'picture_in_picture',
            'video' => 'ondemand_video',
            'mailing_list' => 'mail',
            'captcha' => 'spellcheck',
            'survey' => 'assignment'
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

        return view('campaigns.index', compact('campaigns', 'campaign_icons', 'status_colors', 'status_values'));
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

    private function correct_size($photo)
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
        //este arreglo se usa para poder convertir los numeros de los dias a letras
        $semana = array(0=>'',1=>'lunes',2=>'martes',3=>'miércoles',4=>'jueves',5=>'viernes',6=>'sabado',7=>'domingo');
        $campaign = Campaign::find($id); //busca la campaña
        $campaign = $campaign['original']; //se obtiene solo los datos que nos importan
        //        dd($campaign);
        /******     saca el color y el icono que se va a usar regresa un array  ********/
        $sColor = new StatusColor();
        $color = $sColor->getIconColor($campaign['status']);
//        dd($color);
        /******     manejo de los filtros   ********/
        /******     convierte de inglés a español el genero   ********/
        //si nomas tiene un genero agrego el otro vacio para que no truene la vista
        if (count($campaign['filters']['gender']) == 1) {
            if ($campaign['filters']['gender'][0] == 'male') { //para cambiarle los generos a español
                $campaign['filters']['gender'][0] = 'Hombre';
            } elseif ($campaign['filters']['gender'][0] = 'female') {
                $campaign['filters']['gender'][0] = 'Mujer';
            }
        } else {
            if ($campaign['filters']['gender'][0] == 'male') { //para cambiarle los generos a español
                $campaign['filters']['gender'][0] = 'Hombre';
                $campaign['filters']['gender'][1] = 'Mujer';
            } elseif ($campaign['filters']['gender'][0] = 'female') {
                $campaign['filters']['gender'][0] = 'Mujer';
                $campaign['filters']['gender'][1] = 'Hombre';
            }
        }//fin del if genero

            /****  conversion de fechas de segundos a formato Y-m-d  ****/
        $campaign['filters']['date']['start']= date('Y-m-d', $campaign['filters']['date']['start']->sec);
        $campaign['filters']['date']['end']= date('Y-m-d', $campaign['filters']['date']['end']->sec);

        /****  SACAR PORCENTAJE DEL TIEMPO QUE LLEVA ****/
        if($campaign['status']=='pending'||$campaign['status']=='rejected'||$campaign['status']=='ended'){//si tiene uno de estos estados no deberia tener avance
//            echo '<br> porcentage sera = 0  estado: '.$campaign['status'];
        }elseif($campaign['status']=='active'||$campaign['status']=='canceled'){//si es activa o canceled se muestra el avanze
            $total = abs((strtotime($campaign['filters']['date']['start']) - strtotime($campaign['filters']['date']['end']))/86400); //obtengo el total de dias
//            echo '<br> total'.$total.'<br>';   //total es = a la diferencia entre el inicio y la fecha final
            if($campaign['status']=='canceled'){ //si esta cancelada saco la fecha
                $logs= $campaign['logs'];//saco el cntenido de logs para poder manejar los datos
                foreach($logs as $log => $conten){ //recorro el arreglo
//                    echo '<br> clave: '.$log;
//                    var_dump ($conten);
                    if($conten['status'] == 'canceled'){//busco el log de cancelado para sacar la fecha
                        $hoy = date('Y-m-d', $conten['date']->sec);//obtengo la fecha en que fue cancelada la campaña
//                        echo $hoy.'<br>';
                    }
                }
            }else{
                $hoy = date ('Y-m-d');//obtengo la fecha de hoy
            }
//        echo 'hoy'.$hoy.'<br>';
            $astahoy = abs((strtotime($campaign['filters']['date']['start']) - strtotime($hoy))/86400);//se obtiene los dias asta el dia de hoy
//        echo 'asta hoy'.$astahoy.'<br>';
            $porcentaje=['porcentaje'=> ($astahoy*100)/$total]; //obtengo el porcentaje de avance
//        echo 'porcentaje : '.$porcentaje['porcentaje'].'<br>';
        }
        //se queda pendiente ended asta que se desida si se va a usar o no
        /*elseif($campaign['status']== 'ended'){ //si esta terminada
            echo '<br> porcentage = 100% estado: '.$campaign['status'].'<br>';
        }*/

        /****  conversion de dias, convierte los numeros a letras ****/
        foreach($campaign['filters']['week_days'] as  $clave => $dia){
            if(array_key_exists($dia , $semana )){
                $campaign['filters']['week_days'][$clave]=$semana[$dia];
            }
        }

        /****  conversion de horas ****/
        $rangoH=count($campaign['filters']['day_hours']);
        $horas=$campaign['filters']['day_hours'][0].' a '.$campaign['filters']['day_hours'][$rangoH-1];
        $campaign['filters']['day_hours']=$horas;

        /******     se juntan los array  para mandar solo uno  ********/
        $campaign = array_merge($campaign, $color,$porcentaje);
//        dd($campaign);
        return view('campaigns.show', $campaign);
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
}
