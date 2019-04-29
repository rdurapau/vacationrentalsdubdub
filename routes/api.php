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

Route::get('spots', 'Api\SpotController@index');
Route::post('spots', 'Api\SpotController@store');
Route::get('spots/{spot}', 'Api\SpotController@show');

Route::post('spots/{spot}/edit-token/email', 'Api\EditTokenEmailController@create');

Route::put('spots/{spot}/moderate', 'Api\SpotModerationController@update');

Route::post('images', 'Api\ImageController@store');