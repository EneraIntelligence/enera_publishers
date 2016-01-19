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
        $data = array();    $porcentaje=0;
        $data['type'] = $type;
//        var_dump($type);
//        var_dump($id);
//        dd($campaign);
        $this->campaign = Campaign::find($id); //busca la campaña

//        dd($data);
        //valida que la campaña le pertenezca al usuario
        if ($this->campaign && $this->campaign->administrator_id == auth()->user()->_id) {
            $data['name'] = $this->campaign->name;
            $data['interaction'] = $this->campaign->interaction;
            /****  OBTENER PORCENTAJE DEL TIEMPO TRANSCURRIDO ****/
            $start = new DateTime(date('Y-m-d H:i:s', $this->campaign->filters['date']['start']->sec));
            $end = new DateTime(date('Y-m-d H:i:s', $this->campaign->filters['date']['end']->sec));

//            echo 'la campaña es mia <br>';
            if (method_exists($this, $type) && $type == !null) { //se verifica que el tipo sea valido y no nulo
//                var_dump($type);
                $datosGrafica = $this->$type(); //se llama el metodo correspondiente
            } else {
                $data['type'] = 'intPerDay';
//                $data['type'] = 'genderAge';
                $datosGrafica = $this->intPerDay();//default, si es un tipo diferente o no existe
            }

            $this->campaign->grafica = $datosGrafica;

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
            $this->campaign->porcentaje = $porcentaje;
//            $this->campaign->grafica = $datosGrafica;
            $this->campaign->user = 'PRUEBA_ER';
            $data = array_merge($this->campaign->toArray(), $data);
//            dd($data);
            return view('analytics.single', ['data' => $data, 'user' => Auth::user()]);
        } else {
//            echo 'la campaña no es mia <br>';
            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
//            return redirect()->action('CampaignsController@index')->with('data', 'error');
        }
    }

    /**
     * @internal param $id
     */
    private function intPerDay() //interacciones por dia
    {//sacar un conteo de cuantas interaccion se hacen por dia 5 dias atras
        $dias=[];
        $cnt=[];

//        dd($start);
//        $rangoFechas = $this->getRangoLast5Days();//obtengo las fechas de los ultimos 5 dias con la hora correcta para sacar los logs del dia especific
//        $interacciones['0']= CampaignLog::where('campaign_id',$id)->where('interaction.loaded','exists','true')->where('updated_at', '>', $rangoFechas[2]['inicio'])->where('updated_at', '<', $rangoFechas[2]['fin'])->get(array('interaction'));
//        $grafica['dia1'] = CampaignLog::where('campaign_id', $id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[0]['inicio'])->where('updated_at', '<', $rangoFechas[0]['fin'])->count();
//        $grafica['dia2'] = CampaignLog::where('campaign_id', $id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[1]['inicio'])->where('updated_at', '<', $rangoFechas[1]['fin'])->count();
//        $grafica['dia3'] = CampaignLog::where('campaign_id', $id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[2]['inicio'])->where('updated_at', '<', $rangoFechas[2]['fin'])->count();
//        $grafica['dia4'] = CampaignLog::where('campaign_id', $id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[3]['inicio'])->where('updated_at', '<', $rangoFechas[3]['fin'])->count();
//        $grafica['dia5'] = CampaignLog::where('campaign_id', $id)->where('interaction.loaded', 'exists', 'true')->where('updated_at', '>', $rangoFechas[4]['inicio'])->where('updated_at', '<', $rangoFechas[4]['fin'])->count();
//        $grafica['grafica'] = $grafica;

        /****  fechas para hacer la busqueda ****/
        $start = $this->campaign->filters['date']['start']->sec;
        $end = $this->campaign->filters['date']['end']->sec;

        $collection = DB::getMongoDB()->selectCollection('campaign_logs');
//        dd($collection);
        $results = $collection->aggregate([
            [
                '$match' => [
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
                            'format' => '%Y-%m-%d', 'date' => ['$subtract' => ['$created_at', 18000000]]
                        ]
                    ],
                    'cnt' => [
                        '$sum' => 1
                    ]
                ]
            ],
        ]);
//        dd($results);
        foreach($results['result'] as $result => $valor){
//            echo '<br> for <br>';
//            echo '<br> '.$result.'- '.$valor['_id'] .' <br>';
            $dias[$result]=$valor['_id'];
            $cnt[$result]=$valor['cnt'];
        }
        $this->campaign->dias=$dias;
        $this->campaign->cnt=$cnt;
