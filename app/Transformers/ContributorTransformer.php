<?php namespace App\Transformers;

use App\Models\Contributor;
use App\Transformers\CookbookTransformer;
use App\Transformers\RoleTransformer;
use App\Transformers\UserTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ContributorTransformer extends TransformerAbstract
{
	public function __construct(
			Manager $manager,
			CookbookTransformer $cookbook_transformer,
			RoleTransformer $role_transformer,
			UserTransformer $user_transformer
		)
	{
		$this->manager = $manager;
		$this->cookbook_transformer = $cookbook_transformer;
		$this->role_transformer = $role_transformer;
		$this->user_transformer = $user_transformer;
	}

	public function transform(Contributor $contributor)
	{
		$item = new Item($contributor->cookbook, $this->cookbook_transformer);
		$cookbook = $this->manager->createData($item)->toArray();

		$item = new Item($contributor->role, $this->role_transformer);
		$role = $this->manager->createData($item)->toArray();

		$item = new Item($contributor->user, $this->user_transformer);
		$user = $this->manager->createData($item)->toArray();

		return [
				'contributor' => $user['data'],
				'cookbook' => $cookbook['data'],
				'role' => $role['data'],
				'created' => date('m/d/y', strtotime($contributor->created_at)),
				'updated' => date('m/d/y', strtotime($contributor->updated_at))
			];
	}
}