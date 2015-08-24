<?php namespace App\Http\Controllers;

use App\Http\Requests;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CookbookController extends Controller
{
	public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
	public function index($user_id)
	{
		$contents = new \StdClass;

		$cookbook_response = $this->client->get(env('API_URL') . '/cookbooks/' . $user_id . '/contributor');
		$contents->cookbooks = json_decode($cookbook_response->getBody())->cookbooks;

		$contributors = (string) NULL;
		foreach($contents->cookbooks as $key => $cookbook) {
			$contributor_response = $this->client->get(env('API_URL') . '/contributors/' . $cookbook->id . '/cookbook');
			$contributors[] = json_decode($contributor_response->getBody())->contributors;
		}
		$contents->contributors = $contributors;

		return view('cookbooks.index', ['contents' => $contents]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('cookbooks.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$response = $this->client->post(env('API_URL') . '/cookbook', ['form_params' => $request->all()]);
        return redirect('/cookbook/' . json_decode($response->getBody())->cookbook_id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$cookbook_response = $this->client->get(env('API_URL') . '/cookbook/' . $id);

		$contents = new \StdClass;
		$contents->cookbook = json_decode($cookbook_response->getBody())->cookbook[0];

		$recipe_response = $this->client->get(env('API_URL') . '/recipes/' . $id . '/cookbook');
		$contents->recipes = json_decode($recipe_response->getBody())->recipes;

		return view('cookbooks.show', ['contents' => $contents]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$response = $this->client->get(env('API_URL') . '/cookbook/' . $id);

		$contents = new \StdClass;
		$contents->cookbook = json_decode($response->getBody())->cookbook[0];

		return view('cookbooks.edit', ['contents' => $contents]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$response = $this->client->put(env('API_URL') . '/cookbook/' . $id, ['form_params' => $request->all()]);
		return redirect('/cookbook/' . $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$response = $this->client->delete(env('API_URL') . '/cookbook/' . $id);
		return redirect('/');
	}
}
