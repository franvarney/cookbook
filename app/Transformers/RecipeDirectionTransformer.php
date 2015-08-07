<?php namespace App\Transformers;

use App\Models\RecipeDirection;
use App\Transformers\RecipeDirectionTransformer;
use League\Fractal\TransformerAbstract;

class RecipeDirectionTransformer extends TransformerAbstract
{
	public function transform(RecipeDirection $recipe_direction)
	{
		return [
				'direction' => $recipe_direction->direction
			];
	}
}
