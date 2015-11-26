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
    private $rangoFechas =array();

    public function index()
    {
        return view('analytics.index');
    }

    /**
     * @param $id
     * @param $type
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
                $graph= $this->$type($campaign['_id']); //se llama el metodo correspondiente
            }else{
                $graph= $this->intPerDay();//default y si es un tipo diferente o no existe
            }
            $data=array_merge($campaign->toArray(),$graph,$data);
//            dd($data);
            return view('analytics.single', $data);
        }else {
            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
//            return redirect()->action('CampaignsController@index')->with('data', 'error');
        }
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
    }

    /**
     * @param $id
     */
    private function intPerDay($id) //interacciones por dia
    {//sacar un conteo de cuantas interaccion se hacen por dia 5 dias atras
        $this->getRango();//obtengo las fechas de los ultimos 5 dias con la hora correcta para sacar los logs del dia especifico

//        $cam = CampaignLog::where('campaign_id',$id)->where('updated_at', '>', new DateTime('-1 day'))->where('updated_at', '<', new DateTime('+1 day'))->get();
//        $cam = CampaignLog::where('updated_at', '>', new DateTime('-1 day'))->where('updated_at', '>', new DateTime())->get();
//        $cam = campaignLog::where('campaign_id',$id)->whereBetween('updated_at', array($ayeri,$ayerf))->get();
        $dia1= CampaignLog::where('campaign_id',$id)->where('updated_at', '>', $this->rangoFechas[0]['inicio'])->where('updated_at', '<', $this->rangoFechas[0]['fin'])->get();
        $dia2= CampaignLog::where('campaign_id',$id)->where('updated_at', '>', $this->rangoFechas[1]['inicio'])->where('updated_at', '<', $this->rangoFechas[1]['fin'])->get();
        $dia3= CampaignLog::where('campaign_id',$id)->where('updated_at', '>', $this->rangoFechas[2]['inicio'])->where('updated_at', '<', $this->rangoFechas[2]['fin'])->get();
        $dia4= CampaignLog::where('campaign_id',$id)->where('updated_at', '>', $this->rangoFechas[3]['inicio'])->where('updated_at', '<', $this->rangoFechas[3]['fin'])->get();
        $dia5= CampaignLog::where('campaign_id',$id)->where('updated_at', '>', $this->rangoFechas[4]['inicio'])->where('updated_at', '<', $this->rangoFechas[4]['fin'])->get();
        $dia6= CampaignLog::where('campaign_id',$id)->where('updated_at', '>', $this->rangoFechas[5]['inicio'])->where('updated_at', '<', $this->rangoFechas[5]['fin'])->get();

        dd($dia6);


    }

    /**
     * @param $id
     * @return mixed
     */
    private function genderAge($id)
    {   //        $today =date( "Y-m-d",mktime(0, 0, 0, date("m"),date("d")-5, date("Y")));
        //se obtiene de los logs los usuarios de 5 dias atras
        $fecha = new MongoDate(strtotime("-5 days"));
        $a=$fecha->toDateTime();
        $fecha = $a->setTime(0,0,0) ;
        $Logs = CampaignLog::groupBy('user')->where('campaign_id',$id)
                ->where('updated_at', '>', $fecha)->get(array('user'));
        $Logs=$Logs->toArray();
        foreach ($Logs as $clave => $valor) {
//            var_dump($valor['user']);
            $Log['users'][$clave]['gender'] =$valor['user']['gender'];
            $Log['users'][$clave]['age'] =$valor['user']['age'];
        }
        dd($Log);
        return $Log;
    }

    public function prueba($id)
    {
        $this->getRango();//obtengo las fechas de los ultimos 5 dias con la hora correcta para sacar los logs del dia especifico

//        $cam = campaignLog::where('campaign_id',$id)->whereBetween('updated_at', array($ayeri,$ayerf))->get();
        $dinteracciones['0']= CampaignLog::where('campaign_id',$id)->where('interaction.loaded','exists','true')->where('updated_at', '>', $this->rangoFechas[0]['inicio'])->where('updated_at', '<', $this->rangoFechas[0]['fin'])->count();
//        $dia2= CampaignLog::where('campaign_id',$id)->where('updated_at', '>', $this->rangoFechas[1]['inicio'])->where('updated_at', '<', $this->rangoFechas[1]['fin'])->get();
//        $dia3= CampaignLog::where('campaign_id',$id)->where('updated_at', '>', $this->rangoFechas[2]['inicio'])->where('updated_at', '<', $this->rangoFechas[2]['fin'])->get();
//        $dia4= CampaignLog::where('campaign_id',$id)->where('updated_at', '>', $this->rangoFechas[3]['inicio'])->where('updated_at', '<', $this->rangoFechas[3]['fin'])->get();
//        $dia5= CampaignLog::where('campaign_id',$id)->where('updated_at', '>', $this->rangoFechas[4]['inicio'])->where('updated_at', '<', $this->rangoFechas[4]['fin'])->get();
//        $dia6= CampaignLog::where('campaign_id',$id)->where('updated_at', '>', $this->rangoFechas[5]['inicio'])->where('updated_at', '<', $this->rangoFechas[5]['fin'])->get();

        dd($dia1);
    }

    /**
     * @internal param MongoDate $fecha
     */
    public function getRango()
    {   //para setear el rango de la hora que quiero
        for($i=0;$i<6;$i++){
            $fecha = new MongoDate(strtotime("-$i days"));
            $a=$fecha->toDateTime();
            $b=$fecha->toDateTime();
            $this->rangoFechas[$i]['inicio'] = $a->setTime(0,0,0) ;
            $this->rangoFechas[$i]['fin'] = $b->setTime(23,59,59) ;
        }

//        dd($this->rangoFechas);

    }

    /**
     * @param $dias es el numero de dias atras que quieres la fecha 0=hoy
     * @return DateTime|MongoDate
     */
    public function generarFecha($dias)
    {
        $fecha = new MongoDate(strtotime("-$dias days"));// saco la fecha con el dia que quiera
        $a=$fecha->toDateTime();    //lo combierto a otro formato para agregarle la hora en 0
        $fecha = $a->setTime(0,0,0) ; //le seteo la hora en 0 que es cuando inicia el dia
        return $fecha;
    }
}

/*$a=$ayer->toDateTime();
$b=$ayer->toDateTime();

$ayeri= $a->setTime(0,0,0) ;
var_dump($ayeri);
$ayerf= $b->setTime(23,59,59) ;
//        $ayer= $a->format('Y-m-d');
//        var_dump($a->format('Y-m-d'));
echo '<br>';
var_dump($ayerf);
//        dd($ayerf);*/