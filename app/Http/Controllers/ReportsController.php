<?php
/**
 * Created by PhpStorm.
 * User: asdrubal
 * Date: 09/11/15
 * Time: 1:11 PM
 */

namespace Publishers\Http\Controllers;

use Publishers\Libraries\CampaignStyleHelper;
use Validator;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Sftp\SftpAdapter;
use League\Flysystem\Filesystem;
use Input;
use Illuminate\Http\Request;
use Auth;


class ReportsController extends Controller
{
    
    public function index()
    {
        return view('reports.index',  ['user' => Auth::user()]);
    }

    public function single()
    {
        return view('reports.single', ['user' => Auth::user()]);
    }
    
}