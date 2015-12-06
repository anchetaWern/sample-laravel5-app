<?php
/*
this file is an example of a middleware.
Middlewares are piece of code that can be executed by laravel on every request or on specific requests.

This specific middleware is executed before a specific route 
responds to a request. What it does is to check if a user is not currently logged in.
If there's no user that's currently logged in, it redirects to the homepage with an error message. Otherwise
it continues with processing the request by returning the control back to the Controller method that was used
in that route. 

Middlewares can be registered on the app/Http/Kernel.php file
*/
namespace App\Http\Middleware;

use Closure;
use Auth; //allows us to use the Auth class.

class CheckLogin
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) { //check if a user is not logged in.
            //redirect to the homepage with an error message
            return redirect('/')->with('message', [
                'type' => 'error',
                'text' => 'You need to login'
            ]);
        }

        return $next($request); //give the control back to the Controller method.
    }

}