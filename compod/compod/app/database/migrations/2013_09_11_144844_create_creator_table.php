<?php

use Illuminate\Database\Migrations\Migration;

class CreateCreatorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('creator', function($table)
            {
		 $table->increments('id')->unsigned();
                 $table->integer('user');
                 $table->integer('episode');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('creator');
	}

}