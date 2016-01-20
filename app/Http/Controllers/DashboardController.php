<?php

namespace Publishers\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Publishers\CampaignLog;
use Publishers\Device;
use Publishers\Branche;
use Publishers\Campaign;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $logs = CampaignLog::all();
        $devices = Device::count();     //total de devices detectados en enera
        $campañas = Campaign::where('status','active')->count();  //total de campañas en to-do enera
        $sitios = Branche::count();     //total de  branches en enera

        $osLabels = array();
        $osCount = array();
        $osTotal = 0;

        foreach ($logs as $log) {
            if (isset($log->device['os'])) {
                $key = array_search($log->device['os'], $osLabels);
                //echo $log->device['os'].": ".$key."<br>";
                if ($key !== false) {
                    $osCount[$log->device['os']]++;
                    $osTotal++;
                } else {
                    $osLabels[] = $log->device['os'];
                    $osCount[$log->device['os']] = 1;
                    $osTotal++;
                }

            }
        }

        return view('dashboard.index', [
            'logs' => $logs,
            'osStats' => $osCount,
            'total' => $osTotal,
            'devices' => $devices,
            'campañas' => $campañas,
            'sitios' => $sitios
        ]);
    }
}
