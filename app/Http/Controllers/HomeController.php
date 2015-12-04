<?php

namespace App\Http\Controllers; 
/*
always include this at the very top of every controller. This specifies which folder this controller is stored.
*/


use Illuminate\Routing\Controller as BaseController; //always include this before defining the class

use Illuminate\Http\Request; //always include this when you need to work with form inputs

/*
defining the controller class.
this should always be the same as the filename.
So HomeController should have a filename of HomeController.php
*/
class HomeController extends BaseController {
    
	public function index(){
		/*
		the view function allows you to return a view,
		it accepts 2 arguments: the name of the view and optionally the data that you want to pass to the view
		
		views are located in the resources/views directory.

		the name of the view below is login so you can find it 
		on the resources/views/login.blade.php file

		views can either have plain .php extension or .blade.php which allows you to use the blade templating engine.
		
		more info here:
		http://laravel.com/docs/5.0/views
		http://laravel.com/docs/5.0/templates
		*/
		return view('login');
	}

	/*
	always inject Request $request as a parameter 
	if you want to get input data from forms
	*/
	public function login(Request $request){ 

		//code for getting input data
		$email = $request->input('email'); 
		/* 
		the name attribute of the corresponding input should be email:  
		<input type="text" name="email">
		*/

		$password = $request->input('password');

		/*
		todo:
		add code for logging user and creating sessions here
		*/

		return redirect('admin'); 
		/*
		redirect to the admin page
		you should define a route for the admin page in the app/Http/routes.php file for this to work:

		Route::get('/admin', 'AdminController@index');
		*/
	}

}
