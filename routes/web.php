<?php

Route::name('index')->get('/', 'HomeController@index');
Route::name('contact')->post('/', 'HomeController@sendContact');

Route::name('pic.category')->get('/pics/{picCategory}-{slug}','PicController@show');

Auth::routes();

// Route::get('/home', 'HomeController@index');
