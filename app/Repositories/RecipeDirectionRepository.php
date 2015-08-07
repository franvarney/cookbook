<?php namespace App\Repositories;

use App\Models\RecipeDirection;
use App\RepositoryInterfaces\RecipeDirectionInterface;

class RecipeDirectionRepository extends BaseRepository implements RecipeDirectionInterface
{
	public function allByRecipeId($recipe_id)
	{
		$directions = RecipeDirection::where([
				'recipe_id' => $recipe_id
			])->get();

		return $directions;
	}

	public function store($recipe_id, $direction)
	{
		$direction = RecipeDirection::create([
				'recipe_id' => $recipe_id,
				'direction' => $direction
			]);

		//return $direction->id;
		return true;
	}
}