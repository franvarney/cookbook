<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\RecipeRepository;
use App\Transformers\RecipeTransformer;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;

class RecipeController extends Controller
{
	public function __construct(
			RecipeRepository $recipe_repo,
			RecipeTransformer $recipe_transformer,
			Manager $manager
		)
	{
		$this->recipe = $recipe_repo;
		$this->transformer = $recipe_transformer;
		$this->manager = $manager->setSerializer(new JsonApiSerializer());
	}

	public function allByCookbookId($cookbook_id)
	{
		$recipes = $this->recipe->allByCookbookId($cookbook_id);
		if ( ! $recipes || sizeof($recipes) === 0) {
			return response()->json(['errors' => 'Recipes not found.'], 404);
		}

		$items = new Collection($recipes, $this->transformer, 'recipes');
		$data = $this->manager->createData($items)->toArray();

		return response()->json($data, 200);
	}

	public function allByUserId($user_id)
	{
		$recipes = $this->recipe->allByUserId($user_id);
		if ( ! $recipes) {
			return response()->json(['errors' => 'Recipes not found.'], 404);
		}

		$items = new Collection($recipes, $this->transformer, 'recipes');
		$data = $this->manager->createData($items)->toArray();

		return response()->json($data, 200);
	}

	public function destroy($id)
	{
		$deleted = $this->recipe->destroy($id);
		if ( ! $deleted) {
			return response()->json(['errors' => 'Unable to delete recipe.'], 422);
		}

		return response()->json(['success' => 'Recipe deleted!'], 204);
	}

	public function show($id)
	{
		$recipe = $this->recipe->show($id);
		if ( ! $recipe) {
			return response()->json(['errors' => 'Recipe not found.'], 404);
		}

		$item = new Item($recipe, $this->transformer, 'recipe');
		$data = $this->manager->createData($item)->toArray();

		return response()->json($data, 201);
	}

	public function showFull($id)
	{
		$recipe = $this->recipe->showFull($id);
		if ( ! $recipe) {
			return response()->json(['errors' => 'Recipe not found.'], 404);
		}

		$item = new Item($recipe, $this->transformer, 'recipe');
		$data = $this->manager->createData($item)->toArray();

		return response()->json($data, 200);
	}

	public function store(Request $request)
	{
		$recipe_id = $this->recipe->storeRecipe($request);
		if ( ! $recipe_id) {
			return response()->json(['errors' => 'Failed to create recipe.'], 422);
		}

		$success = array(
				'recipe' => [
					'id' => $recipe_id
			]);

		return response()->json($success, 201);
	}

	public function update($id, Request $request)
	{
		$recipe_id = $this->recipe->updateRecipe($id, $request);
		if ( ! $recipe_id) {
			return response()->json(['errors' => 'Recipe not found.'], 404);
		}

		$success = array(
				'recipe' => [
					'id' => $recipe_id
			]);

		return response()->json($success, 201);
	}
}
