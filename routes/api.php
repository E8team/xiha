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
    Route::get('me/notifications/unread_count', 'MeController@showUnreadNotificationsCount');
    Route::get('me/notifications', 'MeController@getNotifications');
    Route::patch('me/notifications/read/{id?}', 'MeController@markAsRead');

    Route::match(['put', 'patch'], 'me', 'MeController@update');
    Route::apiResource('jokes', 'JokesController');
    Route::vote('jokes', 'JokesController');
    Route::get('jokes/{joke}/comments', 'JokesController@showComments');
    Route::post('jokes/{joke}/comment', 'JokesController@storeComment');
    Route::vote('comments', 'CommentsController', ['except' => 'down_vote']);
    Route::get('users/{user}', 'UsersController@show');
    Route::get('users/{user}/jokes', 'UsersController@jokes');

});

