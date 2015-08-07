<?php namespace App\Transformers;

use App\Models\Role;
use App\Transformers\RoleTransformer;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
	public function transform(Role $role)
	{
		return [
				$role->role
			];
	}
}
