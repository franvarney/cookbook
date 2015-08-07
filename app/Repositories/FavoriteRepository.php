<?php namespace App\Repositories;

use App\Models\Favorite;
use App\RepositoryInterfaces\FavoriteInterface;

class FavoriteRepository extends BaseRepository implements FavoriteInterface
{
	protected $modelClassName = 'Favorite';

	public function allByCookbookId($cookbook_id)
	{
		$where = call_user_func_array("App\\$this->modelClassName::where", array('cookbook_id', $cookbook_id));
		return $where->get();
	}

	public function allByUserId($user_id)
	{
		$where = call_user_func_array("App\\$this->modelClassName::where", array('user_id', $user_id));
		return $where->get();
	}
}
