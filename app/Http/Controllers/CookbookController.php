<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class CookbookController extends Controller
{
	public function __construct(Client $client)
	{
		$this->client = $client;
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
		// $response = $this->client->post(env('API_URL') . '/cookbook', ['json' => $request]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$contents = new \StdClass;

		$cookbook_response = $this->client->get(env('API_URL') . '/cookbook/' . $id);
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
		//
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}
