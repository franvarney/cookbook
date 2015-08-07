<?php namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\RecipeIngredient;
use App\Repositories\RecipeIngredientRepository;

class RecipeIngredientRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\RecipeIngredientInterface', function($app)
		{
			return new RecipeIngredientRepository(new RecipeIngredient());
		});
	}
}