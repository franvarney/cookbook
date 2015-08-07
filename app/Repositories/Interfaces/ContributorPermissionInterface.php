<?php namespace App\RepositoryInterfaces;

interface ContributorPermissionInterface extends BaseInterface {

	public function allByUserId($user_id);
	public function store($user_id, $contributor_id);
	public function update($id, $input);

}
