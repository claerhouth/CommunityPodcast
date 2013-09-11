<?php

use Illuminate\Database\Migrations\Migration;

class CreateUserTopicTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('user_podcast', function($table)
            {
		 $table->increments('id')->unsigned();
                 $table->integer('user');
                 $table->integer('podcast');
                 $table->integer('active')->default(1);
                 $table->integer('creator')->default(0);
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('user_podcast');
	}

}