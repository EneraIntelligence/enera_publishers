<?php
/**
 * Created by PhpStorm.
 * User: pedroluna
 * Date: 2/17/16
 * Time: 5:47 PM
 */

namespace Publishers\Libraries;


use Exception;
use File;
use \Illuminate\Http\Request;
use Publishers\Issue;
use Session;

class IssueTrackerHelper
{
    /**
     * @param Request $request
     * @param Exception $e
     * @param $plataform
     * @internal param array $data
     */
    public static function create(Request $request, Exception $e, $plataform)
    {
        /* Genera URL actual */
        if (count($_GET) > 0) {
            $url = '?';
            foreach ($_GET as $k => $v) {
                $url .= $k . '=' . $v . '&';
            }
        } else {
            $url = '';
        }

        /* Extrae el contexto del archivo */
        $context = '';
        $file = file($e->getFile());
        $i = $e->getLine() > 10 ? $e->getLine() - 10 : 0;
        for ($i; $i <= $e->getLine() + 10; $i++) {
            $context .= isset($file[$i]) ? $file[$i] : '';
        }

        /* Creacion de Issue */
        $instance = explode('\\', get_class($e));
        Issue::create([
            // 'msg' => $e->getMessage() != '' ? $e->getMessage() : 'IssueTracket Error',
            'msg' => $instance[count($instance) - 1] . ' ' . $request->method() . ' /' . $request->path(),
            'request' => [
                'url' => $request->url() . $url,
                'host' => gethostname(),
                'platform' => $plataform,
                'environment' => env('APP_ENV', 'local'),
                'session_vars' => Session::all(),
            ],
            'file' => [
                'line' => $e->getLine(),
                'path' => str_replace(base_path(), '', $e->getFile()),
                'context' => $context,
            ],
            'exception' => [
                'msg' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
            ],
            'responsible_id' => 0,
            'priority' => 'error',
            'status' => 'pending',
            'history' => [],
        ]);
    }
}