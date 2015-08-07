<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\RecipeDirection;

class RecipeDirectionTableSeeder extends Seeder {

  public function run()
  {
    DB::table('recipe_directions')->truncate();

    RecipeDirection::create([
      'recipe_id' => 1,
      'direction' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porta dictum augue, a convallis nunc volutpat nec. Pellentesque elementum lacus.'
    ]);

    RecipeDirection::create([
      'recipe_id' => 1,
      'direction' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ultrices imperdiet mi. Etiam ut dolor tortor. Aenean ut leo et leo mollis posuere in et ipsum. Etiam et tellus non sapien volutpat tristique sit amet.'
    ]);

    RecipeDirection::create([
      'recipe_id' => 1,
      'direction' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel vulputate est. Quisque convallis metus.'
    ]);

    RecipeDirection::create([
      'recipe_id' => 5,
      'direction' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porta dictum augue, a convallis nunc volutpat nec. Pellentesque elementum lacus.'
    ]);

    RecipeDirection::create([
      'recipe_id' => 5,
      'direction' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ultrices imperdiet mi. Etiam ut dolor tortor. Aenean ut leo et leo mollis posuere in et ipsum. Etiam et tellus non sapien volutpat tristique sit amet.'
    ]);

    RecipeDirection::create([
      'recipe_id' => 5,
      'direction' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel vulputate est. Quisque convallis metus.'
    ]);
  }
}