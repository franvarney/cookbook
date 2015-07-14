<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCookbookImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cookbook_image', function(Blueprint $table)
		{
			$table->integer('cookbook_id')->unsigned();
			$table->integer('image_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('cookbook_id')->references('id')->on('cookbooks');
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
		Schema::drop('cookbook_image');
	}

}
