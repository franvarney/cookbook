<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributorPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contributor_permissions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('contributor_id')->unsigned();
			$table->boolean('can_add_contributors')->default(0);
			$table->boolean('can_edit_cookbook')->default(0);
			$table->boolean('can_delete_cookbook')->default(0);
			$table->boolean('can_edit_recipe')->default(0);
			$table->boolean('can_delete_recipe')->default(0);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('contributor_id')->references('id')->on('contributors');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contributor_permissions');
	}

}
