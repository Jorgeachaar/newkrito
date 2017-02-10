<?php

use App\Models\PicCategory;
use App\Models\Setting;

Route::get('/', function () {

	$mainCategories = PicCategory::getMainCategory();
	$settings = Setting::getSetting();

    return view('index', compact('settings', 'mainCategories'));
    // return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index');
