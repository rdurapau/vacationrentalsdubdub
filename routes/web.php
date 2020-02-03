<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::redirect('/home', '/#/spots/new');
Route::get('/_healthcheck', function(){ return 'healthy'; });
Route::get('/_authcheck', function(){ return \Auth::id(); })->middleware('auth');


Route::get('/', 'AppController@index')->name('index');

Route::get('/my-spots', 'SpotController@mySpots')->middleware('auth');
Route::post('/spots/new', 'SpotController@new')->middleware('auth');
Route::post('/spots/{spot}', 'SpotController@update')->middleware('auth');


// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/spots', 'SpotController@index')->name('spots.index');
// Route::get('/spots/{spot}', 'SpotController@_edit');
// Route::patch('/spots/{spot}', 'SpotController@update')->name('spots.update');
// Route::get('/spots/{spot}/{editToken}', 'SpotController@edit')->name('spots.edit');
    

/////////////////////////////////////////////////////
// Dev

// Route::get('/map', 'HomeController@map')->name('map');
// Route::get('/photos/new', 'PhotoController@create');
// Route::post('/photos', 'PhotoController@store');

// Route::get('/static', function(){return view('static.index');});
// Route::get('/static/form', function(){return view('static.form');});
// Route::get('/static/done', function(){return view('static.done');});
// Route::get('/static/about', function(){return view('static.about');});
// Route::get('/static/tos', function(){return view('static.tos');});
// Route::get('/static/warn', function(){return view('static.warn');});
// Route::get('/static/submit', function(){return view('static.submit');});
// Route::get('/static/welcome', function(){return view('static.welcome');});

// Route::get('/emails/spot-approved', 'EmailTestController@spotApproved');
// Route::get('/emails/spot-created-and-approved', 'EmailTestController@spotCreatedAndApproved');
// Route::get('/emails/spot-rejected', 'EmailTestController@spotRejected');
// Route::get('/emails/spot-submitted', 'EmailTestController@spotSubmitted');
// Route::get('/emails/spot-edit-url', 'EmailTestController@spotEditUrl');
// Route::get('/emails/new-request', 'EmailTestController@newRequest');
// Route::get('/emails/new-request-confirm', 'EmailTestController@newRequestConfirm');
