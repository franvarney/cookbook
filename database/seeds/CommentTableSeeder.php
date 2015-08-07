<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class CommentTableSeeder extends Seeder {

  public function run()
  {
    DB::table('comments')->truncate();

    Comment::create([
      'user_id' => 1,
      'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porta dictum augue, a convallis nunc volutpat nec. Pellentesque elementum lacus.'
    ]);

    Comment::create([
      'user_id' => 1,
      'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ultrices imperdiet mi. Etiam ut dolor tortor. Aenean ut leo et leo mollis posuere in et ipsum. Etiam et tellus non sapien volutpat tristique sit amet.'
    ]);

    Comment::create([
      'user_id' => 2,
      'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel vulputate est. Quisque convallis metus.'
    ]);

    Comment::create([
      'user_id' => 3,
      'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porta dictum augue, a convallis nunc volutpat nec. Pellentesque elementum lacus.'
    ]);

    Comment::create([
      'user_id' => 4,
      'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ultrices imperdiet mi. Etiam ut dolor tortor. Aenean ut leo et leo mollis posuere in et ipsum. Etiam et tellus non sapien volutpat tristique sit amet.'
    ]);

    Comment::create([
      'user_id' => 5,
      'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel vulputate est. Quisque convallis metus.'
    ]);
  }
}