<?php namespace App\RepositoryInterfaces;

interface RecipeDirectionInterface extends BaseInterface {

	public function allByRecipeId($recipe_id);
	public function store($recipe_id, $direction);

}
