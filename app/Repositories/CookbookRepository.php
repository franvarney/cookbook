<?php namespace App\Repositories;

use App\Models\Cookbook;
use App\RepositoryInterfaces\CookbookInterface;
use App\Repositories\ContributorRepository;

class CookbookRepository extends BaseRepository implements CookbookInterface
{
	public function __construct(ContributorRepository $contributor_repo)
	{
		$this->contributor = $contributor_repo;
	}

	public function allByUserId($user_id)
	{
		$cookbooks = Cookbook::where([
				'user_id' => $user_id
			])->get();

		return $cookbooks;
	}

	public function delete($id)
	{
		$cookbook = Cookbook::find($id);
		if ( ! $cookbooks) {
			return false;
		}

		$cookbook->delete();
		// TODO: check if is deleted before returning true
		return true;
	}

	public function find($id)
	{
		$cookbook = Cookbook::find($id);
		if ( ! $cookbook) {
			return false;
		}

		return $cookbook;
	}

	public function findByName($name)
	{
		$cookbooks = Cookbook::where([
				'name' => $name
			]);

		return $cookbooks;
	}

	public function store($request)
	{
		$cookbook = Cookbook::create([
				'user_id' => $request->input('user_id'),
				'name' => $request->input('name'),
				'description' => $request->input('description'),
				'is_public' => $request->input('is_public')
			]);

		$contributor = $this->contributor->store(
				$request->input('user_id'),
				$cookbook->id,
				2
			);

		return $cookbook->id;
	}

	// TODO: Add update
}
