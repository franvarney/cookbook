<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributorRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contributor_requests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sender_user_id')->unsigned();
			$table->integer('cookbook_id')->unsigned();
			$table->integer('receiver_user_id')->unsigned();
			$table->boolean('approved')->default(0);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('cookbook_id')->references('id')->on('cookbooks');
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contributor_requests');
	}

}
