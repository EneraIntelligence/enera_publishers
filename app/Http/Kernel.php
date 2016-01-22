<?php

namespace Publishers\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Publishers\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Publishers\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Publishers\Http\Middleware\Authenticate::class,
        'auth.ready' => \Publishers\Http\Middleware\AuthReadyMiddleware::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \Publishers\Http\Middleware\RedirectIfAuthenticated::class,
        'ajax' => \Publishers\Http\Middleware\AjaxMiddlaware::class,
        'preview' => \Publishers\Http\Middleware\PreviewMiddleware::class,
        'guardian' => \Publishers\Http\Middleware\Guardian::class,
    ];
}
