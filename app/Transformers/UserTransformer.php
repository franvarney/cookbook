<?php namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
	public function transform(User $user)
	{
		return [
				'username' => $user->username,
				'email' => $user->email,
				'name' => [
					'first' => $user->first_name,
					'last' => $user->last_name,
					'full' => $user->first_name . ' ' . $user->last_name
				],
				'location' => $user->location,
				'url' => '/user/' . $user->id,
				'admin' => (bool) $user->is_admin,
				'joined' => date('m/d/y', strtotime($user->created_at))
			];
	}
}
