<?php namespace App\RepositoryInterfaces;

interface TagInterface extends BaseInterface {

	public function clean($tags);
	public function findByTag($tag);
	public function find($id);
	public function store($recipe_id, $tags);

}
