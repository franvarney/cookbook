<?php namespace App\RepositoryInterfaces;

interface FavoriteInterface extends BaseInterface {

	public function allByCookbookId($cookbook_id);
	public function allByUserId($user_id);

}
