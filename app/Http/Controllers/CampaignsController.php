<?php

namespace Publishers\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use DB;
use MongoDate;
use Publishers\AdministratorMovement;
use Publishers\CampaignLog;
use Publishers\Interaction;
use Publishers\Jobs\MailCreationJob;
use Publishers\Jobs\mailingJob;
use Publishers\Libraries\CampaignStyleHelper;
use Publishers\Libraries\EneraTools;
use Validator;
use Storage;
use League\Flysystem\Sftp\SftpAdapter;
use League\Flysystem\Filesystem;
use Input;
use Illuminate\Http\Request;
use Auth;
use Publishers\Campaign;
use Publishers\Branche;
use Publishers\Item;
use Publishers\Subcampaign;
use Mail;

class CampaignsController extends Controller
{

    public function __construct()
    {
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
        $grafica = array();
        $dias['porcentaje'] = 0;
        $dias['total'] = 0;
        $campaigns = Auth::user()->campaigns()->where('status', '<>', 'filed')->where('status', '<>', 'rejected')->latest()->get();
        $subcampaigns = Auth::user()->subcampaigns()->where('status', '<>', 'filed')->latest()->get();

        /****  for each para sacar los datos de cada campaña   ****/
        foreach ($campaigns as $campaign => $valor) {
//            dd($valor) ;
            /****  OBTENER PORCENTAJE DEL TIEMPO TRANSCURRIDO DE LA CAMPAÑA ****/
            $start = new DateTime(date('Y-m-d H:i:s', $valor->filters['date']['start']->sec));
            $end = new DateTime(date('Y-m-d H:i:s', $valor->filters['date']['end']->sec));
            $start->setTime(00, 00, 00);
            $end->setTime(00, 00, 00);
            if ($valor->status == 'active') {
                $today = new DateTime();
                if ($today < $start) {// si a fecha de hoy es menor a la de inicio el porcentaje tambien es 0
                    $dias['porcentaje'] = 0;
                    $total = $start->diff($end);
                    $dias['total'] = $total->format('%a');
                } else {
                    $total = $start->diff($end);  //total de dias que deveria estar activo inicio - fin
                    $diff = $start->diff($today); //total de dias hasta hoy  inicio - hoy
                    $dias['total'] = $total->format('%a') - $diff->format('%a'); //guardo el total de dias
                    $dias['porcentaje'] = round(($diff->format('%a') * 100) / $total->format('%a'), 0, PHP_ROUND_HALF_EVEN);
                }//fin del else que verifica si la fecha de inicio es menor a hoy
            } else {//si la campaña no esta activa el porcentaje es 0
                $dias['porcentaje'] = 0;
                $dias['total'] = 0;
            }

            $id = $valor->_id;
            /**************************   DATOS DE LA GRAFICA    ****************************/
            $rangoFechas = array();//inicialiso el arreglo de las fechas
            for ($i = 0; $i < 7; $i++) {
                $a = new DateTime("-$i days");
                $b = new  DateTime("-$i days");
                $rangoFechas[$i]['inicio'] = $a->setTime(0, 0, 0);
                $rangoFechas[$i]['fin'] = $b->setTime(23, 59, 59);
                $graficat['dia' . ($i + 1)]['fecha'] = $a->format('Y-m-d');//guardo la fecha de los dias que se sacan para mostrarlos en la grafica
            }

            $graficat['dia1']['num'] = CampaignLog::where('campaign_id', $id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[0]['inicio'])->where('updated_at', '<', $rangoFechas[0]['fin'])->count();
            $graficat['dia2']['num'] = CampaignLog::where('campaign_id', $id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[1]['inicio'])->where('updated_at', '<', $rangoFechas[1]['fin'])->count();
            $graficat['dia3']['num'] = CampaignLog::where('campaign_id', $id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[2]['inicio'])->where('updated_at', '<', $rangoFechas[2]['fin'])->count();
            $graficat['dia4']['num'] = CampaignLog::where('campaign_id', $id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[3]['inicio'])->where('updated_at', '<', $rangoFechas[3]['fin'])->count();
            $graficat['dia5']['num'] = CampaignLog::where('campaign_id', $id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[4]['inicio'])->where('updated_at', '<', $rangoFechas[4]['fin'])->count();
            $graficat['dia6']['num'] = CampaignLog::where('campaign_id', $id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[5]['inicio'])->where('updated_at', '<', $rangoFechas[5]['fin'])->count();
            $graficat['dia7']['num'] = CampaignLog::where('campaign_id', $id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[6]['inicio'])->where('updated_at', '<', $rangoFechas[6]['fin'])->count();

            $grafica[$campaign] = $graficat;
        }//FIN DEL FOR
//dd($grafica);
        return view('campaigns.index', ['campaigns' => $campaigns, 'grafica' => $grafica, 'dias' => $dias, 'subcampaigns' => $subcampaigns, 'user' => Auth::user()]);
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
            //$branches = Branche::all();
            $branches = Branche::where('status', 'active')->where('filters.external_ads', true)->get();

            $noCreateBtn = true;

            $user = Auth::user();

            $interactions = Interaction::all();
            $price=[];
            foreach($interactions as $k=>$item)
            {
                $price[$item->name] = $item->amount;
            }
            //dd($prices);

            return view('campaigns.create', compact('branches', 'noCreateBtn', 'campaignName', 'user', 'price'));
        }

    }

    /**
     * Obtiene los datos y crea una campaña con estatus "pendiente"
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function store()
    {
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
            'budget' => 'required',
            /* condicionales */
            'banner_link' => 'required_if:interactionId,like',
            'from' => 'required_if:interactionId,mailing_list',
            'from_mail' => 'required_if:interactionId,mailing_list',
            'subject' => 'required_if:interactionId,mailing_list',
            'mailing_content' => 'required_if:interactionId,mailing_list',
            'survey' => 'required_if:interactionId,survey',
            'captcha' => 'required_if:interactionId,captcha',
            'video' => 'required_if:interactionId,video',
            'branches' => 'required_if:ubication,select',
        ]);
        if ($validator->passes()) {
            $budget = EneraTools::Getfloat(Input::get('budget'));
            if ($budget > 99) {
                if (auth()->user()->wallet->current >= $budget) {
                    $pre = EneraTools::Getfloat(auth()->user()->wallet->current);
                    auth()->user()->wallet->decrement('current', $budget);
                    if (($pre - $budget) == auth()->user()->wallet->current) {
                        $move = auth()->user()->movements()->create([
                            'client_id' => auth()->user()->client_id,
                            'movement' => [
                                'type' => 'outcome',   //income, outcome
                                'concept' => 'new_campaign',
                                'from' => 'balance',
                                'to' => 'campaign',
                            ],
                            'reference_id' => '',
                            'reference_type' => '',
                            'amount' => $budget,
                            'balance' => ($pre - $budget),
                        ]);
                        if ($move) {
                            if ($camp = Campaign::create([
                                'client_id' => isset(auth()->user()->client_id) ? auth()->user()->client_id : '0',
                                'administrator_id' => auth()->user()->_id,
                                'name' => Input::get('title'),
                                'branches' => Input::get('ubication') == 'all' ? 'all' : Input::get('branches'),
                                'balance' => [
                                    'init' => $budget,
                                    'current' => $budget,
                                ],
                                'interaction' => [
                                    'name' => Input::get('interactionId'),
                                    'price' => floatval(Interaction::where('name', Input::get('interactionId'))->first()->amount),
                                ],
                                'filters' => [
                                    'age' => array_map('intval', explode(';', Input::get('age'))),
                                    'date' => [
                                        'start' => new MongoDate(strtotime(Input::get('start_date'))),
                                        'end' => new MongoDate(strtotime(Input::get('end_date')))
                                    ],
                                    'gender' => Input::get('gender') == 'both' ? ['male', 'female'] : [Input::get('gender')],
                                    'week_days' => array_map('intval', Input::get('days')),
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
                                        'from_name' => Input::has('from') ? Input::get('from') : null,
                                        'from_mail' => Input::has('from_mail') ? Input::get('from_mail') : null,
                                        'subject' => Input::has('subject') ? Input::get('subject') : null,
                                        'content' => Input::has('mailing_content') ? Input::get('mailing_content') : null,
                                    ],
                                    'survey' => Input::has('survey') ? $this->storeSurvey(Input::get('survey')) : null,
                                    'captcha' => Input::get('captcha'),
                                    'video' => Input::get('video'),
                                    'like_url' => (Input::get('interactionId') == 'like') ? Input::get('banner_link') : null,
                                    'banner_link' => (Input::get('interactionId') == 'banner_link') ? Input::get('banner_link') : null,
                                ],
                                'status' => 'pending',
                            ])
                            ) {
                                $move->reference_id = $camp->_id;
                                $move->reference_type = 'Campaign';

                                $this->dispatch(new MailCreationJob($camp));

//                                Mail::send('emails.creation', ['camp' => $camp], function ($m) use ($camp) {
//                                    $m->from('servers@enera.mx', 'Enera Publisher');
//                                    $m->to('contacto@enera.mx', 'Notificaciones')->subject('Campaña creada');
//                                });

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
                            auth()->user()->wallet->increment('current', $budget);
                            return response()->json([
                                'ok' => false,
                                'msg' => 'No fue posible el registro de movimientos.'
                            ]);
                        }

                    } else {
                        auth()->user()->wallet->increment('current', $budget);
                        return response()->json([
                            'ok' => false,
                            'msg' => 'No cuentas con los fondos suficientes. (A)'
                        ]);
                    }

                } else {
                    return response()->json([
                        'ok' => false,
                        'msg' => 'No cuentas con los fondos suficientes. (B)'
                    ]);
                }
            } else {
                return response()->json([
                    'ok' => false,
                    'msg' => 'Debes de asignar por lo menos $100 MXN'
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
        $salida = [];
        foreach ($survey as $k => $v) {
            $salida['q' . ($k + 1)]['question'] = $v['question'];
            foreach ($v['answers'] as $kk => $vv) {
                $salida['q' . ($k + 1)]['answers']['a' . $kk] = $vv;
            }
        }
        return count($salida) > 0 ? $salida : '';
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
                return redirect()->route('campaigns::index')->with('data', 'send'); //view('campaigns.create', compact('branches', 'noCreateBtn', 'campaignName'));

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
        /*
        $img = Input::get('imgToSave');
        echo "{success: 'true', img_length:strlen($img)}";
*/

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
        $pngToDelete = $filename;

        //compress png to jpg
        $png = $file;
        $filename = time() . ".jpg";
        $file = storage_path() . '/app/' . $filename;
        $image = imagecreatefrompng($png);
        imagejpeg($image, $file, 90);
        imagedestroy($image);


        if ($success) {
            //image copied to server successfully

            /*
            $fc = new FileCloud();

            //get uploaded file and copy it to cloud
            $uploadedFile = Storage::get($filename);
            $fileSaved = $fc->put(time() . ".jpg", $uploadedFile);*/

            //upload to S3
            $uploadedFile = Storage::get($filename);
            Storage::disk('s3')->put("items/" . $filename, $uploadedFile, "public");

            //delete server file
            Storage::delete($filename);
            Storage::delete($pngToDelete);

            //created item related to campaign
            $item = Item::create(
                [
                    "filename" => $filename,
                    "administrator_id" => Auth::user()->_id,
                    "type" => 'image',
                ]
            );

            $res = array('success' => true, 'filename' => $filename, 'item_id' => $item->_id, 'imageType' => $imageType);

            echo json_encode($res);

        } else {
            $res = array('success' => false, 'msg' => 'error saving cropped image on storage');
            echo json_encode($res);
        }


    }

    /**
     * @param Request $request
     */
    public function saveItemVideo(Request $request)
    {
        if (!$request->hasFile('video')) {
            $res = array('success' => false, 'msg' => 'no file selected');
            echo json_encode($res);
        }

        if (!$request->file('video')->isValid()) {
            $res = array('success' => false, 'msg' => 'file is not valid');
            echo json_encode($res);
        }

        $video = $request->file('video');

        $v = Validator::make(
            $request->all(),
            ['video' => 'required|max:10240']//10mb max
        );

        if ($v->fails()) {
            $res = array('success' => false, 'msg' => $v->errors());
            echo json_encode($res);
        }

        $filename = "v_" . time() . "_" . $video->getClientOriginalName();

        //transferring file to storage
        $path = storage_path() . '/app/';
        $success = $video->move($path, $filename);
        $videoToDelete = $filename;

        if ($success) {
            //image copied to server successfully

            //upload to S3
            $uploadedFile = Storage::get($filename);
            Storage::disk('s3')->put("items/" . $filename, $uploadedFile, "public");

            //delete server file
            Storage::delete($videoToDelete);

            //created item related to campaign
            $item = Item::create(
                [
                    "filename" => $filename,
                    "administrator_id" => Auth::user()->_id,
                    "type" => 'video',
                ]
            );

            $res = array('success' => true, 'filename' => $filename, 'item_id' => $item->_id);

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
        $porcentaje = 0.0;
        $campaign = Campaign::find($id); //busca la campaña
        if ($campaign && $campaign->administrator_id == auth()->user()->_id) {
            /******     saca el color y el icono que se va a usar regresa un array  ********/
            $color = [];
            $color['icon'] = CampaignStyleHelper::getStatusIcon($campaign->status);
            $color['color'] = CampaignStyleHelper::getStatusColor($campaign->status);

            /****         OBTENER PORCENTAJE DEL TIEMPO TRANSCURRIDO       ***************/
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
                    if ($today < $start) {
                        $porcentaje = 0;
                    } else {
                        $today = new DateTime();
                        $total = $start->diff($end);
                        $diff = $start->diff($today);
                        $porcentaje = $diff->format('%a') / $total->format('%a');
                    }
                    break;
                case 'canceled':
                    $canceled = new DateTime($campaign->history->where('status', 'canceled')->first()->date);
                    $total = $start->diff($end);
                    $diff = $start->diff($canceled);
                    $porcentaje = $diff->format('%a') / $total->format('%a');
                    break;
            }

            /*******         OBTENER LAS EDADES Y CANTIDAD DE USUARIOS UNICOS       ***************/
            $collection = DB::getMongoDB()->selectCollection('campaign_logs');
            $gender_age = $collection->aggregate([

                // Stage 1
                [
                    '$match' => [
                        'campaign_id' => $id,
                        'user.id' => ['$exists' => true],
                    ]
                ],

                // Stage 2
                [
                    '$group' => [
                        '_id' => [
                            'gender' => '$user.gender',
                            'age' => '$user.age'
                        ],
                        'users' => [
                            '$addToSet' => '$user.id'
                        ]
                    ]
                ],

                // Stage 3
                [
                    '$unwind' => '$users'
                ],

                // Stage 4
                [
                    '$group' => [
                        '_id' => '$_id',
                        'count' => [
                            '$sum' => 1
                        ]
                    ]
                ],

                // Stage 5
                [
                    '$sort' => [
                        '_id' => 1
                    ]
                ]

            ]);

            $male = array_fill(1, 10, 0);
            $female = array_fill(1, 10, 0);

            foreach ($gender_age['result'] as $person) {
                if ($person['_id']['age'] > 0 && $person['_id']['age'] <= 17) {
                    ${$person['_id']['gender']}[1] += $person['count'];
                } else if ($person['_id']['age'] >= 18 && $person['_id']['age'] <= 20) {
                    ${$person['_id']['gender']}[2] += $person['count'];
                } else if ($person['_id']['age'] >= 21 && $person['_id']['age'] <= 30) {
                    ${$person['_id']['gender']}[3] += $person['count'];
                } else if ($person['_id']['age'] >= 31 && $person['_id']['age'] <= 40) {
                    ${$person['_id']['gender']}[4] += $person['count'];
                } else if ($person['_id']['age'] >= 41 && $person['_id']['age'] <= 50) {
                    ${$person['_id']['gender']}[5] += $person['count'];
                } else if ($person['_id']['age'] >= 51 && $person['_id']['age'] <= 60) {
                    ${$person['_id']['gender']}[6] += $person['count'];
                } else if ($person['_id']['age'] >= 61 && $person['_id']['age'] <= 70) {
                    ${$person['_id']['gender']}[7] += $person['count'];
                } else if ($person['_id']['age'] >= 71 && $person['_id']['age'] <= 80) {
                    ${$person['_id']['gender']}[8] += $person['count'];
                } else if ($person['_id']['age'] >= 81 && $person['_id']['age'] <= 90) {
                    ${$person['_id']['gender']}[9] += $person['count'];
                } else if ($person['_id']['age'] >= 91) {
                    ${$person['_id']['gender']}[10] += $person['count'];
                }
            }

            $male = array_map(function ($item) {
                return $item * -1;
            }, $male);

            /*******         OBTENER LAS INTERACCIONES POR hora       ***************/
            $IntLoaded = $collection->aggregate([
                [
                    '$match' => [
                        'campaign_id' => $id,
                        'interaction.loaded' => [
                            '$gte' => new MongoDate(strtotime(Carbon::today()->subDays(30)->format('Y-m-d'))),
                            '$lte' => new MongoDate(strtotime(Carbon::today()->subDays(0)->format('Y-m-d'))),
                        ]
                    ]
                ],
                [
                    '$group' => [
                        '_id' => [
                            '$dateToString' => [
                                'format' => '%H', 'date' => ['$subtract' => ['$created_at', 18000000]]
                            ]
                        ],
                        'cnt' => [
                            '$sum' => 1
                        ]
                    ],
                ],
                [
                    '$sort' => [
                        '_id' => 1
                    ]
                ]
            ]);
            $IntCompleted = $collection->aggregate([
                [
                    '$match' => [
                        'campaign_id' => $id,
                        'interaction.completed' => [
                            '$gte' => new MongoDate(strtotime(Carbon::today()->subDays(30)->format('Y-m-d'))),
                            '$lte' => new MongoDate(strtotime(Carbon::today()->subDays(0)->format('Y-m-d'))),
                        ]
                    ]
                ],
                [
                    '$group' => [
                        '_id' => [
                            '$dateToString' => [
                                'format' => '%H', 'date' => ['$subtract' => ['$created_at', 18000000]]
                            ]
                        ],
                        'cnt' => [
                            '$sum' => 1
                        ]
                    ],
                ],
                [
                    '$sort' => [
                        '_id' => 1
                    ]
                ]
            ]);

            $IntHours = [];
            foreach ($IntLoaded['result'] as $k => $v) {
                $IntHours[$v['_id']]['loaded'] = $v['cnt'];
            }

            foreach ($IntCompleted['result'] as $k => $v) {
                $IntHours[$v['_id']]['completed'] = $v['cnt'];
            }

            $unique_users_query = $collection->aggregate([
                [
                    '$match' => [
                        'campaign_id' => $id,
                    ]
                ],
                [
                    '$group' => [
                        '_id' => '',
                        'users' => [
                            '$addToSet' => '$user.id',
                        ]
                    ],
                ],
                ['$unwind' => '$users'],
                [
                    '$group' => [
                        '_id' => '$_id',
                        'cnt' => ['$sum' => 1]
                    ]
                ]
            ])['result'];
            $unique_users = isset($unique_users_query[0]['cnt']) ? $unique_users_query[0]['cnt'] : 0;

            $lugares = in_array('all', $campaign->branches) ? 'global' : $campaign->branches;

            return view('campaigns.show', [
                'cam' => $campaign,
                'lugares' => $lugares,
                'men' => $male,
                'women' => $female,
                'porcentaje' => $porcentaje,
                'IntHours' => $IntHours,
                'unique_users' => $unique_users,
            ]);
        } else {
            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
        }
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
            $log['error'] = ['error'];
        } else {
            echo 'encontro algo';
            $Logs = $logs->toArray();
            foreach ($Logs as $clave => $valor) {
                $log['users'][$clave]['age'] = $valor['user']['age'];
//                var_dump($log['users'][$clave]['age']);
                $log['users'][$clave]['gender'] = $valor['user']['gender'];
//                var_dump($log['users'][$clave]['gender']);
            }
        }
        return $log;
    }

    public function deposits()
    {
        return view('campaigns.deposits');
    }

}
