<?php
/**
 * Created by PhpStorm.
 * User: asdrubal
 * Date: 11/11/15
 * Time: 1:22 PM
 */

namespace Publishers\Http\Controllers;

use Publishers\Campaign;
use Publishers\CampaignLog;
use DateTime;
use MongoDate;


class AnalyticsController extends Controller
{

    public function index()
    {
        return view('analytics.index');
    }

    /**
     * @param $id el id de la campaña que se quiere la grafica
     * @param es|string $type es el tipo de grafica que se quiere obtener
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function single($id,$type='intPerDay')
    {
        $data=array();
        $data['type']=$type;
        $campaign = Campaign::find($id); //busca la campaña
//        $campaign = Campaign::where('_id',$id)->Lists('name','administrator_id','interaction'); //busca la campaña
//        $campaign = Campaign::where('_id',$id)->get(array('name','administrator_id','interaction')); //busca la campaña
//        $campaign=$campaign->toArray();
//        dd($campaign);

        $data['name']=$campaign->name;
        $data['interaction']=$campaign->interaction;
//        dd($data);
        //valida que la campaña le pertenezca al usuario
        if ($campaign && $campaign->administrator_id == auth()->user()->_id){
            if (method_exists($this, $type) && $type==!null) { //se verifica que el tipo sea valido y no nulo
                $datosGrafica= $this->$type($campaign['_id']); //se llama el metodo correspondiente
            }else{
                $datosGrafica= $this->intPerDay();//default, si es un tipo diferente o no existe
            }

            $campaign->grafica = $datosGrafica;
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

            $data=array_merge($campaign->toArray(),$datosGrafica,$data);
//            dd($data);
            return view('analytics.single', $data);
        }else {
            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
//            return redirect()->action('CampaignsController@index')->with('data', 'error');
        }
    }

    /**
     * @param $id
     */
    private function intPerDay($id) //interacciones por dia
    {//sacar un conteo de cuantas interaccion se hacen por dia 5 dias atras
        $rangoFechas = $this->getRango();//obtengo las fechas de los ultimos 5 dias con la hora correcta para sacar los logs del dia especifico

//        $interacciones['0']= CampaignLog::where('campaign_id',$id)->where('interaction.loaded','exists','true')->where('updated_at', '>', $rangoFechas[2]['inicio'])->where('updated_at', '<', $rangoFechas[2]['fin'])->get(array('interaction'));
        $dia1= CampaignLog::where('campaign_id',$id)->where('interaction.loaded','exists','true')->where('updated_at', '>', $rangoFechas[0]['inicio'])->where('updated_at', '<', $rangoFechas[0]['fin'])->count();
        $dia2= CampaignLog::where('campaign_id',$id)->where('interaction.loaded','exists','true')->where('updated_at', '>', $rangoFechas[1]['inicio'])->where('updated_at', '<', $rangoFechas[1]['fin'])->count();
        $dia3= CampaignLog::where('campaign_id',$id)->where('interaction.loaded','exists','true')->where('updated_at', '>', $rangoFechas[2]['inicio'])->where('updated_at', '<', $rangoFechas[2]['fin'])->count();
        $dia4= CampaignLog::where('campaign_id',$id)->where('interaction.loaded','exists','true')->where('updated_at', '>', $rangoFechas[3]['inicio'])->where('updated_at', '<', $rangoFechas[3]['fin'])->count();
        $dia5= CampaignLog::where('campaign_id',$id)->where('interaction.loaded','exists','true')->where('updated_at', '>', $rangoFechas[4]['inicio'])->where('updated_at', '<', $rangoFechas[4]['fin'])->count();
        //creo la grafica para mandarla como un string e imprimirla
        $grafica['grafica']='
        var chart3 = c3.generate({
            bindto: \'#intPerDay\',
            data: {
                columns: [
                    [\'hace 1 dia\',  '.$dia1.' ],
                    [\'hace 2 dia\',  '.$dia2.' ],
                    [\'hace 3 dia\',  '.$dia3.' ],
                    [\'hace 4 dia\',  '.$dia4.' ],
                    [\'hace 5 dia\',  '.$dia5.' ]
                    /*[\'Android\', 30, 200, 200, 400, 150, 250],
                     [\'Blackberry\', 130, 100, 100, 200, 150, 50],
                     [\'IOS\', 230, 200, 200, 300, 250, 250],
                     [\'Windows Phone\', 230, 200, 200, 300, 250, 250],
                     [\'other\', 230, 200, 200, 300, 250, 250]*/
                ],
                type: \'bar\',
                /*groups: [
                 [\'Android\', \'Blackberry\', \'IOS\', \'Windows Phone\', \'other\']
                 ]*/
            },
            color: {
                pattern: [\'red\', \'#aec7e8\', \'#ff7f0e\', \'#ffbb78\', \'#2ca02c\', \'#98df8a\', \'#d62728\', \'#ff9896\', \'#9467bd\', \'#c5b0d5\', \'#8c564b\', \'#c49c94\', \'#e377c2\', \'#f7b6d2\', \'#7f7f7f\', \'#c7c7c7\', \'#bcbd22\', \'#dbdb8d\', \'#17becf\', \'#9edae5\']
            },
            axis: {
                y: {
                    padding: {top: 200, bottom: 0}
                }
            }
        });
        ';
        return $grafica;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function genderAge($id)
    {   //        $today =date( "Y-m-d",mktime(0, 0, 0, date("m"),date("d")-5, date("Y")));
        //se obtiene de los logs los usuarios de 5 dias atras
        $fecha = $this->fechaInicio(5); //el numero es entere positivo pero en la funcion se ase negativo para buscar asia atras
        if($Logs = CampaignLog::groupBy('user')->where('campaign_id',$id)->where('updated_at', '>', $fecha)->get(array('user')))
        {
            $Logs=$Logs->toArray();
            foreach ($Logs as $clave => $valor) {
//            var_dump($valor['user']);
                $Log['users'][$clave]['gender'] =$valor['user']['gender'];
                $Log['users'][$clave]['age'] =$valor['user']['age'];
            }

        }else{
            return $Log[0]=[0];
        }
//        dd($Log);
        return $Log;
    }

    public function prueba($id)
    {
        $fecha = $this->fechaInicio(5); //el numero es entere positivo pero en la funcion se ase negativo para buscar asia atras
        if($Logs = CampaignLog::groupBy('user')->where('campaign_id',$id)->where('updated_at', '>', $fecha)->get(array('user')))
        {//si no regresa null separo la edad y el genero
            $Logs=$Logs->toArray();
            foreach ($Logs as $clave => $valor) {
//            var_dump($valor['user']);
                $ed['users'][$clave]['gender'] =$valor['user']['gender'];
                $ed['users'][$clave]['age'] =$valor['user']['age'];
            }

        }else{//si regresa null regreso 0
            $ed[0]=0;
        }
//        dd($Log);
        foreach($ed as $clave => $valor){

        }
        $grafica['grafica']='

        ';
        return $grafica;
    }

    /**
     * @internal param MongoDate $fecha
     */
    public function getRango()
    {   //para setear el rango de la hora que quiero
        $rangoFechas = array();
        for($i=0;$i<6;$i++){
            $a = new DateTime("-$i days");
            $b = new  DateTime("-$i days");
            $rangoFechas[$i]['inicio'] = $a->setTime(0,0,0) ;
            $rangoFechas[$i]['fin'] = $b->setTime(23,59,59) ;
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
        $fecha = $fecha->setTime(0,0,0) ; //le seteo la hora en 0 que es cuando inicia el dia
        return $fecha;
    }

}
