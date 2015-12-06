<?php
/*
this is where you register custom middlewares that you have created.
*/
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */

    //these are the middlewares that are executed on every request on the application
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    
    /*
    these are the middlewares that can be used for routes.
    the last item in the array below is the custom middleware that is at: app/Http/Middleware/CheckLogin.php
    the array key is the name of the middleware and the value is the path to where the Middleware is.
    Once registered, the name can be used in a route or route group so that the middleware would
    get executed every time that specific route or route group gets called.
    */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'user.is_loggedin' => \App\Http\Middleware\CheckLogin::class 
    ];
}
