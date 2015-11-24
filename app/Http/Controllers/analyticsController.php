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
        $campaign = Campaign::find($id); //busca la campaña
//        $campaign = Campaign::where('_id',$id)->Lists('name','administrator_id','interaction'); //busca la campaña
//        $campaign = Campaign::where('_id',$id)->get(array('name','administrator_id','interaction')); //busca la campaña
//        $campaign=$campaign->toArray();
//        dd($campaign);
        //valida que la campaña le pertenezca al usuario

        if ($campaign && $campaign->administrator_id == auth()->user()->_id){
            if (method_exists($this, $type) && $type==!null) { //se verifica que el tipo sea valido y no nulo
                $graph= $this->$type($campaign['_id']); //se llama el metodo correspondiente
            }else{
                $graph= $this->intPerDay();//default y si es un tipo diferente
            }
//            $data=array_merge($campaign->toArray(),$graph->toArray());
//            $campaign->append(array('users'=> $graph));
//            dd($campaign);
            return view('analytics.single', $campaign);
        }else {
            return redirect()->route('campaigns::index')->with('data', 'errorCamp');
//            return redirect()->action('CampaignsController@index')->with('data', 'error');
        }
    }

    private function intPerDay($id)
    {
//        echo $id;
    }

    private function genderAge($id)
    {
//        echo $id;
        $Logs = CampaignLog::groupBy('user')->where('campaign_id',$id)->get(array('user'));
//        $Logs=$Logs->toArray();
//        $Log['users']=$Logs;
//        dd($Log);
        return $Logs;
    }
}