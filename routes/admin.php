<?php

Route::get('/', function () {
    return view('admin.welcome');
});

Route::resource('picCategories',  'Admin\PicCategoryController');
Route::name('picCategories.images.show')->get('picCategories/{picCategory}/images', 'Admin\PicCategoryController@listImage');
Route::name('picCategories.images.store')->post('picCategories/images/create', 'Admin\PicCategoryController@storeImage');
Route::resource('picCategoryImages', 'Admin\PicCategoryImageController');

Route::name('setting.edit')->get('settings',  'Admin\SettingController@edit');
Route::name('setting.update')->put('settings',  'Admin\SettingController@update');

Route::resource('videos',  'Admin\VideoController');