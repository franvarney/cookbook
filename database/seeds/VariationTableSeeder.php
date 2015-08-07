<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Variation;

class VariationTableSeeder extends Seeder {

  public function run()
  {
    DB::table('variations')->truncate();

    Variation::create([
      'recipe_id' => 1,
      'variation_recipe_id' => 2,
    ]);
  }
}