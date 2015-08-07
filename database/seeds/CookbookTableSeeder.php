<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cookbook;

class CookbookTableSeeder extends Seeder {

  public function run()
  {
    DB::table('cookbooks')->truncate();

    Cookbook::create([
      'user_id' => 1,
      'name' => 'Varney Family Cookbook',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium diam eu tellus ultrices, sed mollis velit fermentum. Duis enim tellus, vehicula at eros et, iaculis ornare justo. Curabitur id nibh non sapien pharetra vulputate ut ac urna. Nullam elementum nisi nec lacus scelerisque, eget gravida sapien mattis. Quisque suscipit.'
    ]);

    Cookbook::create([
      'user_id' => 1,
      'name' => 'Healthy Eats',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium diam eu tellus ultrices, sed mollis velit fermentum. Duis enim tellus, vehicula at eros et, iaculis ornare justo. Curabitur id nibh non sapien pharetra vulputate ut ac urna. Nullam elementum nisi nec lacus scelerisque, eget gravida sapien mattis. Quisque suscipit.'
    ]);

    Cookbook::create([
      'user_id' => 1,
      'name' => 'Besties Recipes',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium diam eu tellus ultrices, sed mollis velit fermentum. Duis enim tellus, vehicula at eros et, iaculis ornare justo. Curabitur id nibh non sapien pharetra vulputate ut ac urna. Nullam elementum nisi nec lacus scelerisque, eget gravida sapien mattis. Quisque suscipit.'
    ]);

    Cookbook::create([
      'user_id' => 2,
      'name' => 'Jemma\'s Doggie Cookbook',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium diam eu tellus ultrices, sed mollis velit fermentum. Duis enim tellus, vehicula at eros et, iaculis ornare justo. Curabitur id nibh non sapien pharetra vulputate ut ac urna. Nullam elementum nisi nec lacus scelerisque, eget gravida sapien mattis. Quisque suscipit.'
    ]);

    Cookbook::create([
      'user_id' => 2,
      'name' => 'Jemma Wishes She Could Have These Foods Cookbook',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium diam eu tellus ultrices, sed mollis velit fermentum. Duis enim tellus, vehicula at eros et, iaculis ornare justo. Curabitur id nibh non sapien pharetra vulputate ut ac urna. Nullam elementum nisi nec lacus scelerisque, eget gravida sapien mattis. Quisque suscipit.'
    ]);

    Cookbook::create([
      'user_id' => 3,
      'name' => 'Desserts!',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium diam eu tellus ultrices, sed mollis velit fermentum. Duis enim tellus, vehicula at eros et, iaculis ornare justo. Curabitur id nibh non sapien pharetra vulputate ut ac urna. Nullam elementum nisi nec lacus scelerisque, eget gravida sapien mattis. Quisque suscipit.'
    ]);

    Cookbook::create([
      'user_id' => 4,
      'name' => 'Vegan Material',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium diam eu tellus ultrices, sed mollis velit fermentum. Duis enim tellus, vehicula at eros et, iaculis ornare justo. Curabitur id nibh non sapien pharetra vulputate ut ac urna. Nullam elementum nisi nec lacus scelerisque, eget gravida sapien mattis. Quisque suscipit.'
    ]);

    Cookbook::create([
      'user_id' => 5,
      'name' => 'Cincinnati Favorites',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium diam eu tellus ultrices, sed mollis velit fermentum. Duis enim tellus, vehicula at eros et, iaculis ornare justo. Curabitur id nibh non sapien pharetra vulputate ut ac urna. Nullam elementum nisi nec lacus scelerisque, eget gravida sapien mattis. Quisque suscipit.'
    ]);
  }
}