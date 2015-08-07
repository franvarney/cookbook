<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Http\Exception\HttpResponseException;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;


class AuthController extends Controller {

	public function __construct(
			Manager $manager,
			UserRepository $user_repo,
			UserTransformer $user_transformer
		)
	{
		$this->manager = $manager->setSerializer(new JsonApiSerializer());
		$this->user = $user_repo;
		$this->transformer = $user_transformer;
	}

	public function login(Request $request) {
		$user = $this->user->findUser($request);
		if ( ! $user) {
			return response()->json(['errors' => 'User not found or wrong credentials.'], 404);
		}

		$item = new Item($user, $this->transformer, 'user');
		$data = $this->manager->createData($item)->toArray();

		return response()->json($data, 200);
	}
}