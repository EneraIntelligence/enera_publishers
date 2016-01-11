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

        if ($route != "home" && $route != "campaigns::show" && $route != "campaigns::sub" && $route != 'campaigns::store'
            && $route != 'campaigns::save_item' && $route != 'budget::conekta' && $route != 'auth.logout'
            && $route != 'edit.profile') {
            array_unshift($test, PreviewHelper::getNameRoute($route) . '/' . $route);
        }
        if (count($test) > 5) {
            array_pop($test);
        }
        $diff = array_unique($test);
        $user->route = $diff;
        $user->save();
        return $next($request);
    }
}
