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

        /*******         OBTENER LAS EDADES Y CANTIDAD DE USUARIOS UNICOS       ***************/
        $collection = DB::getMongoDB()->selectCollection('campaign_logs');
        $gender_age = $collection->aggregate([
            // Stage 1
            [
                '$match' => [
                    'campaign_id' => $this->campaign->id,
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

        $grafica['men'] = $male;
        $grafica['women'] = $female;
        return $grafica;
    }

    /**
     * @return mixed
     * @internal param $id
     */
    private function intXHour()
    {   //        $today =date( "Y-m-d",mktime(0, 0, 0, date("m"),date("d")-5, date("Y")));
        $this->data['graficname'] = 'interaciones por hora';

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
        $sistemas = $collectionCam->aggregate([
            [
                '$match' => [
                    'campaign_id' => '56817e1c2bdb3a73ba25087d',
                    'device.os' => [
                        '$exists' => true
                    ]
                ]
            ],
            [
                '$group' => [
                    '_id' => '$device.os',
                    'mac' => [
                        '$addToSet' => '$device.mac'
                    ]
                ]
            ],
            [
                '$unwind' => '$mac'
            ],
            [
                '$group' => [
                    '_id' => '$_id',
                    'cnt' => [
                        '$sum' => 1
                    ]
                ]
            ]
        ]);

        foreach ($sistemas['result'] as $k => $v) {
            $so[$v['_id']] = $v['cnt'];
        }

        dd($so);

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
