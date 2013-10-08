<?php

use Illuminate\Database\Migrations\Migration;

class CreateUserSkillTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('user_skill', function($table)
            {
		 $table->increments('id')->unsigned();
                 $table->integer('user');
                 $table->integer('skill');
                 $table->integer('active')->default(1);
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('user_skill');
	}

}