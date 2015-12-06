<?php
/*
seeders are used for filling the database tables with data.
usually what you would do when you want to add data to be used for testing
is to access phpmyadmin or another database management tool so that you can manually 
enter some data. With seeders and the faker library you can do that without having to
invent fake data to enter. Faker generates the data for you and you can run the seeder
every time you want to test something.

you can create a seeder by executing:
	php artisan make:seeder name_of_your_seeder

this will generate a new file at: database/seeds

the run() method is where the code for populating the table is located.

once you have added the code, open the database/seeds/DatabaseSeeder.php file and call the seeder inside the run() method:
	
	$this->call(users_table_seeder::class);

users_table_seeder is the name of the class.	

to run the seeder:
	
	php artisan db:seed

executing the command above will insert rows to the table that you've specified

more info here: http://laravel.com/docs/5.1/seeding 
*/
use Illuminate\Database\Seeder;


class users_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//fake is a library used for generating fake data: https://github.com/fzaninotto/Faker
    	$faker = Faker\Factory::create();

		DB::table('users')->truncate(); //delete all the contents of the users table

		for($x = 0; $x <= 20; $x++){ //loop 20 times to fill the users table with 20 fake users.

			$email = $faker->unique()->email; //generate fake email

			//insert user to the table
		    DB::table('users')->insert([	
		      'email' => $email,
		      'password' => bcrypt('secret') //same password for all users
		    ]);
		}
    	
    }
}
