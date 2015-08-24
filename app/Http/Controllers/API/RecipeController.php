<?php namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Models\Unit;
use App\Models\Recipe;
use App\Http\Requests;
use GuzzleHttp\Client;
use App\Models\Ingredient;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use App\Models\RecipeDirection;
use App\Models\RecipeIngredient;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use App\Transformers\RecipeTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;

class RecipeController extends Controller
{
	public function __construct(
			RecipeTransformer $recipe_transformer,
			Manager $manager
		)
	{
		$this->transformer = $recipe_transformer;
		$this->manager = $manager->setSerializer(new JsonApiSerializer());
	}

	public function allByCookbookId($cookbook_id)
	{
		$recipes = Recipe::where(['cookbook_id' => $cookbook_id])->get();
		if ( ! $recipes) {
			return response()->json(['errors' => 'Recipes not found.'], 404);
		}

		$items = new Collection($recipes, $this->transformer, 'recipes');
		$data = $this->manager->createData($items)->toArray();

		return response()->json($data, 200);
	}

	public function allByUserId($user_id)
	{
		$recipes = Recipe::where(['user_id' => $user_id])->get();
		if ( ! $recipes) {
			return response()->json(['errors' => 'Recipes not found.'], 404);
		}

		$items = new Collection($recipes, $this->transformer, 'recipes');
		$data = $this->manager->createData($items)->toArray();

		return response()->json($data, 200);
	}

	public function destroy($id)
	{
		Recipe::destroy($id);

		$ingredients = RecipeIngredient::where(['recipe_id' => $id])->get();
		foreach($ingredients as $ingredient) {
			RecipeIngredient::destroy($ingredient->id);
		}

		$directions = RecipeDirection::where(['recipe_id' => $id])->get();
		foreach($directions as $direction) {
			RecipeDirection::destroy($direction->id);
		}

		// TODO detach tags

		return response()->json(['success' => 'Recipe deleted!'], 204);
	}

	public function show($id)
	{
		$recipe = Recipe::find($id);
		if ( ! $recipe) {
			return response()->json(['errors' => 'Recipe not found.'], 404);
		}

		$item = new Item($recipe, $this->transformer, 'recipe');
		$data = $this->manager->createData($item)->toArray();

		return response()->json($data, 201);
	}

	public function showFull($id)
	{
		$recipe = Recipe::find($id);
		if ( ! $recipe) {
			return response()->json(['errors' => 'Recipe not found.'], 404);
		}

		$recipe_ingredients = RecipeIngredient::where(['recipe_id' => $recipe->id])->get();
		$recipe_directions = RecipeDirection::where(['recipe_id' => $recipe->id])->get();

		foreach($recipe->tag as $tag) {
			$recipe_tags[] = Tag::find($tag->pivot->tag_id);
		}

		$recipe->ingredients = $recipe_ingredients;
		$recipe->directions = $recipe_directions;
		$recipe->tags = $recipe_tags;

		$item = new Item($recipe, $this->transformer, 'recipe');
		$data = $this->manager->createData($item)->toArray();

		return response()->json($data, 200);
	}

	// TODO Move to model
	public function set_time_units($input)
	{
		switch($input) {
			case 'seconds':
				$time_units = 'seconds';
				break;
			case 'minutes':
				$time_units = 'minutes';
				break;
			case 'hours':
				$time_units = 'hours';
				break;
			case 'days':
				$time_units = 'days';
				break;
			case 'weeks':
				$time_units = 'weeks';
				break;
			case 'months':
				$time_units = 'months';
				break;
		}

		return $time_units;
	}

	public function store()
	{
		$unit = Unit::where('unit', 'servings')->first();

		$prep_time_units = $this->set_time_units(\Input::get('prep_time_units'));
		$cook_time_units = $this->set_time_units(\Input::get('cook_time_units'));

		$new_recipe = Recipe::create([
			'user_id' => \Input::get('user_id'),
			'cookbook_id' => \Input::get('cookbook_id'),
			'title' => \Input::get('title'),
			'prep_time' => \Input::get('prep_time') . ' ' . $prep_time_units,
			'cook_time' => \Input::get('cook_time') . ' ' . $cook_time_units,
			'yields_amount' => \Input::get('yields_amount'),
			'unit_id' => $unit->id,
			'description' => \Input::get('description'),
			'source_url' => \Input::get('source_url')
		]);

		$recipe_id = $new_recipe->id;
		$recipe_ingredients = \Input::get('recipe_ingredient')['ingredient'];
		$recipe_ingredient_amounts = \Input::get('recipe_ingredient')['amount'];
		$recipe_ingredient_units = \Input::get('recipe_ingredient')['unit'];
		$recipe_ingredient_options = \Input::get('recipe_ingredient')['optional'];

		foreach($recipe_ingredients as $key => $recipe_ingredient)
		{
			if(isset($recipe_ingredients[$key])) {
				if (isset($recipe_ingredient_amounts[$key])) {
					$amount = $recipe_ingredient_amounts[$key];
				} else {
					$amount = (string) NULL;
				}

				if (isset($recipe_ingredient_units[$key])) {
					$unit = $recipe_ingredient_units[$key];
				} else {
					$unit = 'none';
				}

				$ingredient_unit = Unit::firstOrCreate(['unit' => $unit]);
			    $ingredient = Ingredient::firstOrNew(['ingredient' => $recipe_ingredients[$key]]);
			    $ingredient->count++;
			    $ingredient->save();
			    $optional = $recipe_ingredient_options[$key];

				RecipeIngredient::create([
					'recipe_id' => $recipe_id,
					'amount' => $amount,
					'unit_id' => $ingredient_unit->id,
					'ingredient_id' => $ingredient->id,
					'optional' => $optional,
				]);
			}
		}

		foreach(\Input::get('recipe_direction')['direction'] as $key => $direction) {
			if(isset($direction)) {
				RecipeDirection::create([
					'recipe_id' => $recipe_id,
					'direction' => $direction
				]);
			}
		}

		$tags = preg_replace('/\s+/', '', \Input::get('recipe_tags'));
		$tags = explode(',', $tags);

		foreach($tags as $tag) {
			$new_tag = Tag::firstOrNew(['tag' => $tag]);
			$new_tag->count++;
			$new_tag->save();
			$new_recipe->tag()->attach($new_tag->id);
		}

		if ( ! $recipe_id) {
			return response()->json(['errors' => 'Failed to create recipe.'], 422);
		}

		return response()->json(['recipe_id' => $recipe_id], 201);
	}

