<?php
/**
 * Created by PhpStorm.
 * User: asdrubal
 * Date: 11/11/15
 * Time: 1:22 PM
 */

namespace Publishers\Http\Controllers;

use Auth;
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
//        var_dump($type);
//        var_dump($id);
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
//            echo 'la campaña es mia <br>';
            if (method_exists($this, $type) && $type==!null) { //se verifica que el tipo sea valido y no nulo
//                var_dump($type);
                $datosGrafica= $this->$type($campaign['_id']); //se llama el metodo correspondiente
            }else{
                $data['type']='intPerDay';
                $datosGrafica= $this->intPerDay($campaign['_id']);//default, si es un tipo diferente o no existe
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
            $campaign->grafica = $datosGrafica;
            $campaign->user = 'PRUEBA_ER';
            $data=array_merge($campaign->toArray(),$data);
//            dd($data);
            return view('analytics.single', ['data' => $data,  'user' => Auth::user()]);
        }else {
//            echo 'la campaña no es mia <br>';
//            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
//            return redirect()->action('CampaignsController@index')->with('data', 'error');
        }
    }

    /**
     * @param $id
     */
    private function intPerDay($id) //interacciones por dia
    {//sacar un conteo de cuantas interaccion se hacen por dia 5 dias atras
        $rangoFechas = $this->getRangoLast5Days();//obtengo las fechas de los ultimos 5 dias con la hora correcta para sacar los logs del dia especifico

//        $interacciones['0']= CampaignLog::where('campaign_id',$id)->where('interaction.loaded','exists','true')->where('updated_at', '>', $rangoFechas[2]['inicio'])->where('updated_at', '<', $rangoFechas[2]['fin'])->get(array('interaction'));
        $grafica['dia1'] = CampaignLog::where('campaign_id',$id)->where('interaction.loaded','exists','true')->where('updated_at', '>', $rangoFechas[0]['inicio'])->where('updated_at', '<', $rangoFechas[0]['fin'])->count();
        $grafica['dia2']= CampaignLog::where('campaign_id',$id)->where('interaction.loaded','exists','true')->where('updated_at', '>', $rangoFechas[1]['inicio'])->where('updated_at', '<', $rangoFechas[1]['fin'])->count();
        $grafica['dia3'] = CampaignLog::where('campaign_id',$id)->where('interaction.loaded','exists','true')->where('updated_at', '>', $rangoFechas[2]['inicio'])->where('updated_at', '<', $rangoFechas[2]['fin'])->count();
        $grafica['dia4'] = CampaignLog::where('campaign_id',$id)->where('interaction.loaded','exists','true')->where('updated_at', '>', $rangoFechas[3]['inicio'])->where('updated_at', '<', $rangoFechas[3]['fin'])->count();
        $grafica['dia5']= CampaignLog::where('campaign_id',$id)->where('interaction.loaded','exists','true')->where('updated_at', '>', $rangoFechas[4]['inicio'])->where('updated_at', '<', $rangoFechas[4]['fin'])->count();
        $grafica['grafica']=$grafica;
        //creo la grafica para mandarla como un string e imprimirla

        return $grafica;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function genderAge($id)
    {   //        $today =date( "Y-m-d",mktime(0, 0, 0, date("m"),date("d")-5, date("Y")));
        $Log['users'] =[];//se inicializa el arreglo
        dd($Log);
        //se obtiene de los logs los usuarios de 5 dias atras
        $fecha = $this->fechaInicio(5); //el numero es entere positivo pero en la funcion se ase negativo para buscar asia atras
        if($Logs = CampaignLog::groupBy('user')->where('campaign_id',$id)->where('updated_at', '>', $fecha)->get(array('user')))
        {
            $Logs=$Logs->toArray();
            foreach ($Logs as $clave => $valor) {//recorro el arreglo para acomodar los datos en un arreglo mas presentable
                if (array_key_exists($valor['user']['age'], $Log['users'])){
//                    echo 'se encontro <br>';
                    if($valor['user']['gender']=='male'){
                        $Log['users'][$valor['user']['age']]['M'] += 1;
                    }else{
                        $Log['users'][$valor['user']['age']]['F'] += '1';
                    }
                }else{
//                    echo 'no se encontro'.$valor['user']['age'].' <br>';
                    if($valor['user']['gender']=='male'){
                        $Log['users'][$valor['user']['age']]['M'] = 1;
                    }else{
                        $Log['users'][$valor['user']['age']]['F'] = '1';
                    }
                }
                    /*$Log['users'][$clave]['gender'] =$valor['user']['gender'];
                $Log['users'][$clave]['age'] =$valor['user']['age'];*/
            }//fin del for
        }else{
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
    public function so($id)
    {
        //se obtiene de los logs los usuarios de 5 dias atras
        $fecha = $this->fechaInicio(5); //el numero es entere positivo pero en la funcion se ase negativo para buscar asia atras
        $so['android'] = CampaignLog::where('campaign_id',$id)->where('device.os','android')->where('updated_at', '>', $fecha)->count();
        $so['mac'] = CampaignLog::where('campaign_id',$id)->where('device.os','mac')->where('updated_at', '>', $fecha)->count();
        $so['windows'] = CampaignLog::where('campaign_id',$id)->where('device.os','windows')->where('updated_at', '>', $fecha)->count();
        $so['otro'] = CampaignLog::where('campaign_id',$id)->where('device.os','other')->where('updated_at', '>', $fecha)->count();
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
//        $grafica['grafica']='';
        return $grafica;
    }

    /**
     * @internal param MongoDate $fecha
     */
    public function getRangoLast5Days()
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
