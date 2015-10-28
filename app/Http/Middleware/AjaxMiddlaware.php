<?php

namespace Publishers\Http\Middleware;

use Closure;

class AjaxMiddlaware
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
        if (!$request->ajax()) {
            return response('Unauthorized.', 401);
        }
        return $next($request);
    }
}
