<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unit;

class UnitTableSeeder extends Seeder {

  public function run()
  {
    DB::table('units')->truncate();

    Unit::create(['unit' => 'none']);
    Unit::create(['unit' => 'serving']);
    Unit::create(['unit' => 'servings']);
    Unit::create(['unit' => 'tablespoon']);
    Unit::create(['unit' => 'teaspoon']);
    Unit::create(['unit' => 'cup']);
    Unit::create(['unit' => 'quart']);
    Unit::create(['unit' => 'spoonful']);
    Unit::create(['unit' => 'pinch']);
  }
}