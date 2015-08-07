<?php namespace App\RepositoryInterfaces;

interface UserInterface extends BaseInterface {

	public function destroy($id);
	public function findByUsername($username);
	public function find($id);
	public function store($input);
	public function update($id, $input);

}