//        return $results['result'];
        //creo la grafica para mandarla como un string e imprimirla

    }

    private function genderAge()
    {
        /*******         OBTENER LAS INTERACCIONES POR DIAS       ***************/
        $men['1'] = -$this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'male')
            ->where('user.age', '>=', 0)->where('user.age', '<=', 17)->distinct('user_id')->count();
        $men['2'] = -$this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'male')
            ->where('user.age', '>=', 18)->where('user.age', '<=', 20)->distinct('user_id')->count();
        $men['3'] = -$this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'male')
            ->where('user.age', '>=', 21)->where('user.age', '<=', 30)->distinct('user_id')->count();
        $men['4'] = -$this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'male')
            ->where('user.age', '>=', 31)->where('user.age', '<=', 40)->distinct('user_id')->count();
        $men['5'] = -$this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'male')
            ->where('user.age', '>=', 41)->where('user.age', '<=', 50)->distinct('user_id')->count();
        $men['6'] = -$this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'male')
            ->where('user.age', '>=', 51)->where('user.age', '<=', 60)->distinct('user_id')->count();
        $men['7'] = -$this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'male')
            ->where('user.age', '>=', 61)->where('user.age', '<=', 70)->distinct('user_id')->count();
        $men['8'] = -$this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'male')
            ->where('user.age', '>=', 71)->where('user.age', '<=', 80)->distinct('user_id')->count();
        $men['9'] = -$this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'male')
            ->where('user.age', '>=', 81)->where('user.age', '<=', 90)->distinct('user_id')->count();
        $men['10'] = -$this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'male')
            ->where('user.age', '>=', 90)->distinct('user_id')->count();

        $women['1'] = $this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'female')
            ->where('user.age', '>=', 0)->where('user.age', '<=', 17)->distinct('user_id')->count();
        $women['2'] = $this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'female')
            ->where('user.age', '>=', 18)->where('user.age', '<=', 20)->distinct('user_id')->count();
        $women['3'] = $this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'female')
            ->where('user.age', '>=', 21)->where('user.age', '<=', 30)->distinct('user_id')->count();
        $women['4'] = $this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'female')
            ->where('user.age', '>=', 31)->where('user.age', '<=', 40)->distinct('user_id')->count();
        $women['5'] = $this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'female')
            ->where('user.age', '>=', 41)->where('user.age', '<=', 50)->distinct('user_id')->count();
        $women['6'] = $this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'female')
            ->where('user.age', '>=', 51)->where('user.age', '<=', 60)->distinct('user_id')->count();
        $women['7'] = $this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'female')
            ->where('user.age', '>=', 61)->where('user.age', '<=', 70)->distinct('user_id')->count();
        $women['8'] = $this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'female')
            ->where('user.age', '>=', 71)->where('user.age', '<=', 80)->distinct('user_id')->count();
        $women['9'] = $this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'female')
            ->where('user.age', '>=', 81)->where('user.age', '<=', 90)->distinct('user_id')->count();
        $women['10'] = $this->campaign->logs()->where('interaction.loaded', 'exists', true)->where('user.gender', 'female')
            ->where('user.age', '>=', 90)->distinct('user_id')->count();
        $this->campaign->men = $men;
        $this->campaign->women = $women;
        $grafica['men']=$men;
//        $grafica['women']=$women;
//        return $grafica;
    }
    /**
     * @param $id
     * @return mixed
     */
    private function genderAge2($id)
    {   //        $today =date( "Y-m-d",mktime(0, 0, 0, date("m"),date("d")-5, date("Y")));
        $Log['users'] = [];//se inicializa el arreglo
        dd($Log);
        //se obtiene de los logs los usuarios de 5 dias atras
        $fecha = $this->fechaInicio(5); //el numero es entere positivo pero en la funcion se ase negativo para buscar asia atras
        if ($Logs = CampaignLog::groupBy('user')->where('campaign_id', $id)->where('updated_at', '>', $fecha)->get(array('user'))) {
            $Logs = $Logs->toArray();
            foreach ($Logs as $clave => $valor) {//recorro el arreglo para acomodar los datos en un arreglo mas presentable
                if (array_key_exists($valor['user']['age'], $Log['users'])) {
//                    echo 'se encontro <br>';
                    if ($valor['user']['gender'] == 'male') {
                        $Log['users'][$valor['user']['age']]['M'] += 1;
                    } else {
                        $Log['users'][$valor['user']['age']]['F'] += '1';
                    }
                } else {
//                    echo 'no se encontro'.$valor['user']['age'].' <br>';
                    if ($valor['user']['gender'] == 'male') {
                        $Log['users'][$valor['user']['age']]['M'] = 1;
                    } else {
                        $Log['users'][$valor['user']['age']]['F'] = '1';
                    }
                }
                /*$Log['users'][$clave]['gender'] =$valor['user']['gender'];
            $Log['users'][$clave]['age'] =$valor['user']['age'];*/
            }//fin del for
        } else {
            $Log['users'][0]['F'] = '0';;
            $Log['users'][0]['M'] = '0';;
        }
//        dd($Log);
        return $Log;
    }

    /**
     * @param $id
     * @return array
     */
    public function so()
    {
        //se obtiene de los logs los usuarios de 5 dias atras
        $fecha = $this->fechaInicio(5); //el numero es entere positivo pero en la funcion se ase negativo para buscar asia atras
        $so['android'] = CampaignLog::where('campaign_id', $this->campaign->id)->where('device.os', 'android')->where('updated_at', '>', $fecha)->count();
        $so['mac'] = CampaignLog::where('campaign_id', $this->campaign->id)->where('device.os', 'mac')->where('updated_at', '>', $fecha)->count();
        $so['windows'] = CampaignLog::where('campaign_id', $this->campaign->id)->where('device.os', 'windows')->where('updated_at', '>', $fecha)->count();
        $so['otro'] = CampaignLog::where('campaign_id', $this->campaign->id)->where('device.os', 'other')->where('updated_at', '>', $fecha)->count();
//        dd($so);

        return $so;
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
    public function getRangoLast5Days()
    {   //para setear el rango de la hora que quiero
        $rangoFechas = array();
        for ($i = 0; $i < 6; $i++) {
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
