<?php namespace App\Repositories;

use App\Models\Recipe;
use App\RepositoryInterfaces\RecipeInterface;

class RecipeRepository extends BaseRepository implements RecipeInterface
{
	public function __construct(
			CommentRepository $comment,
			IngredientRepository $ingredient,
			RecipeDirectionRepository $recipe_direction,
			RecipeIngredientRepository $recipe_ingredient,
			TagRepository $tag,
			UnitRepository $unit
		)
	{
		$this->comment = $comment;
		$this->ingredient = $ingredient;
		$this->recipe_direction = $recipe_direction;
		$this->recipe_ingredient = $recipe_ingredient;
		$this->tags = $tag;
		$this->unit = $unit;
	}

	public function allByCookbookId($cookbook_id)
	{
		$recipes = Recipe::where([
				'cookbook_id' => $cookbook_id
			])->get();

		if ( ! $recipes) {
			return false;
		}

		return $recipes;
	}

	public function allByUserId($user_id)
	{
		$recipes = Recipe::where([
				'user_id' => $user_id
			])->get();

		if ( ! $recipes) {
			return false;
		}

		return $recipes;
	}

	public function findByTitle($title)
	{
		$recipe = Recipe::where([
				'title' => $title
			])->first();

		if ( ! $recipe) {
			return false;
		}

		return $recipe;
	}

	public function store($request)
	{
		$unit_id = $this->unit->firstOrCreate('servings');

		$new_recipe = Recipe::create([
			'user_id' => $request->input('user_id'),
			'cookbook_id' => $request->input('cookbook_id'),
			'title' => $request->input('title'),
			'prep_time' => $request->input('prep_time'),
			'cook_time' => $request->input('cook_time'),
			'yields_amount' => $request->input('yields_amount'),
			'unit_id' => $unit_id,
			'description' => $request->input('description'),
			'source_url' => $request->input('source_url')
		]);

		$recipe_id = $new_recipe->id;

		foreach($request->input('recipe_ingredient')["ingredient"] as $key => $recipe_ingredient)
		{
			$amount = '';
			$amount = $request->input('recipe_ingredient')["amount"][$key];

			if ( ! isset($request->input('recipe_ingredient')["unit"][$key])) {
				$unit = 'none';
			} else {
				$unit = $request->input('recipe_ingredient')["unit"][$key];
			}

			$ingredient = $request->input('recipe_ingredient')["ingredient"][$key];

			$this->recipe_ingredient->store(
					$recipe_id,
					$amount,
					$unit,
					$ingredient,
					$request->input('recipe_ingredient')["optional"],
					0
				);
		}

		foreach($request->input('recipe_direction')["direction"] as $key => $direction) {
			$this->recipe_direction->store($recipe_id, $request->input('recipe_direction')["direction"][$key]);
		}

		$tag_ids = $this->tags->store($recipe_id, $request->input('recipe_tags'));
		foreach($tag_ids as $tag_id) {
			$recipe = Recipe::find($recipe_id);
			$recipe->tag()->attach($tag_id);
		}

		return $recipe_id;
	}

	public function show($recipe_id)
	{
		$recipe = Recipe::find($recipe_id)->first();
		if ( ! $recipe) {
			return false;
		}

		return $recipe;
	}

	public function showFull($recipe_id)
	{
		$recipe = $this->show($recipe_id);
		if ( ! $recipe) {
			return false;
		}

		$recipe_ingredients = $this->recipe_ingredient->allByRecipeId($recipe_id);
		$recipe_directions = $this->recipe_direction->allByRecipeId($recipe_id);
		foreach($recipe->tag as $tag) { // TODO: review pivot tables?
			$recipe_tags[] = $this->tags->find($tag->pivot->tag_id);
		}

		$recipe->ingredients = $recipe_ingredients;
		$recipe->directions = $recipe_directions;
		$recipe->tags = $recipe_tags;

		return $recipe;
	}

	public function update($id, $request)
	{
		// TODO: Add update function
	}
}
