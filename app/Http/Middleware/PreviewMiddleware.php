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
        $test = isset($user->routePublisher) ? $user->routePublisher : [];
        $accept = ['home', 'campaigns::show', 'campaigns::sub', 'campaigns::store','campaigns::save_item',
                   'budget::conekta', 'auth.logout', 'edit.profile'];
        if (!in_array($route, $accept)) {
            array_unshift($test, PreviewHelper::getNameRoute($route) . '/' . $route);
        }
        if (count($test) > 5) {
            array_pop($test);
        }
        $diff = array_unique($test);
        $user->routePublisher = $diff;
        $user->tour_taken=true;
        $user->save();
        return $next($request);
    }
}
