<?php
// Route::get('/home', 'HomeController@index');

Route::get('/imagenes', 'ImageController@index');
Route::post('/imagenes', 'ImageController@store2')->name('image');

Route::name('index')->get('/', 'HomeController@index');

Route::name('contact')->post('/', 'HomeController@sendContact');

Route::name('pic.category')->get('/pics/{picCategory}-{slug}','PicController@show')->middleware('pic');

Route::name('videos.show')->get('/videos','VideoController@show');

Route::name('password.change')->get('changepassword', 'HomeController@changePassword')->middleware('auth');
Route::name('password.change')->post('changepassword', 'HomeController@resetPassword')->middleware('auth');

Route::name('renewplan')->get('renewplan', 'ReNewPlanController@index')->middleware('auth');
Route::name('renewplan')->post('renewplan', 'ReNewPlanController@store')->middleware('auth');

Auth::routes();

Route::name('posts.list')->get('blog', 'PostController@lists');
Route::name('posts.show')->get('blog/{post}-{slug}', 'PostController@show');

Route::name('shop.show')->get('shop', 'ShopController@show');
Route::name('shop.list')->get('shop/{category_id}', 'ShopController@list_category');
Route::name('shop.product.show')->get('shopp/product/{product}', 'ShopController@showProduct');

Route::name('cart.show')->get('cart', 'CartController@show');
Route::name('cart.add')->get('cart/add/{id}', 'CartController@add');
Route::name('cart.delete')->get('cart/delete/{id}', 'CartController@delete');
Route::name('cart.trash')->get('cart/trash', 'CartController@trash');
Route::name('cart.update')->post('cart/update/{id}', 'CartController@update');
Route::name('cart.detail')->get('cart/detail', 'CartController@detail');
Route::name('cart.order')->post('cart/order', 'CartController@order');

Route::name('payment.register')->get('payment/register', 'PayPalController@paymentRegister');
Route::name('payment.register.status')->get('payment/register/status', 'PayPalController@paymentRegisterStatus');
Route::name('payment')->get('payment', 'PayPalController@sendPayPal');
Route::name('payment.status')->get('payment/status', 'PayPalController@paymentStatus');