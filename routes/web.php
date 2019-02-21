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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/map', 'HomeController@map')->name('map');

Route::get('/spots/new', 'SpotController@create')->name('spots.create');
Route::post('/spots', 'SpotController@store')->name('spots.store');
Route::get('/spots/{spot}', 'SpotController@view')->name('spots.view');
Route::get('/spots/{spot}/edit', 'SpotController@edit')->name('spots.edit');
Route::patch('/spots/{spot}', 'SpotController@update')->name('spots.update');

Route::get('/photos/new', 'PhotoController@create');
Route::post('/photos', 'PhotoController@store');