<?php namespace App\Http\Controllers;

use App\Http\Requests;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $response = $this->client->get(env('API_URL') . '/cookbooks/' . \Auth::user()->id . '/contributor/list');

        $contents = new \StdClass;
        $contents->cookbooks = json_decode($response->getBody());

        return view('recipes.create', ['contents' => $contents]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $response = $this->client->post(env('API_URL') . '/recipe', ['form_params' => $request->all()]);
        return redirect('/recipe/' . json_decode($response->getBody())->recipe_id);
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

        $recipe_response = $this->client->get(env('API_URL') . '/recipe/' . $id . '/full');
        $contents->recipe = json_decode($recipe_response->getBody())->recipe[0];

        $favorite_response = $this->client->get(env('API_URL') . '/favorite/' . \Auth::user()->id . '/' . $id);
        $contents->favorite = json_decode($favorite_response->getBody())->favorite;

        return view('recipes.show', ['contents' => $contents]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $contents = new \StdClass;

        $recipe_response = $this->client->get(env('API_URL') . '/recipe/' . $id . '/full');
        $contents->recipe = json_decode($recipe_response->getBody())->recipe[0];

        $cookbooks_response = $this->client->get(env('API_URL') . '/cookbooks/' . \Auth::user()->id . '/contributor/list');
        $contents->cookbooks = json_decode($cookbooks_response->getBody());

        $tags = (string) NULL;
        foreach($contents->recipe->tags as $key => $tag) {
            $tags .= $tag->tag;
            if($key + 1 != count($contents->recipe->tags)) {
                $tags .= ', ';
            }
        }
        $contents->recipe->tags = $tags;

        return view('recipes.edit', ['contents' => $contents]);
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
        $response = $this->client->put(env('API_URL') . '/recipe', ['form_params' => $request->all()]);
        return redirect('/recipe/' . json_decode($response->getBody())->recipe_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $response = $this->client->delete(env('API_URL') . '/recipe/' . $id);
        return redirect('/');
    }

    public function importCreate()
    {
        return view('recipes.import');
    }

    public function import()
    {
        // TODO Refactor!!! 
        // http://www.foodnetwork.com/recipes/food-network-kitchens/whole-wheat-spaghetti-with-leeks-and-hazelnuts-recipe.html
        $contents = new \StdClass;
        $cookbooks_response = $this->client->get(env('API_URL') . '/cookbooks/' . \Auth::user()->id . '/contributor/list');
        $contents->cookbooks = json_decode($cookbooks_response->getBody());
        $recipe = new \StdClass;

        $url = \Input::get('url');
        $recipe->url = $url;
        $output = file_get_contents($url);

        $regex_title = '/<h1 itemprop=name>(.*)<\/h1>/i';
        preg_match($regex_title, $output, $match);
        if( ! empty($match)) {
            $recipe->title = $match[1];
        } else {
            return redirect('/recipe/import')->withInput()->with('message', 'Cannot parse contents of chosen url, please try another or use the <a href="/recipe/create">manual entry form</a>.');
        }

        $regex_prep = '/<dt>Prep:<\/dt><dd>(.*)<\/dd>/i';
        preg_match($regex_prep, $output, $match);
        if(explode(' ', $match[1])[1] == 'min') {
            $match[1] = explode(' ', $match[1])[0] . ' minutes';
        }
        $recipe->prep_time = $match[1];

        $regex_cook = '/<dt>Cook:<\/dt><dd>(.*)<\/dd>/i';
        preg_match($regex_cook, $output, $match);
        if(explode(' ', $match[1])[1] == 'min') {
            $match[1] = explode(' ', $match[1])[0] . ' minutes';
        }
        $recipe->cook_time = $match[1];

        $regex_yields = '/<meta itemprop=recipeYield content=(.*)>/i'; // TODO get content inside quotes instead of using str_replace()
        preg_match($regex_yields, $output, $match);
        $recipe->yields = str_replace('"', '', $match[1]);

        $regex_description = '/<meta itemprop=description content=(.*)>/i'; // TODO get content inside quotes instead of using str_replace()
        preg_match($regex_description, $output, $match);
        $recipe->description = str_replace('"', '', $match[1]);

        $regex_ingredients = '/<li itemprop=ingredients>(.*)<\/li>/i';
        preg_match_all($regex_ingredients, $output, $match);
        foreach($match[1] as $ing)
        {
            $item = strtolower(strip_tags($ing));
            $var = explode(' ', $item);
            $ingredients = new \StdClass;
            $ingredients->amount = substr($item, 0, strpos($item, ' '));
            if($var[0] != '') {
                $ingredients->unit = $var[1];
                $ingredient = explode(' ', $item, 3);
                $ingredients->ingredient = trim($ingredient[2]);
            } else {
                $ingredients->unit = '';
                $var2 = explode(' ', $item, 1);
                $ingredients->ingredient = trim($var2[0]);
            }
            $ings[] = $ingredients;
        }
        $recipe->ingredients = $ings;

        // TODO get directions
        // $regex_directions = '/<div [^>]* itemprop="recipeInstructions">/i';
        // preg_match_all($regex_directions, $output, $match);

        $regex_tags = '/<li itemprop=recipeCategory><a\b[^>]*>(.*)<\/a><\/li>/i';
        preg_match_all($regex_tags, $output, $match);
        $tags = (string) NULL;
        foreach($match[1] as $key => $tag) {
            $tags .= strtolower(strip_tags($tag));
            if($key + 1 != count($match[1])) {
                $tags .= ', ';
            }
        }
        $recipe->tags = $tags;
        $contents->recipe = $recipe;

        return view('recipes.edit-import', ['contents' => $contents]);
    }
}
