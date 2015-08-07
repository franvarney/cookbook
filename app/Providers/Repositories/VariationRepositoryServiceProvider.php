<?php namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\Variation;
use App\Repositories\VariationRepository;

class VariationRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\VariationInterface', function($app)
		{
			return new VariationRepository(new Variation());
		});
	}
}