<?php

namespace Publishers\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->auth->check()) {
            session(['url' => $request->route()->getName()]);
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('auth.index');
            }
        } elseif ($this->auth->check()) {
            if ($this->auth->user()->status == 'active') {
                if ($request->session()->has('url')) {
                    $url = $request->session()->pull('url', 'default');
                    $request->session()->forget('url');
                    return redirect()->route($url);
                }else{
                    return $next($request);
                }
            } else {
                $this->auth->logout();
                return redirect()->route('auth.index');
            }
        }
    }
}
