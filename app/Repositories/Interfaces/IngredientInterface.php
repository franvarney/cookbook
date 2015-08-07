<?php namespace App\RepositoryInterfaces;

interface IngredientInterface extends BaseInterface {

	public function findByIngredient($ingredient);
	public function firstOrNew($ingredient);

}
