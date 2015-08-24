<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store($user_id, $recipe_id)
    {
        $this->client->post(env('API_URL') . '/favorite/' . \Auth::user()->id . '/' . $recipe_id);
        return redirect('/recipe/' . $recipe_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->client->delete(env('API_URL') . '/unfavorite/' . $id);
        return redirect()->back(); // TODO change this to recipe/id
    }
}
