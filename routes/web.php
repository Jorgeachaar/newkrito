<?php

use App\Models\Setting;

Route::get('/', function () {

	$settings = Setting::getSetting();
    return view('index', compact('settings'));
    // return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
