<?php namespace App\Repositories;

use App\Models\ContributorPermission;
use App\RepositoryInterfaces\ContributorPermissionInterface;

class ContributorPermissionRepository extends BaseRepository implements ContributorPermissionInterface
{
	public function allByUserId($user_id)
	{
		$permissions = ContributorPermission::where([
				'user_id' => $user_id
			])->get();

		if ( ! $permissions) {
			return false;
		}

		return $permissions;
	}

	public function store($user_id, $contributor_id)
	{
		$new_permissions = ContributorPermission::create([
				'user_id' => $user_id,
				'contributor_id' => $contributor_id,
				'can_add_contributors' => 1,
				'can_edit_cookbook' => 0,
				'can_delete_cookbook' => 0,
				'can_edit_recipe' => 0,
				'can_delete_recipe' => 0
			]);

		return $new_permissions->id;
	}

	public function update($id, $request)
	{
		$permissions = ContributorPermissions::find($id);

		if ( ! $permissions) {
			return false;
		}

		$permissions->can_add_contributors = $request->input('can_add_contributors');
		$permissions->can_edit_cookbook = $request->input('can_edit_cookbook');
		$permissions->can_delete_cookbook = $request->input('can_delete_cookbook');
		$permissions->can_edit_recipe = $request->input('can_edit_recipe');
		$permissions->can_delete_recipe = $request->input('can_delete_recipe');
		$permissions->touch();
		$permissions->save();

		return $permissions->id;
	}
}
