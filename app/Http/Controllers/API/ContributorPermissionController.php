<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ContributorPermissionRepository;
use App\Transformers\ContributorPermissionTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;

class ContributorPermissionController extends Controller
{
	public function __construct(
			ContributorPermissionRepository $permissions_repo,
			ContributorPermissionTransformer $permissions_transformer,
			Manager $manager
		)
	{
		$this->permissions = $permissions_repo;
		$this->transformer = $permissions_transformer;
		$this->manager = $manager->setSerializer(new JsonApiSerializer());
	}

	public function allByUserId($user_id)
	{
		$permissions = $this->permissions->allByUserId($user_id);
		if ( ! $permissions) {
			return response(['errors' => 'Permissions not found!'], 404);
		}

		$items = new Collection($permissions, $this->transformer, 'permissions');
		$data = $this->manager->createData($items)->toArray();

		return response($data, 200);
	}

	public function update($id, Request $request)
	{
		$permissions_id = $this->permissions->update($id, $request); // TODO: inject input
		if ( ! $updated) {
			return response(['errors' => 'Permissions not found!'], 404);
		}

		$success = array(
				'success' => [
					'message' => 'Permissions updated!',
					'id' => $permissions_id
			]);

		return response($success, 204);
	}
}
