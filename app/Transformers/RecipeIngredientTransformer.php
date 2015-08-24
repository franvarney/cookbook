<?php namespace App\Transformers;

use App\Models\RecipeIngredient;
use League\Fractal\TransformerAbstract;
use App\Transformers\RecipeIngredientTransformer;

class RecipeIngredientTransformer extends TransformerAbstract
{
	public function transform(RecipeIngredient $recipe_ingredient)
	{
		$optional = $recipe_ingredient->optional ? ' (optional)' : '';

		return [
			'amount' => $recipe_ingredient->amount,
			'unit' => $recipe_ingredient->unit->unit,
			'ingredient' => $recipe_ingredient->ingredient->ingredient,
			'optional' => (bool) $recipe_ingredient->optional,
			'full' => $recipe_ingredient->amount . ' ' . $recipe_ingredient->unit->unit . ' '
				. $recipe_ingredient->ingredient->ingredient . $optional
		];
	}
}
