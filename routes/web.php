<?php

Auth::routes();
Route::get('/_healthcheck', function(){ return 'healthy'; });

Route::get('/', 'AppController@index')->name('index');
