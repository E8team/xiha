<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'API', 'as' => 'api.'], function () {
    Route::group(['as' => 'auth.', 'prefix' => 'auth'], function () {
        Route::post('refresh', 'AuthController@refresh');
        Route::post('logout', 'AuthController@logout');
    });

    Route::post('ajax_upload_image', 'ImageController@upload');

    Route::get('me', 'MeController@show');
    Route::match(['put', 'patch'], 'me', 'MeController@update');
    Route::apiResource('jokes', 'JokesController');
    Route::vote('jokes', 'JokesController');
    Route::get('users/{user}', 'UsersController@show');
    Route::get('users/{user}/jokes', 'UsersController@jokes');

});
