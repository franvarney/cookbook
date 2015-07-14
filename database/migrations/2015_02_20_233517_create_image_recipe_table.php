<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageRecipeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('image_recipe', function(Blueprint $table)
		{
			$table->integer('recipe_id')->unsigned()->index();
			$table->integer('image_id')->unsigned()->index();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('recipe_id')->references('id')->on('recipes');
			$table->foreign('image_id')->references('id')->on('images');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('image_recipe');
	}

}
