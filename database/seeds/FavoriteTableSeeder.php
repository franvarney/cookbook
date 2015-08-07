<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;

class FavoriteTableSeeder extends Seeder {

  public function run()
  {
    DB::table('favorites')->delete();

    Favorite::create([
      'user_id' => 1,
      'recipe_id' => 2,
      'favorite' => 1,
    ]);

    Favorite::create([
      'user_id' => 1,
      'recipe_id' => 3,
      'favorite' => 1,
    ]);
  }
}