<?php namespace App\Repositories;

use App\Models\RecipeIngredient;
use App\RepositoryInterfaces\RecipeIngredientInterface;

class RecipeIngredientRepository extends BaseRepository implements RecipeIngredientInterface
{
	public function __construct(
			IngredientRepository $ingredient,
			UnitRepository $unit
		)
	{
		$this->ingredient = $ingredient;
		$this->unit = $unit;
	}

	public function allByRecipeId($recipe_id)
	{
		$recipe_ingredients = RecipeIngredient::where([
				'recipe_id' => $recipe_id
			])->get();

		return $recipe_ingredients;
	}

	public function store($recipe_id, $amount, $unit, $ingredient, $optional, $substitution)
	{
		$unit_id = $this->unit->firstOrCreate($unit);
		$ingredient_id = $this->ingredient->firstOrNew($ingredient);

		RecipeIngredient::create([
			'recipe_id' => $recipe_id,
			'amount' => $amount,
			'unit_id' => $unit_id,
			'ingredient_id' => $ingredient_id,
			'optional' => $optional,
			'substitution' => $substitution
		]);

		// return $ingredient_id;
		return true;
	}
}