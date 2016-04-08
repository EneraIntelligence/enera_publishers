<?php

namespace Publishers\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use MongoClient;
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
        $devices = Device::count();     //total de devices detectados en enera
        $campañas = Campaign::where('status', 'active')->count();  //total de campañas en to-do enera
        $sitios = Branche::where('status', 'active')->count();     //total de  branches en enera

        $osLabels = array();
        $osTotal = 0;

        $collection = DB::getMongoDB()->selectCollection('devices');
        $osCount = $collection->aggregate([
            [
                '$match' => [
                    'os' => [
                        '$exists' => true
                    ]
                ]
            ],
            [
                '$group' => [
                    '_id' => '$os',
                    'total' => ['$sum' => 1]
                ]
            ],
            [
                '$sort' => ['total' => -1]
            ]
        ]);

        return view('dashboard.index', [
            'osStats' => $osCount,
            'total' => $osTotal,
            'devices' => $devices,
            'campañas' => $campañas,
            'sitios' => $sitios
        ]);
    }


}
