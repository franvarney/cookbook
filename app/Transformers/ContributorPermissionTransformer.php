<?php namespace App\Transformers;

use App\Models\ContributorPermission;
use App\Transformers\ContributorTransformer;
use App\Transformers\UserTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ContributorPermissionTransformer extends TransformerAbstract
{
	public function __construct(
			Manager $manager,
			ContributorTransformer $contributor_transformer,
			UserTransformer $user_transformer
		)
	{
		$this->manager = $manager;
		$this->contributor_transformer = $contributor_transformer;
		$this->user_transformer = $user_transformer;
	}

	public function transform(ContributorPermission $permission)
	{
		$item = new Item($permission->contributor, $this->contributor_transformer);
		$contributor = $this->manager->createData($item)->toArray();

		$item = new Item($permission->user, $this->user_transformer);
		$user = $this->manager->createData($item)->toArray();

		return [
				'contributor' => $contributor['data']['contributor'],
				'user' => $user['data'],
				'can_add_contributors' => (bool) $permission->can_add_contributors,
				'can_edit_cookbook' => (bool) $permission->can_edit_cookbook,
				'can_delete_cookbook' => (bool) $permission->can_delete_cookbook,
				'can_edit_recipe' => (bool) $permission->can_edit_recipe,
				'can_delete_recipe' => (bool) $permission->can_delete_recipe,
				'created' => date('m/d/y', strtotime($permission->created_at)),
				'updated' => date('m/d/y', strtotime($permission->updated_at))
			];
	}
}