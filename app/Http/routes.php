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

Route::get('/shopping', 'HomeController@showUsers');
Route::get('home', 'HomeController@redirect');

Route::get('items', 'HomeController@showItems');

Route::get('/', ['as' => 'shopping', 'uses' =>'GroceryListController@index']);
Route::post('/','GroceryListController@store');

Route::get('comparison', ['as' => 'comp', 'uses' => 'ItemController@index']);
Route::post('comparison','ItemController@store');

Route::get('stores', ['as' => 'stores', 'uses' =>'StoreController@index']);
Route::post('stores', 'StoreController@store');

Route::post('recent_new', ['as' => 'recent_new', 'uses' =>'RecentListController@saveList']);

Route::get('recent', ['as' => 'recent', 'uses' =>'RecentListController@index']);
Route::post('recent', 'RecentListController@store');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
