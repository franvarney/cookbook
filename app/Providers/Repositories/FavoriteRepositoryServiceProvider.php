<?php namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\Favorite;
use App\Repositories\FavoriteRepository;

class FavoriteRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\FavoriteInterface', function($app)
		{
			return new FavoriteRepository(new Favorite());
		});
	}
}