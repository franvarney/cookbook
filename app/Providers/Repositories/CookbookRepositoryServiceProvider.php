<?php namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\Cookbook;
use App\Repositories\CookbookRepository;

class CookbookRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\CookbookInterface', function($app)
		{
			return new CookbookRepository(new Cookbook());
		});
	}
}