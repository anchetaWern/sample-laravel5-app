<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//the route for the home page is always indicated by a forward slash
Route::get('/', 'HomeController@index');

/*
the route that listens for POST requests in the login page.
when the login form is submitted this route is triggered
because in the login view (resources/views/login.blade.php)
we have specified that the form is submitted via POST method
and the action is /login:

<form method="POST" action="/login">
	...
</form>

So if you have defined the form like so:

<form method="GET" action="/some/route">
	...
</form>

Your route definition would look like this:
Route::get('/some/route', 'HomeController@login');

'HomeController' is the name of the controller that will respond to
this route and 'login' is the name of the method that will 
be executed. Controllers are located at app/Http/Controllers folder
and since we've specified the name of the controller
is HomeController, the filename as well as the classname 
of the controller should be HomeController. See app/Http/Controllers/HomeController.php file for an example
*/
Route::post('/login', 'HomeController@login');

Route::get('/admin', 'AdminController@index');