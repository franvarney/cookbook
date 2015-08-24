<?php namespace App\Http\Controllers\Api;

use App\Models\Contributor;
use League\Fractal\Manager;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Collection;
use App\Transformers\ContributorTransformer;
use League\Fractal\Serializer\JsonApiSerializer;

class ContributorController extends Controller
{
	public function __construct(
			ContributorTransformer $contributor_transformer,
			Manager $manager
		)
	{
		$this->transformer = $contributor_transformer;
		$this->manager = $manager->setSerializer(new JsonApiSerializer());
	}

	public function allByCookbookId($cookbook_id)
	{
		$contributors = Contributor::where(['cookbook_id' => $cookbook_id])->get();
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

	public function destroy($id)
	{
		Contributor::destroy($id);
		return response(['success' => 'Contributor deleted!'], 204);
	}
}
