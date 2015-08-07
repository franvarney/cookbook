<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Model::unguard();

		$this->call('UserTableSeeder');
		$this->call('RoleTableSeeder');
		$this->call('UnitTableSeeder');
		$this->call('IngredientTableSeeder');
		$this->call('CookbookTableSeeder');
		$this->call('RecipeTableSeeder');
		$this->call('RecipeIngredientTableSeeder');
		$this->call('RecipeDirectionTableSeeder');
		// TODO:
		// images
		// cookbook_images
		// image_recipe
		$this->call('ContributorTableSeeder');
		$this->call('VariationTableSeeder');
		$this->call('ContributorPermissionTableSeeder');
		$this->call('ContributorRequestTableSeeder');
		$this->call('FavoriteTableSeeder');
		$this->call('TagTableSeeder');
		$this->call('RecipeTagTableSeeder');
		$this->call('CommentTableSeeder');
		$this->call('CommentRecipeTableSeeder');

		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
