<?php namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\Unit;
use App\Repositories\UnitRepository;

class UnitRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\UnitInterface', function($app)
		{
			return new UnitRepository(new Unit());
		});
	}
}