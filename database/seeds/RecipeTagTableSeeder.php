<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\RecipeTag;

class RecipeTagTableSeeder extends Seeder {

  public function run()
  {
    DB::table('recipe_tag')->truncate();

    RecipeTag::create(['recipe_id' => 1, 'tag_id' => 1]);
    RecipeTag::create(['recipe_id' => 1, 'tag_id' => 2]);
    RecipeTag::create(['recipe_id' => 2, 'tag_id' => 3]);
    RecipeTag::create(['recipe_id' => 2, 'tag_id' => 5]);
    RecipeTag::create(['recipe_id' => 3, 'tag_id' => 3]);
    RecipeTag::create(['recipe_id' => 4, 'tag_id' => 2]);
    RecipeTag::create(['recipe_id' => 5, 'tag_id' => 3]);
    RecipeTag::create(['recipe_id' => 6, 'tag_id' => 1]);
  }
}