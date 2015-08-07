<?php namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\ContributorPermission;
use App\Repositories\ContributorPermissionRepository;

class ContributorPermissionRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\ContributorPermissionInterface', function($app)
		{
			return new ContributorPermissionRepository(new ContributorPermission());
		});
	}
}