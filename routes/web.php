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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'SpotController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/map', 'HomeController@map')->name('map');

Route::get('/s/{spot}/{editToken}', 'EditTokenController@edit')->name('editTokens.edit');
Route::patch('/spots/{spot}', 'SpotController@update')->name('spots.update');
    
Route::get('/spots', 'SpotController@index')->name('spots.index');
Route::get('/spots/new', 'SpotController@create')->name('spots.create');
Route::post('/spots', 'SpotController@store')->name('spots.store');
// Route::get('/spots/{spot}', 'SpotController@view')->name('spots.view');
// Route::get('/spots/{spot}/edit', 'SpotController@edit')->name('spots.edit');
// Route::patch('/spots/{spot}', 'SpotController@update')->name('spots.update');

Route::get('/spots/{spot}/requests/new', 'BookingRequestController@create')->name('requests.create');
Route::post('/spots/{spot}/requests', 'BookingRequestController@store')->name('requests.store');

// Route::get('/photos/new', 'PhotoController@create');
// Route::post('/photos', 'PhotoController@store');

Route::get('/static', function(){return view('static.index');});
Route::get('/static/form', function(){return view('static.form');});
Route::get('/static/done', function(){return view('static.done');});
Route::get('/static/about', function(){return view('static.about');});
Route::get('/static/tos', function(){return view('static.tos');});