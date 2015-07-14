<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeIngredientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recipe_ingredients', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('recipe_id')->unsigned();
			$table->string('amount')->nullable();
			$table->integer('unit_id')->unsigned();
			$table->integer('ingredient_id')->unsigned();
			$table->boolean('optional')->default(0);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('recipe_id')->references('id')->on('recipes');
			$table->foreign('unit_id')->references('id')->on('units');
			$table->foreign('ingredient_id')->references('id')->on('ingredients');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recipe_ingredients');
	}

}
