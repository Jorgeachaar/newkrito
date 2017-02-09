<?php


Route::get('/', function () {
    return view('admin.welcome');
});

Route::resource('picCategories',  'Admin\PicCategoryController');