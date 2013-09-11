<?php

use Illuminate\Database\Migrations\Migration;

class CreateEpisodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('episodes', function($table)
            {
		 $table->increments('id')->unsigned();
                 $table->string('title',100);
                 $table->text('description');
                 $table->integer('podcast');
                 $table->string('file',250);
                 $table->integer('active')->default(1);
                 $table->timestamp('publishdate');
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
            Schema::drop('episodes');
	}

}