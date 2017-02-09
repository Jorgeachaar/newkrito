<?php


Route::get('/', function () {
    return view('admin.welcome');
});

Route::resource('picCategories',  'Admin\PicCategoryController');
Route::name('picCategories.images')->get('picCategories/{picCategory}/images', 'Admin\PicCategoryController@listImage');