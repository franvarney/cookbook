<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contributor;

class ContributorTableSeeder extends Seeder {

  public function run()
  {
    DB::table('contributors')->truncate();

    Contributor::create([
      'user_id' => 1,
      'cookbook_id' => 1,
      'role_id' => 2
    ]);

    Contributor::create([
      'user_id' => 1,
      'cookbook_id' => 2,
      'role_id' => 2
    ]);

    Contributor::create([
      'user_id' => 1,
      'cookbook_id' => 3,
      'role_id' => 2
    ]);

    Contributor::create([
      'user_id' => 2,
      'cookbook_id' => 4,
      'role_id' => 2
    ]);

    Contributor::create([
      'user_id' => 2,
      'cookbook_id' => 5,
      'role_id' => 2
    ]);

    Contributor::create([
      'user_id' => 3,
      'cookbook_id' => 6,
      'role_id' => 2
    ]);

    Contributor::create([
      'user_id' => 4,
      'cookbook_id' => 7,
      'role_id' => 2
    ]);

    Contributor::create([
      'user_id' => 5,
      'cookbook_id' => 8,
      'role_id' => 2
    ]);

    Contributor::create([
      'user_id' => 2,
      'cookbook_id' => 1,
      'role_id' => 3
    ]);

    Contributor::create([
      'user_id' => 1,
      'cookbook_id' => 4,
      'role_id' => 3
    ]);

    Contributor::create([
      'user_id' => 3,
      'cookbook_id' => 1,
      'role_id' => 3
    ]);

    Contributor::create([
      'user_id' => 4,
      'cookbook_id' => 1,
      'role_id' => 3
    ]);

    Contributor::create([
      'user_id' => 5,
      'cookbook_id' => 1,
      'role_id' => 3
    ]);
  }
}