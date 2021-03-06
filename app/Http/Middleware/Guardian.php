<?php

namespace Publishers\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Publishers\Libraries\NamespaceDetector;

class Guardian
{
    protected $detector;

    public function __construct()
    {
        $this->detector = new NamespaceDetector();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $app = $this->detector->getAppNamespace();
            $route = $request->route()->getName();
            $admin = auth()->user();
            $platforms = isset($admin) ? $admin->role->platform : [];

            if (in_array($app, $platforms)) {
                if (in_array($route, $admin->role->permissions[$app])) {
                    return redirect()->route('home')->with([
                        'n_type' => 'danger',
                        'n_timeout' => 5000,
                        'n_msg' => 'No cuentas con los permisos necesarios.'
                    ]);
                }
            } else {
                if (count($platforms) > 1) {
                    return redirect()->route('choose.platform', ['platform' => $platforms]);
                } elseif (count($platforms) == 1) {
                    return redirect()->away('http://' . strtolower($platforms[0]) . '.enera-intelligence.mx')->with([
                        'n_type' => 'info',
                        'n_timeout' => 5000,
                        'n_msg' => 'Tu cuenta solo permite acceso a esta plataforma.'
                    ]);
                } else {
                    return redirect()->away('http://enera.mx');
                }
            }
        }
        return $next($request);
    }
}
