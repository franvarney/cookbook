<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\CookbookRepository;
use App\Transformers\CookbookTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;

class CookbookController extends Controller
{
	public function __construct(
			CookbookRepository $cookbook_repo,
			CookbookTransformer $cookbook_transformer,
			Manager $manager
		)
	{
		$this->cookbook = $cookbook_repo;
		$this->transformer = $cookbook_transformer;
		$this->manager = $manager->setSerializer(new JsonApiSerializer());
	}

	public function allByUserId($user_id)
	{
		$cookbooks = $this->cookbook->allByUserId($user_id);
		if ( ! $cookbooks || sizeof($cookbooks) === 0) {
			return response()->json(['errors' => 'Cookbooks not found.'], 404);
		}

		$items = new Collection($cookbooks, $this->transformer, 'cookbooks');
		$data = $this->manager->createData($items)->toArray();

		return response()->json($data, 201);
	}

	public function destroy()
	{
		$deleted = $this->cookbook->deleteCookbook($id);
		if ( ! $deleted) {
			return response()->json(['errors' => 'Unable to delete.'], 422);
		}

		return response()->json(['success' => 'Cookbook deleted.'], 204);
	}

	public function show($id)
	{
		$cookbook = $this->cookbook->find($id);
		if ( ! $cookbook) {
			return response()->json(['errors' => 'Cookbook not found.'], 404);
		}

		$item = new Item($cookbook, $this->transformer, 'cookbook');
		$data = $this->manager->createData($item)->toArray();

		return response()->json($data, 201);
	}

	public function store(Request $request)
	{
		$cookbook_id = $this->cookbook->store($request);
		if ( ! $cookbook_id) {
			return response()->json(['errors' => 'Failed to create cookbook.'], 422);
		}

		$success = array(
			'success' => [
				'message' => 'Cookbook created!',
				'id' => $cookbook_id
			]);

		return response()->json($success, 201);
	}

	public function update($id, Request $request)
	{
		$cookbook_id = $this->cookbook->find($id, $request);
		if ( ! $cookbook) {
			return response()->json(['errors' => 'Cookbook not found.'], 404);
		}

		$success = array(
			'success' => [
				'message' => 'Cookbook created!',
				'id' => $cookbook_id
			]);

		return response()->json($success, 204);
	}
}
