<?php

namespace Publishers\Http\Middleware;

use Auth;
use Closure;
use Publishers\Administrator;
use Publishers\Libraries\PreviewHelper;
use Request;

class PreviewMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = $request->route()->getName();
        $user = Administrator::where('_id', Auth::user()->_id)->first();
        $test = isset($user->route) ? $user->route : [];
        $diff = array_unique($test);
        if ($route != "home" && $route != "campaigns::show" && $route != "campaigns::sub" && $route != 'campaigns::store' && $route != 'campaigns::save_item' && $route != 'budget::conekta' && $route != 'auth.logout') {
            array_unshift($diff, PreviewHelper::getNameRoute($route) . '/' . $route);
        }
        if (count($diff) > 5) {
            array_pop($diff);
        }
        $user->route = $diff;

        $user->tour_taken=true;
        $user->save();
        return $next($request);
    }
}
