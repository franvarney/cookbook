<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\ContributorPermission;

class ContributorPermissionTableSeeder extends Seeder {

  public function run()
  {
    DB::table('contributor_permissions')->truncate();

    ContributorPermission::create([
      'user_id' => 1,
      'contributor_id' => 1,
      'can_add_contributors' => 1,
      'can_edit_cookbook' => 1,
      'can_delete_cookbook' => 1,
      'can_edit_recipe' => 1,
      'can_delete_recipe' => 1
    ]);

    ContributorPermission::create([
      'user_id' => 1,
      'contributor_id' => 2,
      'can_add_contributors' => 1,
      'can_edit_cookbook' => 1,
      'can_delete_cookbook' => 1,
      'can_edit_recipe' => 1,
      'can_delete_recipe' => 1
    ]);

    ContributorPermission::create([
      'user_id' => 1,
      'contributor_id' => 3,
      'can_add_contributors' => 1,
      'can_edit_cookbook' => 1,
      'can_delete_cookbook' => 1,
      'can_edit_recipe' => 1,
      'can_delete_recipe' => 1
    ]);

    ContributorPermission::create([
      'user_id' => 2,
      'contributor_id' => 4,
      'can_add_contributors' => 1,
      'can_edit_cookbook' => 1,
      'can_delete_cookbook' => 1,
      'can_edit_recipe' => 1,
      'can_delete_recipe' => 1
    ]);

    ContributorPermission::create([
      'user_id' => 2,
      'contributor_id' => 5,
      'can_add_contributors' => 1,
      'can_edit_cookbook' => 1,
      'can_delete_cookbook' => 1,
      'can_edit_recipe' => 1,
      'can_delete_recipe' => 1
    ]);

    ContributorPermission::create([
      'user_id' => 3,
      'contributor_id' => 6,
      'can_add_contributors' => 1,
      'can_edit_cookbook' => 1,
      'can_delete_cookbook' => 1,
      'can_edit_recipe' => 1,
      'can_delete_recipe' => 1
    ]);

    ContributorPermission::create([
      'user_id' => 4,
      'contributor_id' => 7,
      'can_add_contributors' => 1,
      'can_edit_cookbook' => 1,
      'can_delete_cookbook' => 1,
      'can_edit_recipe' => 1,
      'can_delete_recipe' => 1
    ]);

    ContributorPermission::create([
      'user_id' => 5,
      'contributor_id' => 7,
      'can_add_contributors' => 1,
      'can_edit_cookbook' => 1,
      'can_delete_cookbook' => 1,
      'can_edit_recipe' => 1,
      'can_delete_recipe' => 1
    ]);

    ContributorPermission::create([
      'user_id' => 2,
      'contributor_id' => 8,
      'can_add_contributors' => 1,
      'can_edit_cookbook' => 0,
      'can_delete_cookbook' => 0,
      'can_edit_recipe' => 1,
      'can_delete_recipe' => 0
    ]);

    ContributorPermission::create([
      'user_id' => 1,
      'contributor_id' => 9,
      'can_add_contributors' => 1,
      'can_edit_cookbook' => 0,
      'can_delete_cookbook' => 0,
      'can_edit_recipe' => 1,
      'can_delete_recipe' => 0
    ]);

    ContributorPermission::create([
      'user_id' => 3,
      'contributor_id' => 10,
      'can_add_contributors' => 1,
      'can_edit_cookbook' => 0,
      'can_delete_cookbook' => 0,
      'can_edit_recipe' => 1,
      'can_delete_recipe' => 1
    ]);

    ContributorPermission::create([
      'user_id' => 4,
      'contributor_id' => 11,
      'can_add_contributors' => 1,
      'can_edit_cookbook' => 0,
      'can_delete_cookbook' => 0,
      'can_edit_recipe' => 1,
      'can_delete_recipe' => 0
    ]);

    ContributorPermission::create([
      'user_id' => 5,
      'contributor_id' => 12,
      'can_add_contributors' => 1,
      'can_edit_cookbook' => 1,
      'can_delete_cookbook' => 0,
      'can_edit_recipe' => 1,
      'can_delete_recipe' => 0
    ]);
  }
}