<?php namespace App\Repositories;

use App\Models\User;
use App\RepositoryInterfaces\UserInterface;
use Illuminate\Contracts\Hashing\Hasher;

class UserRepository extends BaseRepository implements UserInterface
{
	public function __construct(Hasher $hasher)
	{
		$this->hasher = $hasher;
	}

	public function destroy($id)
	{
		$user = User::find($id);

		if ( ! $user) {
			return false;
		}

		$user->delete();
		// TODO: check if user is deleted
		return true;
	}

	public function findByUsername($username)
	{
		$user = User::where([
				'username' => $username
			])->first();

		if ( ! $user) {
			return false;
		}

		return $user;
	}

	public function find($id)
	{
		$user = User::find($id);

		if( ! $user) {
			return false;
		}

		return $user;
	}

	public function findUser($request)
	{
		$user = User::where([
				'email' => $request->input('email'),
			])->first();

		if ( ! $user) {
			return false;
		}

		if ($this->hasher->check($request->input('password'), $user->password)) {
			return $user;
		} else {
			return false;
		}
	}

	public function store($request)
	{
		$user = $this->findByUsername([
				'username' => $request->input('username')
			]); // TODO: add email

		if ($user) {
			return true;
		}

		$password = $this->hasher->make($request->input('password'));

		$new_user = User::create([
				'username' => $request->input('username'),
				'email' => $request->input('email'),
				'password' => $password,
				'is_admin' => 0
			]);

		return $new_user->id;
	}

	public function update($id, $request)
	{
		$user = User::find($id);

		if ( ! $user) {
			return false;
		}

		$user->email = $request->input('email');
		$user->first_name = $request->input('first_name');
		$user->last_name = $request->input('last_name');
		$user->location = $request->input('location');
		$user->touch();
		$user->save();

		return $user->id;
	}
}
