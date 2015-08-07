<?php namespace App\RepositoryInterfaces;

interface CookbookInterface extends BaseInterface {

	public function allByUserId($user_id);
	public function delete($id);
	public function find($id);
	public function findByName($name);
	public function store($request);

}
