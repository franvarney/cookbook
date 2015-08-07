<?php namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\Ingredient;
use App\Repositories\IngredientRepository;

class IngredientRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\IngredientInterface', function($app)
		{
			return new IngredientRepository(new Ingredient());
		});
	}
}