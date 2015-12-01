<?php

namespace Publishers\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use Publishers\CampaignLog;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $logs = CampaignLog::all();

        $osLabels = array();
        $osCount = array();

        foreach($logs as $log)
        {
            if(isset($log->device['os']))
            {
                $key = array_search($log->device['os'], $osLabels);
                //echo $log->device['os'].": ".$key."<br>";
                if($key!==false)
                {
                    $osCount[$log->device['os']]++;
                    //$osTotal++;
                }
                else
                {
                    $osLabels[] = $log->device['os'];
                    $osCount[$log->device['os']]=1;
                    //$osTotal++;
                }
            }
        }


        return view('dashboard.index', ['user' => Auth::user(), 'logs' => $logs, 'osStats'=>$osCount]);
    }
}
