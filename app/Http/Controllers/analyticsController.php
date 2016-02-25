<?php
/**
 * Created by PhpStorm.
 * User: asdrubal
 * Date: 11/11/15
 * Time: 1:22 PM
 */

namespace Publishers\Http\Controllers;

use Auth;
use Carbon\Carbon;
use DB;
use Publishers\Campaign;
use Publishers\CampaignLog;
use DateTime;
use MongoDate;
use Date;
use MongoClient;


class AnalyticsController extends Controller
{
    private $campaign;
    private $data;

    public function index()
    {
        return view('analytics.index');
    }

    /**
     * @param $id el id de la campaña que se quiere la grafica
     * @param es|string $type es el tipo de grafica que se quiere obtener
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function single($id, $type = 'intPerDay')
    {

        $this->data = array();
        $porcentaje = 0;
        $this->data['type'] = $type; //guardo el tipo en data por que tambien lo regreso a la vista
        $this->campaign = Campaign::find($id); //busca la campaña

        //valida que la campaña le pertenezca al usuario
        if ($this->campaign && $this->campaign->administrator_id == auth()->user()->_id) {
            $this->data['name'] = $this->campaign->name;
            $this->data['interaction'] = $this->campaign->interaction['name'];

            /****  OBTENER PORCENTAJE DEL TIEMPO TRANSCURRIDO ****/
            $start = new DateTime(date('Y-m-d H:i:s', $this->campaign->filters['date']['start']->sec));
            $end = new DateTime(date('Y-m-d H:i:s', $this->campaign->filters['date']['end']->sec));

            if (method_exists($this, $type) && $type == !null) { //se verifica que el tipo sea valido y no nulo
                $datosGrafica = $this->$type(); //se llama el metodo correspondiente
            } else {
                $this->data['type'] = 'intPerDay';
//                $data['type'] = 'genderAge';
                $datosGrafica = $this->intPerDay();//default, si es un tipo diferente o no existe
            }

