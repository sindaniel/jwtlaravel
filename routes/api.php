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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('auth', 'ApiAuthController@userAuth');


Route::middleware(['jwt.auth'])->group(function(){

    Route::post('user', 'ApiAuthController@getUser');

    Route::get('users', 'ApiAuthController@list');
    Route::get('users/{user_id}', 'ApiAuthController@get');
    Route::post('users/{user_id}', 'ApiAuthController@post');
});