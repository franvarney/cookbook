<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class TagTableSeeder extends Seeder {

  public function run()
  {
    DB::table('tags')->truncate();

    Tag::create(['tag' => 'chicken']);
    Tag::create(['tag' => 'Italian']);
    Tag::create(['tag' => 'soup']);
    Tag::create(['tag' => 'spaghetti']);
    Tag::create(['tag' => 'American']);
    Tag::create(['tag' => 'cheesey']);
    Tag::create(['tag' => 'light']);
    Tag::create(['tag' => 'dinner']);
  }
}