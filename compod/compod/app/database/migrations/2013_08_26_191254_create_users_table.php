<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('users', function($table)
            {
                $table->increments('id')->unsigned();
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->string('password');
                $table->integer('active')->default(1);
                $table->timestamps();
                $table->string('tagline', 125)->default("I love community podcast!");
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('users');
	}

}