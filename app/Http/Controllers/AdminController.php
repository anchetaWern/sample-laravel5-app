<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use Auth;
use Validator;
use DB;

class AdminController extends BaseController {

	
	public function index(){
		/*
		returns the view at: resources/views/admin/dashboard.blade.php
		note that you can create any number of nested folders inside the resources/views folder:
			resources
				views
					admin
						some
							other
								folder
									view.blade.php

		you can then refer to view.blade.php as: admin.some.other.folder.view
		*/
		return view('admin.dashboard');		
	}


	public function createUser(){
		//returns the view at: resources/views/admin/create_user.blade.php
		return view('admin.create_user');
	}


	public function doCreateUser(Request $request){

		/*
		this is how forms are validated. You make use of the make method in the Validator class
		this accepts 2 arguments: the first is the form input that you want to validate.
		$request->all() simply returns all the data inputted by the user in the form.
		the second argument is an associative array containing the validation rules.
		the key should be the name attribute that you gave to the field and the value is a string
		containing the actual validation rules to be applied to the field.
		in the example below, email is the field that's being validated so the input in your view
		should look something like this: (note that the value for the name attribute is the same as the key
		that was used)
			<input type="email" name="email">

		the validation rules are separated by the pipe symbol (|) so for the email, the rules are required, email and unique
		required means that the user should input a value into the field
		email means that it should be a valid email
		and unique:users means that the value should not already exist in the users table	

		more info about validation here: http://laravel.com/docs/5.1/validation
		*/
		$validator = Validator::make($request->all(), [
			'email' => 'required|email|unique:users',
			'password' => 'required|min:10',
		]);

		//check if the validation fails. This returns true if any of the validation rules are not satisfied
        if ($validator->fails()) {
            return redirect('/user/create') //redirect to the /user/create route
                        ->withErrors($validator) //returns the errors
                        ->withInput(); //returns the user input. in the view, you can retrive user input by calling the old() function which accepts the name of the field as its argument
        }

        //the following gets executed when the validation passes
		$email = $request->input('email');  //gets the email
		$password = $request->input('password');  //gets the password

		//create a new row in the users table
		DB::table('users')->insert([
			'email' => $email, 
			'password' => bcrypt($password) //bcrypt encrypts the password
		]);

		return redirect('/user/create')
			->with('message', ['type' => 'success', 'text' => 'User Created!']); //redirect to the /user/create route
	}


	public function users(Request $request){

		if($request->has('email')){ //check if the user has entered any value to the search field
			$email = $request->input('email');
			$users = DB::table('users')->where('email', 'like', "%$email%")->get(); //use the value for the query
		}else{
			$users = DB::table('users')->take(10)->get(); //the take() method allows you to limit the number of rows to return
		}

		$page_data = array(
			'users' => $users,
			'token' => csrf_token() //generate the token to be used when deleting users
		);

		return view('admin.users', $page_data);

	}


	public function user($id){ //$id contains the value that was passed in the {$id} in the route

		//select the 
		$user = DB::table('users')->where('id', '=', $id)
			->first();
		//the first() method returns only the first result, as opposed to the get() method which returns all the results

		$page_data = array(
			'user' => $user
		);

		return view('admin.user', $page_data);
	}


	public function updateUser(Request $request){

		$id = $request->input('id'); //user id stored in the hidden input field

		/*
		the unique validation rule accepts the name of the table, name of the field to check for uniqueness
		as its required arguments
		but it also accepts a third and fourth arguments:
			the third is the primary key value for that row. 
			the fourth is the name of the field containing the primary key. This is usually the id field
		*/
		$validator = Validator::make($request->all(), [
			'email' => 'required|email|unique:users,email,' . $id . ',id', 
			'password' => 'min:10', //password no longer required since we'll just use the one that's already in the database if the user did not supply any
		]);


		if ($validator->fails()) {
		    return redirect("/user/" . $id) 
		                ->withErrors($validator) 
		                ->withInput(); 
		}

		$email = $request->input('email');  
		$password = $request->input('password'); 

		$user_data = [
			'email' => $email
		];

		if($request->has('password')){ //check if user has inputted a new password

			$user_data['password'] = bcrypt($password); //push a new item into the user data
		}

		//update the user
		DB::table('users')
			->where('id', $id)
			->update($user_data);

		return redirect('/user/' . $id)
			->with('message', ['type' => 'success', 'text' => 'User Updated!']); 


	}


	public function deleteUser(Request $request){

		$id = $request->input('id');
		DB::table('users')->where('id', $id)->delete();

		return 'ok';

	}


	public function logout(){

		Auth::logout(); //logout the user. this clears the current session

		//redirect to the home page with a success message
		return redirect('/')
			->with('message', ['type' => 'success', 'text' => 'You are now logged out']);

	}

}
