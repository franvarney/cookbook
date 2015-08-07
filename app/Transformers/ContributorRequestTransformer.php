<?php namespace App\Transformers;

use App\Models\ContributorRequest;
use App\Transformers\CookbookTransformer;
use App\Transformers\UserTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ContributorRequestTransformer extends TransformerAbstract
{
	public function __construct(
			Manager $manager,
			CookbookTransformer $cookbook_transformer,
			UserTransformer $user_transformer
		)
	{
		$this->manager = $manager;
		$this->cookbook_transformer = $cookbook_transformer;
		$this->user_transformer = $user_transformer;
	}

	public function transform(ContributorRequest $request)
	{
		$item = new Item($request->cookbook, $this->cookbook_transformer);
		$cookbook = $this->manager->createData($item)->toArray();

		$item = new Item($request->receiver, $this->user_transformer);
		$receiver = $this->manager->createData($item)->toArray();

		$item = new Item($request->sender, $this->user_transformer);
		$sender = $this->manager->createData($item)->toArray();

		return [
				'cookbook' => $cookbook['data'],
				'receiver' => $receiver['data'],
				'sender' => $sender['data'],
				'created' => date('m/d/y', strtotime($request->created_at)),
				'updated' => date('m/d/y', strtotime($request->updated_at))
			];
	}
}