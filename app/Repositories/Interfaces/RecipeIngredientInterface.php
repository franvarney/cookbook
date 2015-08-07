<?php namespace App\RepositoryInterfaces;

interface RecipeIngredientInterface extends BaseInterface {

	public function allByRecipeId($recipe_id);
	public function store($recipe_id, $amount, $unit, $ingredient, $optional, $substitution);

}
