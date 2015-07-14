<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeDirectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recipe_directions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('recipe_id')->unsigned();
			$table->text('direction');
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('recipe_id')->references('id')->on('recipes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recipe_directions');
	}

}
