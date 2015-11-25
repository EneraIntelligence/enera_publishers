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
        $data['name'] = $campaign->name;
        $data['interaction']=$campaign->interaction;
//        dd($data);
        //valida que la campaña le pertenezca al usuario
        if ($campaign && $campaign->administrator_id == auth()->user()->_id){
            if (method_exists($this, $type) && $type==!null) { //se verifica que el tipo sea valido y no nulo
                $graph= $this->$type($campaign['_id']); //se llama el metodo correspondiente
            }else{
                $graph= $this->intPerDay();//default y si es un tipo diferente
            }
            $data=array_merge($campaign->toArray(),$graph,$data);
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
        $fecha = new DateTime('-1 days');
//        var_dump($fecha);
        $fecha = $fecha->format('Y-m-d');
        $fecha = new MongoDate(strtotime($fecha.'00:00:00'));
//        dd($fecha);
//        var_dump($start);                               //whereBetween('created_at', array($start, $stop))->get();
//        $dia=CampaignLog::where('campaign_id',$id)->where('updated_at','=',$start)->get(array('interaction')); //$dias['dia1']
        $dia=CampaignLog::where('campaign_id',$id)->where('updated_at','=',$fecha)->get(array('interaction')); //$dias['dia1']
        /*$dias['dia2']=CampaignLog::where('campaign_id',$id)->where('updated_at', new DateTime('-2 days'))->get();
        $dias['dia3']=CampaignLog::where('campaign_id',$id)->where('updated_at', new DateTime('-3 days'))->get();
        $dias['dia4']=CampaignLog::where('campaign_id',$id)->where('updated_at', new DateTime('-4 days'))->get();
        $dias['dia5']=CampaignLog::where('campaign_id',$id)->where('updated_at', new DateTime('-5 days'))->get();*/
//        dd($dia);
        /*$Logs = CampaignLog::groupBy('user')->where('campaign_id',$id)
            ->where('updated_at', '>', new DateTime('-5 days'))->get(array('user'));
        $Logs=$Logs->toArray();*/
    }

    /**
     * @param $id
     * @return mixed
     */
    private function genderAge($id)
    {   //        $today =date( "Y-m-d",mktime(0, 0, 0, date("m"),date("d")-5, date("Y")));
        //se obtiene de los logs los usuarios de 5 dias atras
        $Logs = CampaignLog::groupBy('user')->where('campaign_id',$id)
                ->where('updated_at', '>', new DateTime('-5 days'))->get(array('user'));
        $Logs=$Logs->toArray();
//        dd($Logs);
        foreach ($Logs as $clave => $valor) {
//            var_dump($valor['user']);
            $Log['users'][$clave]['gender'] =$valor['user']['gender'];
            $Log['users'][$clave]['age'] =$valor['user']['age'];
        }
//        var_dump($Logs);
//        $Log['users']=$Logs;
//        dd($Log);
        return $Log;
    }
}