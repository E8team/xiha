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

    Route::get('me', 'MeController@show');

    Route::apiResource('jokes', 'JokesController');
    Route::put('jokes/{joke}/up_vote', 'JokesController@upVote');
    Route::put('jokes/{joke}/down_vote', 'JokesController@downVote');
    Route::put('jokes/{joke}/cancel_vote', 'JokesController@cancelVote');

});
