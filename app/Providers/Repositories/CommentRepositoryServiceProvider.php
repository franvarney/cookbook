<?php namespace App\Providers\Repositories;

use App\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Support\ServiceProvider;

class CommentRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\RepositoryInterfaces\CommentInterface', function($app)
		{
			return new CommentRepository(new Comment());
		});
	}
}