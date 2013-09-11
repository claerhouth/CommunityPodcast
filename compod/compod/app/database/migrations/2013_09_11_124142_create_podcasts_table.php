<?php

use Illuminate\Database\Migrations\Migration;

class CreatePodcastsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('podcasts', function($table)
            {
		 $table->increments('id')->unsigned();
                 $table->string('name',50)->unique();
                 $table->text('description');
                 $table->integer('inviteOnly')->default(0);
                 $table->integer('active')->default(1);
                 $table->timestamps();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('podcasts');
	}

}