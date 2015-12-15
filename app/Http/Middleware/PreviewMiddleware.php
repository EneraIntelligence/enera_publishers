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
        if (auth()->check()) {
            $route = Request::route()->getName();
            $test = isset(auth()->user()->route) ? auth()->user()->route : [];
            $diff = array_unique($test);
            if ($route != "home" && $route != "campaigns::show") {
                array_unshift($diff, PreviewHelper::getNameRoute($route) . '/' . $route);
            }
            if (count($diff) > 5) {
                array_pop($diff);
            }
            auth()->user()->route = $diff;
            auth()->user()->save();
        }
        return $next($request);
    }
}