            switch ($this->campaign->status) {
                case 'pending':
                    $porcentaje = 0.0;
                    break;
                case 'rejected':
                    $porcentaje = 0.0;
                    break;
                case 'ended':
                    $ended = new DateTime($this->campaign->history->where('status', 'ended')->first()->date);
                    $total = $start->diff($end);
                    $diff = $start->diff($ended);
                    $porcentaje = $diff->format('%a') / $total->format('%a');
                    break;
                case 'active':
                    $today = new DateTime();
                    $total = $start->diff($end);
                    $dife = $start->diff($today);
                    $porcentaje = $dife->format('%a') / $total->format('%a');
                    break;
                case 'canceled':
                    $canceled = new DateTime($this->campaign->history->where('status', 'canceled')->first()->date);
                    $total = $start->diff($end);
                    $diff = $start->diff($canceled);
                    $porcentaje = $diff->format('%a') / $total->format('%a');
                    break;
            }
            $this->data['porcentaje'] = $porcentaje;
//            dd($this->data);
            return view('analytics.single', [
                'data' => $this->data,
                'cam' => $this->campaign,
                'user' => Auth::user(),
                'grafica' => $datosGrafica
            ]);
        } else {
            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
        }
    }

    /**
     * @internal param $id
     */
    private function intPerDay() //interacciones por dia
    {//sacar un conteo de cuantas interaccion se hacen por dia 5 dias atras
        $this->data['graficname'] = 'interaciones por dia';
        /**************************   DATOS DE LA GRAFICA    ****************************/
        $rangoFechas = array();//inicialiso el arreglo de las fechas
        for ($i = 0; $i < 7; $i++) {
            $a = new DateTime("-$i days");
            $b = new  DateTime("-$i days");
            $rangoFechas[$i]['inicio'] = $a->setTime(0, 0, 0);
            $rangoFechas[$i]['fin'] = $b->setTime(23, 59, 59);
            $grafica['fecha'][$i] = $a->format('Y-m-d');//guardo la fecha de los dias que se sacan para mostrarlos en la grafica
        }

        $grafica['cnt'][0] = CampaignLog::where('campaign_id', $this->campaign->id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[0]['inicio'])->where('updated_at', '<', $rangoFechas[0]['fin'])->count();
        $grafica['cnt'][1] = CampaignLog::where('campaign_id', $this->campaign->id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[1]['inicio'])->where('updated_at', '<', $rangoFechas[1]['fin'])->count();
        $grafica['cnt'][2] = CampaignLog::where('campaign_id', $this->campaign->id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[2]['inicio'])->where('updated_at', '<', $rangoFechas[2]['fin'])->count();
        $grafica['cnt'][3] = CampaignLog::where('campaign_id', $this->campaign->id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[3]['inicio'])->where('updated_at', '<', $rangoFechas[3]['fin'])->count();
        $grafica['cnt'][4] = CampaignLog::where('campaign_id', $this->campaign->id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[4]['inicio'])->where('updated_at', '<', $rangoFechas[4]['fin'])->count();
        $grafica['cnt'][5] = CampaignLog::where('campaign_id', $this->campaign->id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[5]['inicio'])->where('updated_at', '<', $rangoFechas[5]['fin'])->count();
        $grafica['cnt'][6] = CampaignLog::where('campaign_id', $this->campaign->id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[6]['inicio'])->where('updated_at', '<', $rangoFechas[6]['fin'])->count();

//        dd($grafica);
        return $grafica;
    }

    private function genderAge()
    {
        $this->data['graficname'] = ' de distribucion por edades ';
        $collection = DB::getMongoDB()->selectCollection('campaign_logs');
        $em = $collection->aggregate([

            // Stage 1
            [
                '$match' => [
                    'campaign_id' => $this->campaign->id,
                    'interaction.loaded' => ['$exists' => true],
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

        $edades = $em['result'];

        $men = ['1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0];
        $women = ['1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0];

        foreach ($edades as $person => $valor) {
            if ($valor['_id']['gender'] == 'female') {
                if ($valor['_id']['age'] > 0 && $valor['_id']['age'] <= 17) {
                    $women['1'] += $valor['count'];
                } else if ($valor['_id']['age'] >= 18 && $valor['_id']['age'] <= 20) {
                    $women['2'] += $valor['count'];
                } else if ($valor['_id']['age'] >= 21 && $valor['_id']['age'] <= 30) {
                    $women['3'] += $valor['count'];
                } else if ($valor['_id']['age'] >= 31 && $valor['_id']['age'] <= 40) {
                    $women['4'] += $valor['count'];
                } else if ($valor['_id']['age'] >= 41 && $valor['_id']['age'] <= 50) {
                    $women['5'] += $valor['count'];
                } else if ($valor['_id']['age'] >= 51 && $valor['_id']['age'] <= 60) {
                    $women['6'] += $valor['count'];
                } else if ($valor['_id']['age'] >= 61 && $valor['_id']['age'] <= 70) {
                    $women['7'] += $valor['count'];
                } else if ($valor['_id']['age'] >= 71 && $valor['_id']['age'] <= 80) {
                    $women['8'] += $valor['count'];
                } else if ($valor['_id']['age'] >= 81 && $valor['_id']['age'] <= 90) {
                    $women['9'] += $valor['count'];
                } else if ($valor['_id']['age'] >= 91) {
                    $women['10'] += $valor['count'];
                }
            } else {
                if ($valor['_id']['age'] > 0 && $valor['_id']['age'] <= 17) {
                    $men['1'] -= $valor['count'];
                } else if ($valor['_id']['age'] >= 18 && $valor['_id']['age'] <= 20) {
                    $men['2'] -= $valor['count'];
                } else if ($valor['_id']['age'] >= 21 && $valor['_id']['age'] <= 30) {
                    $men['3'] -= $valor['count'];
                } else if ($valor['_id']['age'] >= 31 && $valor['_id']['age'] <= 40) {
                    $men['4'] -= $valor['count'];
                } else if ($valor['_id']['age'] >= 41 && $valor['_id']['age'] <= 50) {
                    $men['5'] -= $valor['count'];
                } else if ($valor['_id']['age'] >= 51 && $valor['_id']['age'] <= 60) {
                    $men['6'] -= $valor['count'];
                } else if ($valor['_id']['age'] >= 61 && $valor['_id']['age'] <= 70) {
                    $men['7'] -= $valor['count'];
                } else if ($valor['_id']['age'] >= 71 && $valor['_id']['age'] <= 80) {
                    $men['8'] -= $valor['count'];
                } else if ($valor['_id']['age'] >= 81 && $valor['_id']['age'] <= 90) {
                    $men['9'] -= $valor['count'];
                } else if ($valor['_id']['age'] >= 91) {
                    $men['10'] -= $valor['count'];
                }
            }
        }

        $grafica['men'] = $men;
        $grafica['women'] = $women;
        return $grafica;
    }

    /**
     * @return mixed
     * @internal param $id
     */
    private function intXHour()
    {   //        $today =date( "Y-m-d",mktime(0, 0, 0, date("m"),date("d")-5, date("Y")));
        $this->data['graficname'] = 'interaciones por hora';
        $IntXDias = [
            '00' => ['hora' => '00', 'cntC' => 0, 'cntL' => 0], '01' => ['hora' => '01', 'cntC' => 0, 'cntL' => 0], '02' => ['hora' => '02', 'cntC' => 0, 'cntL' => 0], '03' => ['hora' => '03', 'cntC' => 0, 'cntL' => 0],
            '04' => ['hora' => '04', 'cntC' => 0, 'cntL' => 0], '05' => ['hora' => '05', 'cntC' => 0, 'cntL' => 0], '06' => ['hora' => '06', 'cntC' => 0, 'cntL' => 0], '07' => ['hora' => '07', 'cntC' => 0, 'cntL' => 0],
            '08' => ['hora' => '08', 'cntC' => 0, 'cntL' => 0], '09' => ['hora' => '09', 'cntC' => 0, 'cntL' => 0], '10' => ['hora' => '10', 'cntC' => 0, 'cntL' => 0], '11' => ['hora' => '11', 'cntC' => 0, 'cntL' => 0],
            '12' => ['hora' => '12', 'cntC' => 0, 'cntL' => 0], '13' => ['hora' => '13', 'cntC' => 0, 'cntL' => 0], '14' => ['hora' => '14', 'cntC' => 0, 'cntL' => 0], '15' => ['hora' => '15', 'cntC' => 0, 'cntL' => 0],
            '16' => ['hora' => '16', 'cntC' => 0, 'cntL' => 0], '17' => ['hora' => '17', 'cntC' => 0, 'cntL' => 0], '18' => ['hora' => '18', 'cntC' => 0, 'cntL' => 0], '19' => ['hora' => '19', 'cntC' => 0, 'cntL' => 0],
            '20' => ['hora' => '20', 'cntC' => 0, 'cntL' => 0], '21' => ['hora' => '21', 'cntC' => 0, 'cntL' => 0], '22' => ['hora' => '22', 'cntC' => 0, 'cntL' => 0], '23' => ['hora' => '23', 'cntC' => 0, 'cntL' => 0],
        ];

        /****  fechas para hacer la busqueda ****/
        $start = $this->campaign->filters['date']['start']->sec;
        $end = $this->campaign->filters['date']['end']->sec;


        /*******         OBTENER LAS INTERACCIONES POR hora       ***************/
        $collection = DB::getMongoDB()->selectCollection('campaign_logs');
        $results = $collection->aggregate([
            [
                '$match' => [
                    'campaign_id' => $this->campaign->id,
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
                            'format' => '%H:00:00', 'date' => ['$subtract' => ['$created_at', 18000000]]
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
        $results2 = $collection->aggregate([
            [
                '$match' => [
                    'campaign_id' => $this->campaign->id,
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
                            'format' => '%H:00:00', 'date' => ['$subtract' => ['$created_at', 18000000]]
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

        foreach ($results['result'] as $result => $valor) {

            $time = explode(":", $valor['_id']);
            if (array_key_exists($time[0], $IntXDias)) {
//                    echo '<br>si esta<br>';
                $IntXDias[$time[0]]['cntL'] = $valor['cnt'];
            } else {
//                    echo '<br>no esta<br>';
                $IntXDias[$result][$time[0]] = 0;
            }
        }
        foreach ($results2['result'] as $result => $valor) {
            $time = explode(":", $valor['_id']);
            if (array_key_exists($time[0], $IntXDias)) {
                $IntXDias[$time[0]]['cntC'] = $valor['cnt'];
            } else {
                $IntXDias[$result][$time[0]] = 0;
            }
        }

//        dd($IntXDias);
        return $IntXDias;
    }

    /**
     * @return array
     * @internal param $id
     */
    public function so()
    {
        $this->data['graficname'] = ' sistemas operativos';
        $collectionCam = DB::getMongoDB()->selectCollection('campaign_logs');
        $sos = $collectionCam->aggregate([
            [
                '$match' => [
                    'campaign_id' => $this->campaign->id,
                    'interaction.loaded' => [
                        '$exists' => true
                    ],
                    'device.os' => [
                        '$exists' => true
                    ]
                ]
            ],
            [
                '$group' => [
                    '_id' => [ '$device.mac' ],
                    'os' => [
                        '$addToSet' => '$device.os'
                    ]
                ]
            ],
            [
                '$unwind' => '$os'
            ],
            [
                '$group' => [
                    '_id' => '$os',
                    'count' => [
                        '$sum' => 1
                    ]
                ]
            ]
        ]);
        dd($sos);

        /*$this->data['graficname'] = 'Grafica de los dispositivos';
        //se obtiene de los logs los usuarios de 5 dias atras
        $fecha = $this->fechaInicio(5); //el numero es entere positivo pero en la funcion se ase negativo para buscar asia atras
        $so['android'] = CampaignLog::where('campaign_id', $this->campaign->id)->where('device.os', 'android')->where('updated_at', '>', $fecha)->count();
        $so['mac'] = CampaignLog::where('campaign_id', $this->campaign->id)->where('device.os', 'mac')->where('updated_at', '>', $fecha)->count();
        $so['windows'] = CampaignLog::where('campaign_id', $this->campaign->id)->where('device.os', 'windows')->where('updated_at', '>', $fecha)->count();
        $so['otro'] = CampaignLog::where('campaign_id', $this->campaign->id)->where('device.os', 'other')->where('updated_at', '>', $fecha)->count();*/


//        return $so;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function prueba($id)
    {
        $fecha = $this->fechaInicio(5); //el numero es entere positivo pero en la funcion se ase negativo para buscar asia atras
        if ($Logs = CampaignLog::groupBy('user')->where('campaign_id', $id)->where('updated_at', '>', $fecha)->get(array('user'))) {//si no regresa null separo la edad y el genero
            $Logs = $Logs->toArray();
            foreach ($Logs as $clave => $valor) {
//            var_dump($valor['user']);
                $ed['users'][$clave]['gender'] = $valor['user']['gender'];
                $ed['users'][$clave]['age'] = $valor['user']['age'];
            }
        } else {//si regresa null regreso 0
            $ed[0] = 0;
        }
//        dd($Log);
        foreach ($ed as $clave => $valor) {

        }
//        $grafica['grafica']='';
        return $grafica;
    }

    /**
     * @internal param MongoDate $fecha
     */
    public function getRangoLast7Days()
    {   //para setear el rango de la hora que quiero
        $rangoFechas = array();
        for ($i = 0; $i < 7; $i++) {
            $a = new DateTime("-$i days");
            $b = new  DateTime("-$i days");
            $rangoFechas[$i]['inicio'] = $a->setTime(0, 0, 0);
            $rangoFechas[$i]['fin'] = $b->setTime(23, 59, 59);
        }
//        dd($this->rangoFechas);
        return $rangoFechas;
    }

    /**
     * @param $dias es el numero de dias atras que quieres la fecha 0=hoy
     * @return DateTime|MongoDate
     */
    public function fechaInicio($dias)
    {
        $fecha = new DateTime("-$dias days");// saco la fecha con el dia que quiera
        $fecha = $fecha->setTime(0, 0, 0); //le seteo la hora en 0 que es cuando inicia el dia
        return $fecha;
    }

}
