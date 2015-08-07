<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ContributorRequestRepository;
use App\Transformers\ContributorRequestTransformer;
use Illuminate\Http\Response;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;

class ContributorRequestController extends Controller
{
	public function __construct(
			ContributorRequestRepository $request_repo,
			ContributorRequestTransformer $request_transformer,
			Manager $manager
		)
	{
		$this->request = $request_repo;
		$this->transformer = $request_transformer;
		$this->manager = $manager->setSerializer(new JsonApiSerializer());
	}

	public function approve($id)
	{
		$approved = $this->request->approve($id);
		if ( ! $approved) {
			return response(['errors' => 'Unable to approve request.'], 422);
		}

		return response(['success' => 'Requested approved!'], 204);
	}

	public function deny($id)
	{
		$denied = $this->request->deny($id);
		if ( ! $denied) {
			return response(['errors' => 'Unable to deny request.'], 422);
		}

		return response(['success' => 'Requested denied!'], 204);
	}

	public function destroy($id)
	{
		$deleted = $this->request->destroy($id);
		if ( ! $deleted) {
			return response(['errors' => 'Unable to delete request'], 422);
		}

		return response(['success' => 'Request deleted!'], 204);
	}

	public function allByReceiver($user_id)
	{
		$requests = $this->request->allByReceiverUserId($user_id);
		if ( ! $requests) {
			return response(['errors' => 'No requests found.'], 404);
		}

		$items = new Collection($requests, $this->transformer, 'requests');
		$data = $this->manager->createData($items)->toArray();

		return response($data, 200);
	}

	public function allBySender($user_id)
	{
		$requests = $this->request->allBySenderUserId($user_id);
		if ( ! $requests) {
			return response(['errors' => 'No requests found.'], 404);
		}

		$items = new Collection($requests, $this->transformer, 'requests');
		$data = $this->manager->createData($items)->toArray();

		return response($data, 200);
	}

	public function store()
	{
		$request_id = $this->request->store(Input::all()); // TODO: inject input
		if ( ! $request_id) {
			return response(['errors' => 'Failed to create request.'], 422);
		}

		$new_request = array(
				'success' => [
					'message' => 'Request sent!',
					'id' => $request_id
			]);

		return response($requests, 200);
	}
}