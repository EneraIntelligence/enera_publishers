<?php

namespace Publishers\Http\Controllers;

use DateTime;
use MongoDate;
use Publishers\CampaignLog;
use Publishers\Jobs\EmailJob;
use Publishers\Jobs\mailingJob;
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

    public function __construct()
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
        $subcampaigns = Auth::user()->subcampaigns()->latest()->get();

        return view('campaigns.index', ['campaigns' => $campaigns, 'subcampaigns' => $subcampaigns, 'user' => Auth::user()]);
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

            $user = Auth::user();

            return view('campaigns.create', compact('branches', 'noCreateBtn', 'campaignName', 'user'));
        }

    }

    /**
     * Obtiene los datos y crea una campaña con estatus "pendiente"
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function store()
    {
//        sleep(30);
//        dd(Input::all());
        $validator = Validator::make(Input::all(), [
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'time' => 'required',
            'days' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'images' => 'required',
            'ubication' => 'required',
            'interactionId' => 'required',
            /* condicionales */
            'from' => 'required_if:interactionId,mailing-list',
            'from_mail' => 'required_if:interactionId,mailing-list',
            'subject' => 'required_if:interactionId,mailing-list',
            'mailing_content' => 'required_if:interactionId,mailing-list',
            'survey' => 'required_if:interactionId,survey',
            'captcha' => 'required_if:interactionId,captcha',
            'video' => 'required_if:interactionId,video',
            'branches' => 'required_if:ubication,select',
        ]);
        if ($validator->passes()) {
            if ($camp = Campaign::create([
                'client_id' => isset(auth()->user()->client_id) ? auth()->user()->client_id : '0',
                'administrator_id' => auth()->user()->_id,
                'name' => Input::get('title'),
                'branches' => Input::get('ubication') == 'all' ? 'all' : Input::get('branches'),
                'interaction' => [
                    'name' => Input::get('interactionId'),
                ],
                'filters' => [
                    'age' => explode(';', Input::get('age')),
                    'date' => [
                        'start' => new MongoDate(strtotime(Input::get('start_date'))),
                        'end' => new MongoDate(strtotime(Input::get('end_date')))
                    ],
                    'gender' => Input::get('gender') == 'both' ? ['male', 'female'] : [Input::get('gender')],
                    'week_days' => Input::get('days'),
                    'day_hours' => range(explode(';', Input::get('time'))[0], explode(';', Input::get('time'))[1]),
                ],
                'content' => [
                    'items' => Input::get('images'),
                    'images' => [
                        'small' => Input::has('images.small') ? Item::find(Input::get('images.small'))->filename : null,
                        'large' => Input::has('images.large') ? Item::find(Input::get('images.large'))->filename : null,
                        'survey' => Input::has('images.survey') ? Item::find(Input::get('images.survey'))->filename : null,
                    ],
                    'mail' => [
                        'from_name' => Input::get('from'),
                        'from_mail' => Input::get('from_mail'),
                        'subject' => Input::get('subject'),
                        'content' => Input::get('mailing_content'),
                    ],
                    'survey' => $this->storeSurvey(Input::get('survey')),
                    'captcha' => Input::get('captcha'),
                    'video' => Input::get('video'),
                ],
                'status' => 'pending',
            ])
            ) {
                Mail::send('emails.creation', ['camp' => $camp], function ($m) use ($camp) {
                    $m->from('notificacion@enera.mx', 'Enera Intelligence');
                    $m->to('darkdreke@gmail.com', 'Notificaciones')->subject('Camapaña creada');
                });

                return response()->json([
                    'ok' => true,
                    'id' => $camp->_id
                ]);
            } else {
                return response()->json([
                    'ok' => false,
                    'msg' => 'No fue posible guardar la información.'
                ]);
            }
        } else {
            return response()->json([
                'ok' => false,
                'msg' => 'Uno o más datos no son validos.'
            ]);
        }
    }

    private function storeSurvey($survey)
    {
        return 'HOLA';
    }

    public function mailing($id, Request $request)
    {
        $campaign = Campaign::find($id); //busca la campaña

        if ($campaign && $campaign->administrator_id == auth()->user()->_id) {
            //the user can manage the campaign:

            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->route('campaigns::index')->with('data', 'errorCamp');
            } else {
                $campaignName = $request->get('name');
                return view('campaigns.mailing', array("campaign_id" => $id, "campaign_name" => $campaignName, 'user' => Auth::user()));
            }


        } else {
            //not the user's campaign
            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
        }
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|string
     */
    public function sendMailing(Request $request)
    {
        $campaign_id = Input::get("campaign_id");


        $validator = Validator::make(Input::all(), [
            'campaign_name' => 'required',
            'from_mail' => 'required|email',
            'from' => 'required',
            'subject' => 'required',
            'content' => 'required'
        ]);

        if ($validator->passes()) {

            $campaign = Campaign::find($campaign_id); //get the campaign
            $mail = $campaign->mailing_list;
            $campaign_id = $campaign->_id;
            if (!isset($campaign->mailing_list) || count($campaign->mailing_list) <= 0) {
                //no mails on the campaign mailing list
                return redirect()->route('campaigns::index')->with('data', 'NoMail');
            }

            if ($campaign && $campaign->administrator_id == auth()->user()->_id) {

                //the user can manage the campaign

                //getting input fields
                $admin_id = Input::get("admin_id");
                $from = Input::get("from");
                $campaign_name = Input::get("campaign_name");
                $from_mail = Input::get("from_mail");
                $subject = Input::get("subject");
                $content = Input::get("content");

                $data = compact('admin_id', 'from', 'campaign_name', 'from_mail', 'subject', 'content', 'mail', 'campaign_id');
                $this->dispatch(new MailingJob($data));


                //save subcampaign on DB
//                $subCampaign = new Subcampaign();
//                $subCampaign->administrator_id = $admin_id;
//                $subCampaign->campaign_id = $campaign_id;
//                $subCampaign->name = $campaign_name;
//                $subCampaign->from = $from;
//                $subCampaign->from_mail = $from_mail;
//                $subCampaign->subject = $subject;
//                $subCampaign->content = $content;
//                $subCampaign->save();
//
//                //setup mail data
//                $mail = array(
//                    "from" => $from,
//                    "from_mail" => $from_mail,
//                    "subject" => $subject,
//                    "content" => $content
//                );
//
//                Mail::send('emails.test', ['content' => $mail["content"]], function ($m) use ($mail) {
//                    $m->from($mail["from_mail"], $mail["from"]);
//
//                    //TODO tomar mails de campaña y mandar a todos
//                    $m->to("ederchrono@gmail.com", "Eder")->subject($mail["subject"]);
//                });

                //TODO mostrar vista de subcampaña
                return redirect()->route('campaigns::index')->with('data', 'send');; //view('campaigns.create', compact('branches', 'noCreateBtn', 'campaignName'));

            } else {
                //not the user's campaign
                return redirect()->route('campaigns::index')->with('data', 'errorCamp');
            }
        } else {
            return redirect()->route('campaigns::mailing', ["id" => Input::get("campaign_id"), "name" => Input::get("campaign_name")])->withErrors($validator)->withInput(Input::old());
        }
    }

    /**
     * @param Request $request
     */
    public function saveItem(Request $request)
    {
        //echo "{success: 'true'}";


        if (Input::get("imgType") == ".banner-1") {
            //saving small image
            $img = Input::get('imgToSave');
            $imageType = "small";
        } else if (Input::get("imgType") == ".banner-2") {
            //saving large image
            $img = Input::get('imgToSave');
            $imageType = "large";

        } else if (Input::get("imgType") == ".banner-survey") {

            $img = Input::get('imgToSave');
            $imageType = "survey";
        } else {
            $res = array('success' => false, 'msg' => 'error with image type');
            echo $res;
        }

        //transforming string to image file
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $filename = time() . ".png";

        //transferring file to storage
        $file = storage_path() . '/app/' . $filename;
        $success = file_put_contents($file, $data);

        //compress png to jpg
        $png = $file;
        $filename = time() . ".jpg";
        $file = storage_path() . '/app/' . $filename;
        $image = imagecreatefrompng($png);
        imagejpeg($image, $file, 90);
        imagedestroy($image);


        if ($success) {
            //image copied to server successfully
            $fc = new FileCloud();

            //get uploaded file and copy it to cloud
            $uploadedFile = Storage::get($filename);
            $fileSaved = $fc->put(time() . ".jpg", $uploadedFile);
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
            $res = array('success' => false, 'msg' => 'error saving cropped image on storage');
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

    public function subcampaign($id)
    {
        $subcampaign = Subcampaign::find($id); //busca la campaña

        if ($subcampaign && $subcampaign->administrator_id == auth()->user()->_id) {
            return view('campaigns.subcampaign', [$subcampaign, 'cam' => $subcampaign, 'user' => Auth::user()]);
        } else {
            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
        }
    }

    /**
     * Display the specified resource.
     * Muestra la información de una campaña
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $this->genderAge($id);

        $campaign = Campaign::find($id); //busca la campaña

        if ($campaign && $campaign->administrator_id == auth()->user()->_id) {
//            dd($campaign);
            //este arreglo se usa para poder convertir los numeros de los dias a letras
            $semana = array(0 => '', 1 => 'lunes', 2 => 'martes', 3 => 'miércoles', 4 => 'jueves', 5 => 'viernes', 6 => 'sabado', 7 => 'domingo');

            $imagen = $this->filecloud->getImagen('image.png');

            /******     saca el color y el icono que se va a usar regresa un array  ********/
            //$sColor = new StatusColor();
            $color = [];
            $color['icon'] = CampaignStyleHelper::getStatusIcon($campaign->status);
            $color['color'] = CampaignStyleHelper::getStatusColor($campaign->status);
//            dd($color);

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
//            dd($porcentaje);
            $campaign->porcentaje = $porcentaje;
//            dd($campaign);
            return view('campaigns.show', [$campaign, 'cam' => $campaign, 'user' => Auth::user()]);
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
    {
        echo 'entro en la grafica';
        // Obtiene de los logs los usuarios de 5 dias atras
        $log = array();
        $fecha = new MongoDate(strtotime("-5 days"));
        $a = $fecha->toDateTime();
        $fecha = $a->setTime(0, 0, 0);
        $logs = CampaignLog::groupBy('user')->where('campaign_id', $id)
            ->where('updated_at', '>', $fecha)->get(array('user'));
        if ($logs == null) {
            echo 'no encontro nada';
            $log['error']=['error'];
        } else {
            echo 'encontro algo';
            $Logs = $logs->toArray();
            dd($logs);
            foreach ($Logs as $clave => $valor) {
                $log['users'][$clave]['age'] = $valor['user']['age'];
//                var_dump($log['users'][$clave]['age']);
                $log['users'][$clave]['gender'] = $valor['user']['gender'];
//                var_dump($log['users'][$clave]['gender']);
            }
        }
        dd($log);
        return $log;
    }

    public function deposits()
    {

        return view('campaigns.deposits');
    }

}