	public function update($id)
	{
		// TODO Fix/refactor
		$recipe = Recipe::find($id);
		$recipe->user_id = \Input::get('user_id');
		$recipe->user_id = \Input::get('user_id');
		$recipe->cookbook_id = \Input::get('cookbook_id');
		$recipe->title = \Input::get('title');
		$recipe->prep_time = \Input::get('prep_time');
		$recipe->cook_time = \Input::get('cook_time');
		$recipe->yields_amount = \Input::get('yields_amount');
		$recipe->unit_id = $unit->id;
		$recipe->description = \Input::get('description');
		$recipe->source_url = \Input::get('source_url');
		$recipe->touch();
		$recipe->save();

		$recipe_id = $recipe->id;
		$recipe_ingredients = \Input::get('recipe_ingredient')['ingredient'];
		$recipe_ingredient_amounts = \Input::get('recipe_ingredient')['amount'];
		$recipe_ingredient_units = \Input::get('recipe_ingredient')['unit'];
		$recipe_ingredient_options = \Input::get('recipe_ingredient')['optional'];

		$found_ingredients = RecipeIngredient::whereIn('ingredient', $recipe_ingredients)->get();

		foreach($recipe_ingredients as $key => $recipe_ingredient)
		{
			if(isset($recipe_ingredients[$key])) {
				if(isset($found_ingredients[$key])) {
					if (isset($recipe_ingredient_amounts[$key])) {
						$amount = $recipe_ingredient_amounts[$key];
					} else {
						$amount = (string) NULL;
					}

					if (isset($recipe_ingredient_units[$key])) {
						$unit = $recipe_ingredient_units[$key];
					} else {
						$unit = 'none';
					}

					$ingredient_unit = Unit::firstOrCreate(['unit' => $unit]);
				    $ingredient = Ingredient::firstOrNew(['ingredient' => $recipe_ingredients[$key]]);
				    $ingredient->count++;
				    $ingredient->save();

				    $found_recipe_ingredient = RecipeIngredient::find($found_ingredients[$key]->id)->get();
				    $found_recipe_ingredient->amount = $amount;
				    $found_recipe_ingredient->unit_id = $ingredient_unit;
				    $found_recipe_ingredient->ingredient_id = $ingredient;
				    $found_recipe_ingredient->optional = $recipe_ingredient_options[$key];
				    $found_recipe_ingredient->touch();
				    $found_recipe_ingredient->save();
				} else {
					if (isset($recipe_ingredient_amounts[$key])) {
						$amount = $recipe_ingredient_amounts[$key];
					} else {
						$amount = (string) NULL;
					}

					if (isset($recipe_ingredient_units[$key])) {
						$unit = $recipe_ingredient_units[$key];
					} else {
						$unit = 'none';
					}

					$ingredient_unit = Unit::firstOrCreate(['unit' => $unit]);
				    $ingredient = Ingredient::firstOrNew(['ingredient' => $recipe_ingredients[$key]]);
				    $ingredient->count++;
				    $ingredient->save();
				    $optional = $recipe_ingredient_options[$key];

					RecipeIngredient::create([
						'recipe_id' => $recipe_id,
						'amount' => $amount,
						'unit_id' => $ingredient_unit->id,
						'ingredient_id' => $ingredient->id,
						'optional' => $optional,
					]);
				}
			}
		}

		$found_directions = RecipeDirection::where(['recipe_id' => $recipe_id])->get();
		foreach(\Input::get('recipe_direction')['direction'] as $key => $direction) {
			if(isset($found_directions[$key])) {
				$found_direction = RecipeDirection::find($found_directions[$key]->id);
				$found_direction->direction = $direction;
				$found_direction->touch();
				$found_direction->save();
			} else {
				RecipeDirection::create([
					'recipe_id' => $recipe_id,
					'direction' => $direction
				]);
			}
		}

		// TODO - tags
		// return response()->json(['recipe_id' => $recipe_id], 200);
	}
}
