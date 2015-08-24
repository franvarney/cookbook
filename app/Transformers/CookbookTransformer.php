<?php namespace App\Transformers;

use App\Models\Cookbook;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use App\Transformers\UserTransformer;
use League\Fractal\TransformerAbstract;

class CookbookTransformer extends TransformerAbstract
{
	public function __construct(
			Manager $manager,
			UserTransformer $user_transformer
		)
	{
		$this->manager = $manager;
		$this->transformer = $user_transformer;
	}

	public function transform(Cookbook $cookbook)
	{
		$item = new Item($cookbook->user, $this->transformer);
		$user = $this->manager->createData($item)->toArray();

		return [
			'id' => $cookbook->id,
			'name' => $cookbook->name,
			'description' => $cookbook->description,
			'creator' => $user['data'],
			'url' => '/cookbook/' . $cookbook->id,
			'public' => (bool) $cookbook->is_public,
			'created' => date('m/d/y', strtotime($cookbook->created_at)),
			'updated' => date('m/d/y', strtotime($cookbook->updated_at))
		];
	}
}
