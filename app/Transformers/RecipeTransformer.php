<?php namespace App\Transformers;

use App\Models\Recipe;
use App\Transformers\CookbookTransformer;
use App\Transformers\RecipeDirectionTransformer;
use App\Transformers\RecipeIngredientTransformer;
use App\Transformers\UserTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class RecipeTransformer extends TransformerAbstract
{
	public function __construct(
			Manager $manager,
			CookbookTransformer $cookbook_transformer,
			RecipeDirectionTransformer $direction_transformer,
			RecipeIngredientTransformer $ingredient_transformer,
			UserTransformer $user_transformer
		)
	{
		$this->manager = $manager;
		$this->cookbook_transformer = $cookbook_transformer;
		$this->direction_transformer = $direction_transformer;
		$this->ingredient_transformer = $ingredient_transformer;
		$this->user_transformer = $user_transformer;
	}

	function transformExtra($type, $data, $transformer, $manager)
	{
		$items = $type === 'item' ? new Item($data, $transformer) : new Collection($data, $transformer);
		$result = $manager->createData($items)->toArray();

		return $result['data'];
	}

	public function transform(Recipe $recipe)
	{
		$rec = array(
				'title' => $recipe->title,
				'description' => $recipe->description,
				'prep_time' => $recipe->prep_time,
				'cook_time' => $recipe->cook_time,
				'yields' => $recipe->yields_amount . ' ' . $recipe->unit->unit,
				'url' => '/recipe/' . $recipe->id,
				'public' => (bool) $recipe->is_public,
				//'tags' => $recipe->tags,
				'created' => date('m/d/y', strtotime($recipe->created_at)),
				'updated' => date('m/d/y', strtotime($recipe->updated_at))
			);

		$rec['cookbook'] = $this->transformExtra('item', $recipe->cookbook, $this->cookbook_transformer, $this->manager);
		$rec['creator'] = $this->transformExtra('item', $recipe->user, $this->user_transformer, $this->manager);

		if ($recipe->directions) {
			$rec['directions'] = $this->transformExtra('collection', $recipe->directions, $this->direction_transformer, $this->manager);
		}

		if ($recipe->ingredients) {
			$rec['ingredients'] = $this->transformExtra('collection', $recipe->ingredients, $this->ingredient_transformer, $this->manager);
		}

		return $rec;
	}
}
