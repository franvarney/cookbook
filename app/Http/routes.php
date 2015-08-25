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

Route::get('/', 'HomeController@show');

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
	Route::put('request/{id}/approve/{user_id}', 'ContributorRequestController@approve');
	Route::put('request/{id}/deny', 'ContributorRequestController@deny');
	Route::delete('request/{id}', 'ContributorRequestController@destroy');

	// Cookbooks
	Route::get('cookbooks/{user_id}/contributor', 'CookbookController@allIfContributor');
	Route::get('cookbooks/{user_id}/contributor/list', 'CookbookController@allIfContributorList');
	Route::get('cookbooks/{user_id}/user', 'CookbookController@allByUserId');
	Route::get('cookbook/{id}', 'CookbookController@show');
	Route::post('cookbook', 'CookbookController@store');
	Route::put('cookbook/{id}', 'CookbookController@update');
	Route::delete('cookbook/{id}', 'CookbookController@destroy');

	// Favorites
	Route::get('favorite/{user_id}/{recipe_id}', 'FavoriteController@show');
	Route::get('favorites/{user_id}/user', 'FavoriteController@allByUserId');
	Route::get('favorites/{cookbook_id}/cookbook', 'FavoriteController@allByCookbookId');
	Route::post('favorite/{user_id}/{recipe_id}', 'FavoriteController@store');
	Route::delete('unfavorite/{id}', 'FavoriteController@destroy');

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
	Route::get('register', 'AuthController@getRegister');
	Route::post('register', 'AuthController@postRegister');
	Route::get('login', 'AuthController@getLogin');
	Route::post('login', 'AuthController@postLogin');
	Route::get('logout', 'AuthController@getLogout');
});

// Users
Route::get('user/{id}', 'UserController@show');

// Cookbooks
Route::get('cookbook/create', 'CookbookController@create');
Route::get('user/{id}/cookbooks', 'CookbookController@index');
Route::get('cookbook/{id}', 'CookbookController@show');
Route::get('cookbook/{id}/edit', 'CookbookController@edit');
Route::post('cookbook', 'CookbookController@store');
Route::put('cookbook/{id}', 'CookbookController@update');
Route::get('cookbook/{id}/delete', 'CookbookController@destroy');

// Favorites
Route::get('favorites/{cookbook_id}/cookbook', 'FavoriteController@allByCookbookId');
Route::get('favorites/{user_id}/user', 'FavoriteController@allByUserId');
Route::get('favorite/{user_id}/{recipe_id}', 'FavoriteController@store');
Route::get('unfavorite/{id}', 'FavoriteController@destroy');

// Recipes
Route::get('recipe/create', 'RecipeController@create');
Route::get('recipe/import', 'RecipeController@importCreate');
Route::get('recipe/{id}', 'RecipeController@show');
Route::get('recipe/{id}/edit', 'RecipeController@edit');
Route::post('recipe', 'RecipeController@store');
Route::post('recipe/import', 'RecipeController@import');
Route::put('recipe/{id}', 'RecipeController@update');
Route::get('recipe/{id}/delete', 'RecipeController@destroy');

// Requests
Route::get('requests/{user_id}', 'ContributorRequestController@index');
Route::post('request', 'ContributorRequestController@store');
Route::get('request/{id}/approve', 'ContributorRequestController@approve');
Route::get('request/{id}/deny', 'ContributorRequestController@deny');
Route::get('request/{id}/cancel', 'ContributorRequestController@cancel');
