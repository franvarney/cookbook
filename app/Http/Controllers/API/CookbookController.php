<?php namespace App\Http\Controllers\Api;

use App\Models\Cookbook;
use App\Models\Contributor;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Collection;
use App\Transformers\CookbookTransformer;
use League\Fractal\Serializer\JsonApiSerializer;

class CookbookController extends Controller
{
	public function __construct(
			CookbookTransformer $cookbook_transformer,
			Manager $manager
		)
	{
		$this->transformer = $cookbook_transformer;
		$this->manager = $manager->setSerializer(new JsonApiSerializer());
	}

	public function allIfContributor($user_id)
	{
		$contributor_cookbook_ids = Contributor::where(['user_id' => $user_id])->lists('cookbook_id');
		$cookbooks = Cookbook::whereIn('id', $contributor_cookbook_ids)->get();

		$items = new Collection($cookbooks, $this->transformer, 'cookbooks');
		$data = $this->manager->createData($items)->toArray();

		return response()->json($data, 201);
	}

	public function allIfContributorList($user_id)
	{
		$contributor_cookbook_ids = Contributor::where(['user_id' => $user_id])->lists('cookbook_id');
		$cookbooks = Cookbook::whereIn('id', $contributor_cookbook_ids)->lists('name', 'id');

		return response()->json($cookbooks, 201);
	}

	public function allByUserId($user_id)
	{
		$cookbooks = Cookbook::where(['user_id' => $user_id])->get();
		if ( ! $cookbooks) {
			return response()->json(['errors' => 'Cookbooks not found.'], 404);
		}

		$items = new Collection($cookbooks, $this->transformer, 'cookbooks');
		$data = $this->manager->createData($items)->toArray();

		return response()->json($data, 201);
	}

	public function destroy($id)
	{
		Cookbook::destroy($id);
		return response()->json(['success' => 'Cookbook deleted.'], 204);
	}

	public function show($id)
	{
		$cookbook = Cookbook::find($id);
		if ( ! $cookbook) {
			return response()->json(['errors' => 'Cookbook not found.'], 404);
		}

		$item = new Item($cookbook, $this->transformer, 'cookbook');
		$data = $this->manager->createData($item)->toArray();

		return response()->json($data, 201);
	}

	public function store()
	{
		$cookbook = Cookbook::create([
			'user_id' => \Input::get('user_id'),
			'name' => \Input::get('name'),
			'description' => \Input::get('description'),
			'is_public' => \Input::get('is_public') == null ?  0 : \Input::get('is_public')
		]);

		if ( ! $cookbook->id) {
			return response()->json(['errors' => 'Failed to create cookbook.'], 422);
		}

		Contributor::create([
			'user_id' => \Input::get('user_id'),
			'cookbook_id' => $cookbook->id,
			'role_id' => 2
		]);

		return response()->json(['cookbook_id' => $cookbook->id], 201);
	}

	public function update($id)
	{
		$cookbook = Cookbook::find($id);

		if ( ! $cookbook) {
			return response()->json(['errors' => 'Cookbook not found.'], 404);
		}

		$cookbook->name = \Input::get('name');
		$cookbook->description = \Input::get('description');
		$cookbook->is_public = \Input::get('is_public');
		$cookbook->touch();
		$cookbook->save();

		return response()->json(['cookbook_id' => $id], 204);
	}
}
