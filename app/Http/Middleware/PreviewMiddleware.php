<?php

namespace Publishers\Http\Middleware;

use Auth;
use Closure;
use Publishers\Administrator;

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
        $route = \Request::route()->getName();
        $user = Administrator::where('_id', Auth::user()->_id)->first();
        $diff = isset($user->route) ? $user->route : [];
        if ($route != "home" && $route != "campaigns::show")
            array_unshift($diff, $route);
        if (count($diff) > 5) {
            array_pop($diff);
        }
        $user->route = $diff;
        $user->save();
        return $next($request);
    }
}
