<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ContributorRepository;
use App\Transformers\ContributorTransformer;
use Illuminate\Http\Response;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;

class ContributorController extends Controller
{
	public function __construct(
			ContributorRepository $contributor_repo,
			ContributorTransformer $contributor_transformer,
			Manager $manager
		)
	{
		$this->contributor = $contributor_repo;
		$this->transformer = $contributor_transformer;
		$this->manager = $manager->setSerializer(new JsonApiSerializer());
	}

	public function destroy($id)
	{
		$deleted = $this->contributor->destory($id);
		if ( ! $deleted) {
			return response(['errors' => 'Contributor not found!'], 404);
		}

		return response(['success' => 'Contributor deleted!'], 204);
	}

	public function allByCookbookId($cookbook_id)
	{
		$contributors = $this->contributor->allByCookbookId($cookbook_id);
		if ( ! $contributors) {
			return response(['errors' => 'Contributors not found!'], 404);
		}

		$items = new Collection($contributors, $this->transformer, 'contributors');
		$data = $this->manager->createData($items)->toArray();

		return response($data, 200);
	}

	public function allByUserId($user_id)
	{
		$contributors = $this->contributor->allByUserId($user_id);
		if ( ! $contributors) {
			return response(['errors' => 'Contributors not found!'], 404);
		}

		$items = new Collection($contributors, $this->transformer, 'contributor');
		$data = $this->manager->createData($items)->toArray();

		return response($data, 200);
	}
}
