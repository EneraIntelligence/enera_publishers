<?php
/**
 * Created by PhpStorm.
 * User: usuario
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
     return 'menu reportes';
    }

    public function single()
    {
        return 'hola prueba';
    }
    
}