<?php namespace App\RepositoryInterfaces;

interface ContributorRequestInterface extends BaseInterface {

	public function allByReceiverUserId($receiver_user_id);
	public function allBySenderUserId($sender_user_id);
	public function approve($request_id);
	public function destroy($request_id);
	public function deny($request_id);
	public function store($input);

}
