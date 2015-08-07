<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Api
Route::group(['namespace' => 'Api', 'prefix' => '/api'], function()
{
	// User
	Route::post('register', 'UserController@store');
	Route::get('user/{id}', 'UserController@show');
	Route::put('user/{id}', 'UserController@update');
	Route::delete('user/{id}', 'UserController@destroy');

	// Comments
	Route::get('comments/{recipe_id}/recipe', 'CommentController@allByRecipeId');
	Route::post('comment', 'CommentController@store');
	Route::delete('comment/{id}', 'CommentController@destroy');

	// Contributors
	Route::get('contributors/{user_id}/user', 'ContributorController@allByUserId');
	Route::get('contributors/{cookbook_id}/cookbook', 'ContributorController@allByCookbookId');
	Route::delete('contributor/{id}', 'ContributorController@destroy');

	// Contributor permissions
	Route::get('permissions/{user_id}/user', 'ContributorPermissionController@allByUserId');
	Route::put('permission/{id}', 'ContributorPermissionController@update');

	// Contributor requests
	Route::get('requests/{receiver_user_id}/receiver', 'ContributorRequestController@allByReceiver');
	Route::get('requests/{sender_user_id}/sender', 'ContributorRequestController@allBySender');
	Route::post('request', 'ContributorRequestController@store');
	Route::put('request/{id}/approve', 'ContributorRequestController@approve');
	Route::put('request/{id}/deny', 'ContributorRequestController@deny');
	Route::delete('request/{id}', 'ContributorRequestController@destroy');

	// Cookbooks
	Route::get('cookbooks/{user_id}/user', 'CookbookController@allByUserId');
	Route::get('cookbook/{id}', 'CookbookController@show');
	Route::post('cookbook', 'CookbookController@store');
	Route::put('cookbook', 'CookbookController@update');
	Route::delete('cookbook/{id}', 'CookbookController@destroy');

	// Recipes
	Route::get('recipes/{cookbook_id}/cookbook', 'RecipeController@allByCookbookId');
	Route::get('recipes/{user_id}/user', 'RecipeController@allByUserId');
	Route::get('recipe/{id}', 'RecipeController@show');
	Route::get('recipe/{id}/full', 'RecipeController@showFull');
	Route::post('recipe', 'RecipeController@store');
	Route::put('recipe/{id}', 'RecipeController@update');
	Route::delete('recipe/{id}', 'RecipeController@destroy');
});

// Auth
Route::group(['namespace' => 'Auth'], function()
{
	Route::get('login', 'AuthController@getLogin');
	Route::post('login', 'AuthController@postLogin');
	Route::get('logout', 'AuthController@getLogout');
});

// Users
Route::get('user/{id}', 'UserController@show');

// Cookbooks
Route::get('cookbook/create', 'CookbookController@create');
Route::get('cookbook/{id}', 'CookbookController@show');
Route::get('cookbook/{id}/edit', 'CookbookController@edit');
Route::post('cookbook', 'CookbookController@store');
Route::put('cookbook/{id}', 'CookbookController@update');
Route::delete('cookbook/{id}', 'CookbookController@destroy');

// Recipes
Route::get('recipe/create', 'RecipeController@create');
Route::get('recipe/{id}', 'RecipeController@show');
Route::get('recipe/{id}/edit', 'RecipeController@edit');
Route::post('recipe', 'RecipeController@store');
Route::put('recipe/{id}', 'RecipeController@update');
Route::delete('recipe/{id}', 'RecipeController@destroy');



// Route::get('session', function (\Illuminate\Http\Request $request) {
//     // return Auth::user();
//     return $request->session()->all();
// });
