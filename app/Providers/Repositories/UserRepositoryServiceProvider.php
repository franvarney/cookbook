<?php namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\User;
use App\Repositories\UserRepository;

class UserRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\UserInterface', function($app)
		{
			return new UserRepository(new User());
		});
	}
}