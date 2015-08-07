<?php namespace App\Repositories;

use App\Models\Ingredient;
use App\RepositoryInterfaces\IngredientInterface;

class IngredientRepository extends BaseRepository implements IngredientInterface
{
	public function findByIngredient($ingredient)
	{
		$ingredient = Ingredient::where([
				'ingredient' => $ingredient
			]);

		return $ingredient;
	}

	public function firstOrNew($ingredient)
	{
		$ingredient = Ingredient::firstOrNew([
				'ingredient' => $ingredient
			]);

		$ingredient->count = $new_ingredient->count + 1;
		$ingredient->save();

		return $ingredient;
	}
}