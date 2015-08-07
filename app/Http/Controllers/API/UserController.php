<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;

class UserController extends BaseController
{
	public function __construct(
			Manager $manager,
			UserRepository $user_repo,
			UserTransformer $user_transformer
		)
	{
		$this->manager = $manager->setSerializer(new JsonApiSerializer());
		$this->user = $user_repo;
		$this->transformer = $user_transformer;
	}

	public function destroy($id)
	{
		$deleted = $this->user->destroy($id);
		if ( ! $deleted) {
			return response()->json(['errors' => 'Unable to delete user.'], 422);
		}

		return response()->json(['success' => 'User deleted!'], 204);
	}

	public function show($id)
	{
		$user = $this->user->find($id);
		if ( ! $user) {
			return response()->json(['errors' => 'User not found.'], 404);
		}

		$item = new Item($user, $this->transformer, 'user');
		$data = $this->manager->createData($item)->toArray();

		return response()->json($data, 200);
	}

	public function store(Request $request)
	{
		$user_id = $this->user->store($request);
		if ( ! $user_id) {
			return response()->json(['errors' => 'Failed to create user.'], 422);
		}

		$success = array(
				'success' => [
				'message' => 'User created!',
				'id' => $user_id
			]);

		return response()->json($success, 201);
	}

	public function update($id, Request $request)
	{
		$user_id = $this->user->update($id, $request);
		if ( ! $user_id) {
			return response()->json(['errors' => 'User not found.'], 404);
		}

		$success = array(
				'success' => [
				'message' => 'User updated!',
				'id' => $user_id
			]);

		return response()->json($success, 201);
	}
}
