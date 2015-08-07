<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\ContributorRequest;

class ContributorRequestTableSeeder extends Seeder {

  public function run()
  {
    DB::table('contributor_requests')->truncate();

    ContributorRequest::create([
      'sender_user_id' => 1,
      'cookbook_id' => 1,
      'receiver_user_id' => 2,
      'approved' => 1
    ]);

    ContributorRequest::create([
      'sender_user_id' => 1,
      'cookbook_id' => 1,
      'receiver_user_id' => 3,
      'approved' => 1
    ]);

    ContributorRequest::create([
      'sender_user_id' => 1,
      'cookbook_id' => 1,
      'receiver_user_id' => 4,
      'approved' => 1
    ]);

    ContributorRequest::create([
      'sender_user_id' => 1,
      'cookbook_id' => 1,
      'receiver_user_id' => 5,
      'approved' => 1
    ]);

    ContributorRequest::create([
      'sender_user_id' => 1,
      'cookbook_id' => 2,
      'receiver_user_id' => 4,
      'approved' => 0
    ]);

    ContributorRequest::create([
      'sender_user_id' => 1,
      'cookbook_id' => 2,
      'receiver_user_id' => 5,
      'approved' => 0
    ]);

    ContributorRequest::create([
      'sender_user_id' => 2,
      'cookbook_id' => 2,
      'receiver_user_id' => 1,
      'approved' => 0
    ]);
  }
}