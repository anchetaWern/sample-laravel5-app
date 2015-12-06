<?php
/*
database migrations are used to create, alter (add, remove or update existing fields), 
or drop a table. 
This is specifically useful for teams. Database migrations allows for easily sharing 
database changes to the members of the team. Without database migrations what you 
would usually do is to export the database to an sql file and then each of the other members of the
team would import it using a tool like phpmyadmin. With database migrations all you have to do
is push the migration file into the repository and the other members can pull it from there and then run
the migration for the changes to take effect on their copy of the database.
you can run this migration on the database by executing the following command on the terminal while you're
on the root directory of the project:

    php artisan migrate 

This executes the up() function below

If you want to revert the changes made by the migration files that we're executed in the last migrate:

    php artisan migrate:rollback

This executes the down() method which drops the users table from the database

more information about migrations and the schema builder here: http://laravel.com/docs/5.1/migrations
*/
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create the users table
        Schema::create('users', function(Blueprint $table){
            $table->increments('id'); //add an auto-increment field (auto-increment fields  are set as the primary key by default)
            $table->string('email'); //add a string field named email
            $table->string('password');
            $table->rememberToken(); //add a remember_token field
            $table->timestamps(); //add timestamp fields: created_at and updated_at
        });

    }   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users'); //drops the users table from the database
    }
}
