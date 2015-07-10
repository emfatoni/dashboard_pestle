<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('title');
			$table->text('url');
			$table->string('website');
			$table->text('summary');
			$table->string('sentiment');
			$table->string('keyword');

			$table->integer('id_metric')->unsigned();
			$table->foreign('id_metric')->references('id')->on('metrics');

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
		Schema::drop('news');
	}

}
