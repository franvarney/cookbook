<?php namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\Contributor;
use App\Repositories\ContributorRepository;

class ContributorRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\ContributorInterface', function($app)
		{
			return new ContributorRepository(new Contributor());
		});
	}
}