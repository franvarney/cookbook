<?php namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\ContributorRequest;
use App\Repositories\ContributorRequestRepository;

class ContributorRequestRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\ContributorRequestInterface', function($app)
		{
			return new ContributorRequestRepository(new ContributorRequest());
		});
	}
}