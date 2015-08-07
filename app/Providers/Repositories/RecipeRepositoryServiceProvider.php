<?php namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\Recipe;
use App\Repositories\RecipeRepository;

class RecipeRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\RecipeInterface', function($app)
		{
			return new RecipeRepository(new Recipe());
		});
	}
}