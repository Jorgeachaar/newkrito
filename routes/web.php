<?php

Route::name('index')->get('/', 'HomeController@index');

Route::name('contact')->post('/', 'HomeController@sendContact');

Route::name('pic.category')->get('/pics/{picCategory}-{slug}','PicController@show')->middleware('pic');;

Route::name('videos.show')->get('/videos','VideoController@show');

Route::name('password.change')->get('changepassword', 'HomeController@changePassword')->middleware('auth');
Route::name('password.change')->post('changepassword', 'HomeController@resetPassword')->middleware('auth');

Auth::routes();

// Route::get('/home', 'HomeController@index');
