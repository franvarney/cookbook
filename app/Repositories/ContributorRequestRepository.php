<?php namespace App\Repositories;

use App\Models\ContributorRequest;
use App\RepositoryInterfaces\ContributorRequestInterface;

class ContributorRequestRepository extends BaseRepository implements ContributorRequestInterface
{
	public function __construct(
			ContributorRepository $contributor_repo,
			ContributorPermissionRepository $permissions_repo,
			UserRepository $user_repo
		)
	{
		$this->contributor = $contributor_repo;
		$this->permissions = $permissions_repo;
		$this->user = $user_repo;
	}

	public function allByReceiverUserId($receiver_user_id)
	{
		$requests = ContributorRequest::where([
				'receiver_user_id' => $receiver_user_id
			])->get();

		return $requests;
	}

	public function allBySenderUserId($sender_user_id)
	{
		$requests = ContributorRequest::where([
				'sender_user_id' => $sender_user_id
			])->get();

		return $requests;
	}

	// public function allByUserId($user_id)
	// {
	// 	// TODO: add where approved = 0?
	// 	// -- review this (is this = this file?)
	// 	$requests_received = $this->allByReceiverUserId([
	// 			'user_id' => $user_id
	// 		]);
	// 	$requests_sent = $this->allBySenderUserId([
	// 			'user_id' => $user_id
	// 		]);

	// 	return array($requests_received, $requests_sent);
	// }

	public function approve($request_id)
	{
		$request = ContributorRequest::find($request_id);
		if ( ! $request) {
		  return false;
		}

		$cookbook_id = $request->cookbook_id;
		$request->role_id = 3;
		$request->approved = 1;
		$request->touch();
		$request->save();

		$contributor = $this->contributor->store([
				'user_id' => $user_id,
				'cookbook_id' => $cookbook_id,
				'role_id' => $role_id
			]);

		$permissions = $this->permissions->store([
				'user_id' => $user_id,
				'contributor_id' => $contributor->id,
				'can_add_contributors' => 1,
				'can_edit_cookbook' => 0,
				'can_delete_cookbook' => 0,
				'can_edit_recipe' => 0,
				'can_delete_recipe' => 0
			]);

		return true;
	}

	public function destroy($request_id)
	{
		$request = ContributorRequest::find($request_id);
		if ( ! $request) {
			return false;
		}

		$request->delete();
		// TODO: check if is deleted before returning true
		return true;
	}

	public function deny($request_id)
	{
		$request = ContributorRequest::find($request_id);
		if ( ! $request) {
			return false;
		}

		$request->approved = 0;
		$request->touch();
		$request->save();

		return true;
	}

	public function store($input)
	{
		// TODO: check if cookbook/receiver combo exists and
		// deleted_at < date -1, if true undelete and return id
		$sender_user_id = $input->sender_user_id;
		$cookbook_id = $input->cookbook_id;

		if ( ! $cookbook_id) {
		  return false;
		}

		$receiver_user_id = $this->user->findByUsername([
				'username' => $input->receiver_user
			]);

		if ( ! $receiver_user_id) {
			return false;
		}

		if ($sender_user_id === $receiver_user_id) { // can't send request to self
			return false;
		}

		$new_contributor_request = ContributorRequest::create([
				'sender_user_id' => $sender_user_id,
				'cookbook_id' => $cookbook_id,
				'receiver_user_id' => $receiver_user_id
			]);

		return $new_contributor_request->id;
	}
}
