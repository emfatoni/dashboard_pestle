<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConditionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conditions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('condition');
			$table->text('url');
			$table->string('website');
			$table->date('date');

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
		Schema::drop('conditions');
	}

}
