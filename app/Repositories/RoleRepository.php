<?php namespace App\Repositories;

use App\Models\Role;
use App\RepositoryInterfaces\RoleInterface;

class RoleRepository extends BaseRepository implements RoleInterface
{
	public function findByRole($role)
	{
		$role = Role::where([
				'role', $role
			])->first();

		if ( ! $role) {
			return false;
		}

		return $role;
	}
}