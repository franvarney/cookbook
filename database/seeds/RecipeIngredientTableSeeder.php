<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\RecipeIngredient;

class RecipeIngredientTableSeeder extends Seeder {

  public function run()
  {
    DB::table('recipe_ingredients')->truncate();

    RecipeIngredient::create([
      'recipe_id' => 1,
      'amount' => '1',
      'unit_id' => 3,
      'ingredient_id' => 1,
      'optional' => 0
    ]);

    RecipeIngredient::create([
      'recipe_id' => 1,
      'amount' => '4',
      'unit_id' => 4,
      'ingredient_id' => 2,
      'optional' => 0
    ]);

    RecipeIngredient::create([
      'recipe_id' => 1,
      'amount' => '4',
      'unit_id' => 6,
      'ingredient_id' => 3,
      'optional' => 0
    ]);

    RecipeIngredient::create([
      'recipe_id' => 5,
      'amount' => '1',
      'unit_id' => 3,
      'ingredient_id' => 1,
      'optional' => 0
    ]);

    RecipeIngredient::create([
      'recipe_id' => 5,
      'amount' => '4',
      'unit_id' => 4,
      'ingredient_id' => 2,
      'optional' => 0
    ]);

    RecipeIngredient::create([
      'recipe_id' => 5,
      'amount' => '4',
      'unit_id' => 6,
      'ingredient_id' => 3,
      'optional' => 0
    ]);
  }
}