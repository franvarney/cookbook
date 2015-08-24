<?php namespace App\Transformers;

use App\Models\RecipeDirection;
use League\Fractal\TransformerAbstract;
use App\Transformers\RecipeDirectionTransformer;

class RecipeDirectionTransformer extends TransformerAbstract
{
	public function transform(RecipeDirection $recipe_direction)
	{
		return [
			'direction' => $recipe_direction->direction
		];
	}
}
