<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'api/v1'], function() {
    Route::post('/users/authenticate', 'UserController@authenticate');

    // Client API
    Route::get('/clients', 'ClientController@index');
    Route::get('/clients/{id}/list', 'ClientController@indexByUser');
    Route::get('/clients/{id}', 'ClientController@show');
    Route::put('/clients/{id}', 'ClientController@update');
    Route::post('/clients', 'ClientController@create');
});

Route::get('/', function()
{
	return View::make('hello');
});
