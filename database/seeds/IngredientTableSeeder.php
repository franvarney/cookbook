<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;

class IngredientTableSeeder extends Seeder {

  public function run()
  {
    DB::table('ingredients')->truncate();

    Ingredient::create(['ingredient' => 'tomato', 'count' => 1]);
    Ingredient::create(['ingredient' => 'spaghetti', 'count' => 1]);
    Ingredient::create(['ingredient' => 'oregano', 'count' => 1]);
    Ingredient::create(['ingredient' => 'basil', 'count' => 1]);
    Ingredient::create(['ingredient' => 'ground beef', 'count' => 1]);
    Ingredient::create(['ingredient' => 'spiral pasta', 'count' => 1]);
    Ingredient::create(['ingredient' => 'chicken breasts', 'count' => 1]);
    Ingredient::create(['ingredient' => 'celery', 'count' => 1]);
    Ingredient::create(['ingredient' => 'carrots', 'count' => 1]);
    Ingredient::create(['ingredient' => 'pepper', 'count' => 1]);
    Ingredient::create(['ingredient' => 'salt', 'count' => 1]);
  }
}