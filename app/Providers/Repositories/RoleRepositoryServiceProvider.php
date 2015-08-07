<?php namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\Role;
use App\Repositories\RoleRepository;

class RoleRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\RoleInterface', function($app)
		{
			return new RoleRepository(new Role());
		});
	}
}