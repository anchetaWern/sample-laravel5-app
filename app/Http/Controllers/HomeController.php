<?php

namespace App\Http\Controllers; 
/*
always include this at the very top of every controller. This specifies which folder this controller is stored.
*/


use Illuminate\Routing\Controller as BaseController; //always include this before defining the class

use Illuminate\Http\Request; //always include this when you need to work with form inputs

use Auth;

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
		attempt to log the user in with the email and password
		the attempt() method returns true if the email and password is correct.
		it also automatically creates a session for the user.
		*/
		if(Auth::attempt(['email' => $email, 'password' => $password])){

			return redirect('admin'); //redirect to the admin route
		}

		/*
		redirect to the home page with a custom message which contains an error. 
		This custom message is what's being checked for in the app/views/partials/alert.blade.php

		@if(session('message'))
			<div class="alert alert-{{ session('message.type') }}">
				{{ session('message.text') }}
			</div>
		@endif
		*/
		return redirect('/')->with('message', ['type' => 'danger', 'text' => 'Incorrect credentials']);

	}

}
