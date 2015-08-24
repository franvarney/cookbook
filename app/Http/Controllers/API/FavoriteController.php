<?php namespace App\Http\Controllers\API;

use App\Models\Recipe;
use App\Http\Requests;
use GuzzleHttp\Client;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function allByCookbookId($cookbook_id)
    {
        $recipe_ids = Recipe::where(['cookbook_id' => $cookbook_id])->lists('id');
        $favorites = Favorite::whereIn('recipe_id', $recipe_ids)->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function allByUserId($user_id)
    {
        $favorites = Favorite::where(['user_id', $user_id])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store($user_id, $recipe_id)
    {
        $favorite = Favorite::withTrashed()->where(['user_id' => $user_id, 'recipe_id' => $recipe_id])->first();

        if(isset($favorite)) {
            $favorite->restore();
            $favorite->favorite = 1;
            $favorite->touch();
            $favorite->save();
        } else {
            Favorite::create([
                'user_id' => $user_id,
                'recipe_id' => $recipe_id,
                'favorite' => 1
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($user_id, $recipe_id)
    {
        $favorite = Favorite::where(['user_id' => $user_id, 'recipe_id' => $recipe_id])->first();

        if(isset($favorite) && $favorite->favorite == 1) {
            return response()->json(['favorite' => $favorite->id], 200);
        }

        return response()->json(['favorite' => false], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $favorite = Favorite::find($id);
        $favorite->favorite = 0;
        $favorite->touch();
        $favorite->save();
        $favorite->delete($id);
    }
}
