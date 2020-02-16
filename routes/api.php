<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', 'Api\AuthController@login')->middleware('guest');
Route::post('/sign-up', 'Api\AuthController@signUp')->middleware('guest');



Route::get('/spots', 'Api\SpotController@index');
Route::get('/spots/{spot}', 'Api\SpotController@single');

Route::get('/my-spots', 'SpotController@mySpots')->middleware('jwt.auth');
Route::post('/spots/new', 'Api\SpotController@new')->middleware('jwt.auth');
Route::post('/temp-uploads', 'Api\TempMediaController@store');



// Route::post('/spots/{spot}', 'SpotController@update')->middleware('auth');

// Route::get('spots/{spot}', 'Api\SpotController@show');
// Route::patch('spots/{spot}', 'Api\SpotController@update');
// Route::post('spots/new', 'Api\SubmissionController@store');

// Route::post('spots/{spot}/requests', 'Api\BookingRequestController@store');

// Route::post('spots/{spot}/edit-token/email', 'Api\EditTokenEmailController@create');

// Route::put('spots/{spot}/moderate', 'Api\SpotModerationController@update');

