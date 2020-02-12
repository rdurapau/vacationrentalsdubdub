<?php

Auth::routes();
Route::get('/home', function(){ header('Location: '. str_replace('localhost', 'localhost:8000', env('APP_URL')) .'/#/spots/new'); die; });
Route::get('/_healthcheck', function(){ return 'healthy'; });
Route::get('/_authcheck', function(){ return \Auth::id(); })->middleware('auth');

Route::get('/', 'AppController@index')->name('index');
