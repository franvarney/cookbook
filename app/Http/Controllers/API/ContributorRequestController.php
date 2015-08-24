<?php namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Contributor;
use League\Fractal\Manager;
use Illuminate\Http\Response;
use App\Models\ContributorRequest;
use App\Http\Controllers\Controller;
use App\Models\ContributorPermission;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;
use App\Transformers\ContributorRequestTransformer;

class ContributorRequestController extends Controller
{
	public function __construct(
			ContributorRequestTransformer $request_transformer,
			Manager $manager
		)
	{
		$this->transformer = $request_transformer;
		$this->manager = $manager->setSerializer(new JsonApiSerializer());
	}

	public function approve($id, $user_id)
	{
		$request = ContributorRequest::find($id);
		if ( ! $request) {
			return response(['errors' => 'Unable to approve request.'], 422);
		}

		$cookbook_id = $request->cookbook_id;
		$request->approved = 1;
		$request->touch();
		$request->save();

		$contributor = Contributor::create([
			'user_id' => $user_id,
			'cookbook_id' => $cookbook_id,
			'role_id' => 3 // TODO check role
		]);

		ContributorPermission::create([
			'user_id' => $user_id,
			'contributor_id' => $contributor->id,
			'can_add_contributors' => 1,
			'can_edit_cookbook' => 0,
			'can_delete_cookbook' => 0,
			'can_edit_recipe' => 0,
			'can_delete_recipe' => 0
		]);

		return response(['success' => 'Requested approved!'], 200);
	}

	public function deny($id)
	{
		$request = ContributorRequest::find($request_id);
		if ( ! $request) {
			return response(['errors' => 'Request not found.'], 404);
		}

		$request->approved = 0;
		$request->touch();
		$request->save();

		return response(['success' => 'Requested denied!'], 204);
	}

	public function destroy($id)
	{
		ContributorRequest::destroy($id);
		return response(['success' => 'Request deleted!'], 204);
	}

	public function allByReceiver($user_id)
	{
		$requests = ContributorRequest::where(['receiver_user_id' => $user_id])->get();
		if ( ! $requests) {
			return response(['errors' => 'No requests found.'], 404);
		}

		$items = new Collection($requests, $this->transformer, 'requests');
		$data = $this->manager->createData($items)->toArray();

		return response($data, 200);
	}

	public function allBySender($user_id)
	{
		$requests = ContributorRequest::where(['sender_user_id' => $user_id])->get();
		if ( ! $requests) {
			return response(['errors' => 'No requests found.'], 404);
		}

		$items = new Collection($requests, $this->transformer, 'requests');
		$data = $this->manager->createData($items)->toArray();

		return response($data, 200);
	}

	public function store()
	{
		$receiver_user = User::where(['username' => \Input::get('receiver_user')])->first();

		$new_contributor_request = ContributorRequest::create([
			'sender_user_id' => \Input::get('user_id'),
			'cookbook_id' => \Input::get('cookbook_id'),
			'receiver_user_id' => $receiver_user->id
		]);

		return response(['messages' => 'Request sent!'], 200);
	}
}
