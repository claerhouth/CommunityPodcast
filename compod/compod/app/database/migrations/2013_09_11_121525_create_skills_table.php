<?php

use Illuminate\Database\Migrations\Migration;

class CreateSkillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('skills', function($table)
            {
		 $table->increments('id')->unsigned();
                 $table->string('skill',15)->unique();
                 $table->text('description');
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
		Schema::drop('skills');
	}

}