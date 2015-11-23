<?php

namespace Publishers\Http\Controllers;

use DateTime;
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
use Publishers\Libraries\FileCloud;

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

        if ($campaign && $campaign->administrator_id == auth()->user()->_id)
        {
            //the user can manage the campaign:

            return view('campaigns.mailing');//, compact('branches', 'noCreateBtn', 'campaignName'));

        }
        else {
            //not the user's campaign
            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
        }
    }

    public function sendMailing(Request $request)
    {
        //Input::get("mail");
    }

    public function saveItem(Request $request)
    {
        //echo "{success: 'true'}";


        if (Input::get("imgToSave") == ".banner-1") {
        {
            //saving small image
            $file = Input::file('image_small');
            $imageType = "small";
        } else {
            //saving large image
            $file = Input::file('image_large');
            $imageType = "large";

        }


        $fc = new FileCloud();
        $filesystem = $fc->filesystem;

        //$file = Input::file('image');

        //if ($file && $file->isValid() && $this->correct_size($file)) {
        if ($file && $file->isValid()) {
            //set newly generated filename and upload to server storage
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move(storage_path() . '/app', $filename);

            //get uploaded file and copy it to cloud
            $uploadedFile = Storage::get($filename);
            $fileSaved = $filesystem->put($filename, $uploadedFile);
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

            /****  SACAR PORCENTAJE DEL TIEMPO TRANSCURRIDO ****/
            switch ($campaign->status) {
                case 'pending':
                    $porcentaje = 0;
                    break;
                case 'rejected':
                    $porcentaje = 0;
                    break;
                case 'ended':
                    $porcentaje = 100;
                    break;
                case 'active':
                    $porcentaje = 0;
                    break;
                case 'canceled':
                    $canceled = new DateTime($campaign->history->where('status', 'canceled')->first()->date);
                    $created = new DateTime(date('Y-m-d H:i:s', $campaign->filters['date']['start']->sec));
                    $today = new DateTime();

                    // %R coloca signo ( + )
                    // %a obtienes los dias
                    // $dif2->format('%a')
                    $dif1 = $created->diff($canceled);
                    $dif2 = $created->diff($today);

                    $porcentaje = 0;
                    break;
            }

            $canceled = new DateTime($campaign->history->where('status', 'canceled')->first()->date);
            $created = new DateTime(date('Y-m-d H:i:s', $campaign->filters['date']['start']->sec));
            $today = new DateTime();
            $dif1 = $created->diff($canceled);
            $dif2 = $created->diff($today);



            //si tiene uno de estos estados el avance sera 0% aunque creo que ended deberia de ser 100%
            if ($campaign['status'] == 'pending' || $campaign['status'] == 'rejected' || $campaign['status'] == 'ended') {//si tiene uno de estos estados no deberia tener avance
                $porcentaje = ['porcentaje' => (0)];
                //si es activa o cancelada se calculara el tiempo que lleva
            } elseif ($campaign['status'] == 'active' || $campaign['status'] == 'canceled') {//si es activa o canceled se muestra el avanze
                $total = abs((strtotime($campaign['filters']['date']['start']) - strtotime($campaign['filters']['date']['end'])) / 86400); //obtengo el total de dias
                //      total es = al total de dias entre el inicio y la fecha final
                if ($campaign['status'] == 'canceled') { //si esta cancelada saco la fecha de cuando fue cancelada

                    //$log = $campaign->logs()->where('status','canceled')->first();

                    $logs = $campaign['log'];//saco el array de logs para buscar en el, el log de cancelado
                    foreach ($logs as $log => $content) { //recorro el arreglo
                        //                    var_dump ($content);
                        if ($content['status'] == 'canceled') {//busco el log de cancelado para sacar la fecha
                            $hoy = date('Y-m-d', $content['date']->sec);//se calculan los dias transcurridos
                            //                        echo $hoy.'<br>';
                        }//fin del if canceled
                    }//fin del foreach
                } else {//si no es cancelada esta activa y saco la fecha de hoy para calcular el tiempo trancurrido
                    $hoy = date('Y-m-d');//obtengo la fecha de hoy
                }//fin el else
                //se calculan los dias transcurridos asta la fecha de hoy
                $astahoy = abs((strtotime($campaign['filters']['date']['start']) - strtotime($hoy)) / 86400);//se obtiene los dias asta el dia de hoy
                //        echo 'asta hoy'.$astahoy.'<br>';
                //se hace una regla de 3 para sacar el porcentaje de los dias transcurridos
                $porcentaje = ($astahoy * 100) / $total; //obtengo el porcentaje de avance
            }
//        echo 'porcentaje : '.$porcentaje['porcentaje'].'<br>';
            /** la librería que se usa para hacer la animación del circulo del porcentaje recibe un parametro que solo llega asta el 1.0 que es el 100% por eso hago una conversion para que no falle **/
            if ($porcentaje >= 100) {
                $porcentaje = ['porcentaje' => '1.0'];//si es 100% pues lo paso a 1.0 que es el 100% de la libreria
            } else {
                $porcentaje = round($porcentaje, 1, PHP_ROUND_HALF_UP);//redondeo a un decimal
                $porcentaje = (string)$porcentaje;
                $porcentaje = str_replace('.', '', $porcentaje); //le quito el punto y se lo pongo al inicio para asi si es 80 queda en .80 y queda listo para la animacion del circulo
                $porcentaje = ['porcentaje' => '.' . $porcentaje];//lo guardo en array para poder llamarlo mas facil en la vista
            }
            //se queda pendiente ended asta que se desida si se va a usar o no
            /*elseif($campaign['status']== 'ended'){ //si esta terminada
                    echo '<br> porcentage = 100% estado: '.$campaign['status'].'<br>';
                }*/

            /****  conversion de dias, convierte los numeros a letras ****/
            foreach ($campaign['filters']['week_days'] as $clave => $dia) {
                if (array_key_exists($dia, $semana)) {
                    $campaign['filters']['week_days'][$clave] = $semana[$dia];
                }
            }

            /****  conversion de horas ****/
            $rangoH = count($campaign['filters']['day_hours']);
            $horas = $campaign['filters']['day_hours'][0] . ' a ' . $campaign['filters']['day_hours'][$rangoH - 1];
            $campaign['filters']['day_hours'] = $horas;

            /******     se juntan los array  para mandar solo uno  ********/
            //$campaign = array_merge($campaign, $color, $porcentaje, $imagen);
//        dd($campaign);
            return view('campaigns.show', $campaign);
        } else {
            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
//            return redirect()->action('CampaignsController@index')->with('data', 'error');
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
}
