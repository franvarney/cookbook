<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\CommentRecipe;

class CommentRecipeTableSeeder extends Seeder {

  public function run()
  {
    DB::table('comment_recipe')->truncate();

    CommentRecipe::create(['recipe_id' => 1, 'comment_id' => 1]);
    CommentRecipe::create(['recipe_id' => 1, 'comment_id' => 2]);
    CommentRecipe::create(['recipe_id' => 2, 'comment_id' => 3]);
    CommentRecipe::create(['recipe_id' => 2, 'comment_id' => 4]);
    CommentRecipe::create(['recipe_id' => 3, 'comment_id' => 4]);
    CommentRecipe::create(['recipe_id' => 4, 'comment_id' => 2]);
    CommentRecipe::create(['recipe_id' => 5, 'comment_id' => 3]);
    CommentRecipe::create(['recipe_id' => 6, 'comment_id' => 1]);
  }
}