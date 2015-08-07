<?php namespace App\RepositoryInterfaces;

interface RecipeInterface extends BaseInterface {

	public function allByCookbookId($cookbook_id);
	public function allByUserId($user_id);
	public function findByTitle($title);
	public function store($request);
	public function show($recipe_id);
	public function showFull($recipe_id);
	public function update($id, $request);

}
