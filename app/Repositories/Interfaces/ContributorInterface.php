<?php namespace App\RepositoryInterfaces;

interface ContributorInterface extends BaseInterface {

	public function allByCookbookId($cookbook_id);
	public function allByUserId($user_id);
	public function destroy($id);
	public function find($contributor_id);
	public function store($user_id, $contributor_id, $role_id);

}
