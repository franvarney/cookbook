<?php namespace App\Repositories;

use App\Models\Comment;
use App\RepositoryInterfaces\CommentInterface;

class CommentRepository extends BaseRepository implements CommentInterface
{
	public function allByRecipeId($recipe_id)
	{
		//$comments = Comment::with('comment_recipe')->get(); TODO: figure this shizz out

		if ( ! $comments) {
			return false;
		}

		return $comments;
	}

	public function destroy($id)
	{
		$comment = Comment::find($id);

		if ( ! $comment) {
			return false;
		}

		// TODO:
		// -- detach from recipe
		// -- find comment in comment_recipe
		// -- if match exists, detach
		return true;
	}

	public function store($request)
	{
		$new_comment = Comment::create([
				$request->input('comment')
			]);

		if ($input->recipe_id) {
			// TODO: attach to comment_recipe
		}

		return $new_comment->id;
	}
}
