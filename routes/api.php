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

Route::post('/oauth/token', [
    'uses' => 'API\Auth\LoginAPIController@issueToken',
    'middleware' => 'throttle:6000|6000,1',
]);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {

    Route::post('broadcasting/auth', ['uses' => '\Illuminate\Broadcasting\BroadcastController@authenticate']);

    Route::group(['prefix' => 'user'], function() {

        Route::get('/profile', 'API\UserAPIController@getUserProfile');

    });

    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/', 'API\UserAPIController@getUserNotifications');
        Route::put('mark-as-read', 'API\UserAPIController@markAsReadNotification');
        Route::put('mark-as-read-all', 'API\UserAPIController@markAsReadAllNotifications');
    });

    Route::get('socket/test', function () {
        event(new \App\Events\SampleTestEvent(8));
        return 'Event fired';
    });
});
