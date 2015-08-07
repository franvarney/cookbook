<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
	public function __construct(CommentRepository $comment_repo)
	{
		$this->comment = $comment_repo;
	}

	public function allByRecipeId($recipe_id)
	{
		$comments = $this->comment->allByRecipeId($recipe_id);
		if ( ! $comments) {
		  return response(['errors' => 'Comments not found.'], 404);
		}

		return response($comments, 200);
	}

	public function destroy($id)
	{
		$deleted = $this->comment->destroy($id);
		if ( ! $deleted) {
		  return response(['errors' => 'Unable to delete.'], 422);
		}

		return response(['success' => 'Comment deleted!'], 204);
	}

	public function store(Request $request)
	{
		$comment_id = $this->comment->store($request);
		if ( ! $comment_id) {
		  return response(['errors' => 'Failed to create comment.'], 422);
		}

		$success = array(
			'success' => [
				'message' => 'Comment created!',
				'id' => $comment_id
		  ]);

		return response($success, 201);
	}
}
