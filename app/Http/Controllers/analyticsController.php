<?php
/**
 * Created by PhpStorm.
 * User: asdrubal
 * Date: 11/11/15
 * Time: 1:22 PM
 */

namespace Publishers\Http\Controllers;

use Publishers\CampaignLog;

class AnalyticsController extends Controller
{

    public function index()
    {
        return view('analytics.index');
    }

    /**
     *
     */
    public function single()
    {
        $log = CampaignLog::all();
        return view('analytics.single', ['logs' => $log]);
    }
}