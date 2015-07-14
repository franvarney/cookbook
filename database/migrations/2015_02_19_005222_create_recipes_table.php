<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recipes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('cookbook_id')->unsigned();
			$table->string('title');
			$table->string('prep_time');
			$table->string('cook_time');
			$table->decimal('yields_amount');
			$table->integer('unit_id')->unsigned();
			$table->string('description')->nullable();
			$table->boolean('is_public')->default(1);
			$table->string('password', 100)->nullable();
			$table->string('source_url')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('cookbook_id')->references('id')->on('cookbooks');
			$table->foreign('unit_id')->references('id')->on('units');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recipes');
	}

}
