<?php namespace App\Repositories;

use App\Models\Contributor;
use App\RepositoryInterfaces\ContributorInterface;

class ContributorRepository extends BaseRepository implements ContributorInterface
{
	public function allByCookbookId($cookbook_id)
	{
		$contributors = Contributor::where([
				'cookbook_id' => $cookbook_id
			])->get();

		if ( ! $contributors) {
			return false;
		}

		return $contributors;
	}

	public function allByUserId($user_id)
	{
		$contributors = Contributor::where([
				'user_id' => $user_id
			])->get();

		if ( ! $contributors) {
			return false;
		}

		return $contributors;
	}

	public function destroy($id)
	{
		$contributor = Contributor::find($id);

		if ( ! $contributor) {
			return false;
		}

		$contributor->delete();
		return true;
	}

	public function find($contributor_id)
	{
		$contributor = Contributor::find($contributor_id);

		if ( ! $contributor) {
			return false;
		}

		return $contributor->id;
	}

	public function store($user_id, $cookbook_id, $role_id)
	{
		$new_contributor = Contributor::create([
				'user_id' => $user_id,
				'cookbook_id' => $cookbook_id,
				'role_id' => $role_id
			]);

		return $new_contributor->id;
	}
}
