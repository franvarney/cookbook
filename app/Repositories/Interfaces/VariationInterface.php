<?php namespace App\RepositoryInterfaces;

interface VariationInterface extends BaseInterface {

	public function allByRecipeId($recipe_id);

}
