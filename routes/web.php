<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/store', 'Store@index');
Route::get('/store/{cat}', 'Store@index');
//Route::post('/addtoCart', 'Store@addtoCart');
Route::get('/addtoCart/{id}', 'Store@addtoCart');
Route::get('/user_area', 'Store@user_area');
Route::get('/cart_items', 'Store@showCart');
Route::post('/update_username', 'Store@update_username');
Route::post('/delete_account', 'Store@delete_account');
Route::get('/cancel_order', 'Store@cancel_order');
Route::post('/order_items', 'Store@order_items');
Route::get('/orders', 'Store@orders');
Route::get('foo', function(){
	return 'test';
});

Route::get('test', 'TestController@index');
Route::get('/register', 'Store@register');
Route::post('/register_action', 'Store@register_action');

Route::get('/login', 'Store@login');
Route::post('/login_action', 'Store@login_action');
Route::get('/logout', 'Store@logout');
Route::get('/newPost', 'Store@newPost');
Route::post('/addPost', 'Store@insertPost');
Route::get('/updatePost/{id}', 'Store@updatePost');
Route::post('/update_action', 'Store@update_action');