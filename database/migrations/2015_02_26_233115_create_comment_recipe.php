<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentRecipe extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comment_recipe', function(Blueprint $table)
		{
			$table->integer('recipe_id')->unsigned()->index();
			$table->integer('comment_id')->unsigned()->index();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('recipe_id')->references('id')->on('recipes');
			$table->foreign('comment_id')->references('id')->on('comments');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comment_recipe');
	}

}
