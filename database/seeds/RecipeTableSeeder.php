<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;

class RecipeTableSeeder extends Seeder {

  public function run()
  {
    DB::table('recipes')->truncate();

    Recipe::create([
      'user_id' => 1,
      'cookbook_id' => 1,
      'title' => 'Spaghetti',
      'prep_time' => '10 minutes',
      'cook_time' => '30 minutes',
      'yields_amount' => '6',
      'unit_id' => 2,
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium diam eu tellus ultrices, sed mollis velit fermentum. Duis enim tellus, vehicula at eros et, iaculis ornare justo. Curabitur id nibh non sapien pharetra vulputate ut ac urna. Nullam elementum nisi nec lacus scelerisque, eget gravida sapien mattis. Quisque suscipit.',
      'source_url' => 'http://www.someurl.com/recipename'
    ]);

    Recipe::create([
      'user_id' => 1,
      'cookbook_id' => 1,
      'title' => 'Spaghetti 2',
      'prep_time' => '5 minutes',
      'cook_time' => '40 minutes',
      'yields_amount' => '4',
      'unit_id' => 2,
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium diam eu tellus ultrices, sed mollis velit fermentum. Duis enim tellus, vehicula at eros et, iaculis ornare justo. Curabitur id nibh non sapien pharetra vulputate ut ac urna. Nullam elementum nisi nec lacus scelerisque, eget gravida sapien mattis. Quisque suscipit.',
      'source_url' => 'http://www.someurl.com/recipename2'
    ]);

    Recipe::create([
      'user_id' => 1,
      'cookbook_id' => 1,
      'title' => 'Chicken Noodle Soup',
      'prep_time' => '15 minutes',
      'cook_time' => '30 minutes',
      'yields_amount' => '16',
      'unit_id' => 2,
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium diam eu tellus ultrices, sed mollis velit fermentum. Duis enim tellus, vehicula at eros et, iaculis ornare justo. Curabitur id nibh non sapien pharetra vulputate ut ac urna. Nullam elementum nisi nec lacus scelerisque, eget gravida sapien mattis. Quisque suscipit.',
      'source_url' => 'http://www.someurl.com/recipename3'
    ]);

    Recipe::create([
      'user_id' => 1,
      'cookbook_id' => 2,
      'title' => 'Spaghetti 3',
      'prep_time' => '10 minutes',
      'cook_time' => '20 minutes',
      'yields_amount' => '8.5',
      'unit_id' => 2,
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium diam eu tellus ultrices, sed mollis velit fermentum. Duis enim tellus, vehicula at eros et, iaculis ornare justo. Curabitur id nibh non sapien pharetra vulputate ut ac urna. Nullam elementum nisi nec lacus scelerisque, eget gravida sapien mattis. Quisque suscipit.',
      'source_url' => 'http://www.someurl.com/recipename4'
    ]);

    Recipe::create([
      'user_id' => 2,
      'cookbook_id' => 4,
      'title' => 'Spaghetti',
      'prep_time' => '5 minutes',
      'cook_time' => '25 minutes',
      'yields_amount' => '6',
      'unit_id' => 2,
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium diam eu tellus ultrices, sed mollis velit fermentum. Duis enim tellus, vehicula at eros et, iaculis ornare justo. Curabitur id nibh non sapien pharetra vulputate ut ac urna. Nullam elementum nisi nec lacus scelerisque, eget gravida sapien mattis. Quisque suscipit.',
      'source_url' => 'http://www.someurl.com/recipename'
    ]);

    Recipe::create([
      'user_id' => 2,
      'cookbook_id' => 4,
      'title' => 'Chicken Noodle Soup',
      'prep_time' => '15 minutes',
      'cook_time' => '20  minutes',
      'yields_amount' => '16',
      'unit_id' => 2,
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium diam eu tellus ultrices, sed mollis velit fermentum. Duis enim tellus, vehicula at eros et, iaculis ornare justo. Curabitur id nibh non sapien pharetra vulputate ut ac urna. Nullam elementum nisi nec lacus scelerisque, eget gravida sapien mattis. Quisque suscipit.',
      'source_url' => 'http://www.someurl.com/recipename3'
    ]);
  }
}