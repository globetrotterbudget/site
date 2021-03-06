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

Route::get('/', function () {
    return view('layouts.location');
});


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::resource('users', 'UsersController');
Route::get('auth/about', 'PageController@aboutUs');

Route::get('/days', 'PageController@days');

Route::get('/groupsize', 'PageController@groupsize');
Route::get('/accommodations', 'PageController@accommodations');

Route::get('/location', 'PageController@location');
Route::get('/transportation', 'PageController@transportation');
Route::get('/food', 'PageController@food');
Route::get('/entertainment', 'PageController@entertainment');
Route::get('/summary', 'PageController@summary');

Route::get('/save', 'PageController@save');
Route::post('/save', 'PageController@store');

Route::get('/trips', 'PageController@trips');
Route::get('/trips/{tripName}', 'PageController@tripDetail');
Route::post('/trips/{id}/delete', 'PageController@destroy');

Route::get('/trips/{id}/edit', 'PageController@edit');
Route::get('/start', 'PageController@startover');
Route::get('/trips/{id}/update', 'PageController@update');

Route::get('/paris_feature', 'PageController@paris_feature');
Route::get('/tel_aviv_feature', 'PageController@tel_aviv_feature');
Route::get('/tokyo_feature', 'PageController@tokyo_feature');

Route::post('/location', 'PageController@newcity');

Route::get('/cancel', function(Request $request) {
	session()->forget('location');
    session()->forget('itinerary');
	return redirect()->action('PageController@trips');
});

Route::get('/getstarted', 'PageController@tripsEmpty');

