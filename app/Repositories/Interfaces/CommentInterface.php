<?php namespace App\RepositoryInterfaces;

interface CommentInterface extends BaseInterface {

	public function allByRecipeId($recipe_id);
	public function destroy($id);
	public function store($input);

}
