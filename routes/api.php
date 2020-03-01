<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Auth
Route::post('/login', 'Api\AuthController@login')->middleware('guest');
Route::post('/sign-up', 'Api\AuthController@signUp')->middleware('guest');


// Spots
Route::get('/spots', 'Api\SpotController@index');
Route::get('/spots/{spot}', 'Api\SpotController@single');
Route::post('/spots/{spot}', 'Api\SpotController@update');


// My Spot
Route::get('/my-spots', 'Api\SpotController@mySpots')->middleware('jwt.auth');
Route::post('/spots/new', 'Api\SpotController@new')->middleware('jwt.auth');
Route::post('/temp-uploads', 'Api\TempMediaController@store');