<?php namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\Tag;
use App\Repositories\TagRepository;

class TagRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\TagInterface', function($app)
		{
			return new TagRepository(new Tag());
		});
	}
}