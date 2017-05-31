<?php

Route::name('admin')->get('/', function () {
    return view('admin.welcome');
});

Route::resource('picCategories',  'Admin\PicCategoryController');
Route::name('picCategories.images.show')->get('picCategories/{picCategory}/images', 'Admin\PicCategoryController@listImage');
Route::name('picCategories.images.store')->post('picCategories/images/create', 'Admin\PicCategoryController@storeImage');
Route::resource('picCategoryImages', 'Admin\PicCategoryImageController');

Route::name('setting.edit')->get('settings',  'Admin\SettingController@edit');
Route::name('setting.update')->put('settings',  'Admin\SettingController@update');

Route::resource('videos',  'Admin\VideoController');

Route::resource('posts',  'Admin\PostController');
Route::name('posts.images.show')->get('posts/{post}/images', 'Admin\PostController@listImage');
Route::name('posts.images.store')->post('posts/images/create', 'Admin\PostController@storeImage');
Route::name('posts.images.update')->put('posts/images/{postImage}', 'Admin\PostController@updateImage');
Route::name('posts.images.destroy')->delete('posts/images/{postImage}', 'Admin\PostController@destroyImage');

Route::resource('productCategory', 'Admin\ProductCategoryController');
Route::resource('products', 'Admin\ProductController');
Route::name('product.images.add')->get('products/{product}/images', 'Admin\ProductController@AddImages');
Route::name('product.images.store')->post('products/{product}/images', 'Admin\ProductController@StoreImages');

Route::resource('orders', 'Admin\OrderController');

Route::name('notifications')->get('notifications', 'Admin\NotificationController@index');
Route::name('notifications.markReadAll')->get('notifications/mark_read_all', 'Admin\NotificationController@markReadAll');
Route::name('notifications.show')->get('notifications/{notification}', 'Admin\NotificationController@show');