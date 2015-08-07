<?php namespace App\Repositories;

use App\RepositoryInterfaces\VariationInterface;
use App\Variation;

class VariationRepository extends BaseRepository implements VariationInterface
{
	protected $modelClassName = 'Variation';

	public function allByRecipeId($recipe_id)
	{
		$where = call_user_func_array("App\\$this->modelClassName::where", array('recipe_id', $recipe_id));
		return $where->get();
	}
}