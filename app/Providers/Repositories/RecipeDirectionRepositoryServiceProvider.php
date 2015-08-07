<?php namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\RecipeDirection;
use App\Repositories\RecipeDirectionRepository;

class RecipeDirectionRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\RecipeDirectionInterface', function($app)
		{
			return new RecipeDirectionRepository(new RecipeDirection());
		});
	}
}