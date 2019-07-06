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

Route::get('/', 'CupCakeController@index')->name('index');
Route::get('addToCart/{id}','CupCakeController@addToCart')->name('addToCart');
Route::get('emptyCart', 'CupCakeController@emptyCart')->name('emptyCart');
Route::get('removeItem/{id}','CupCakeController@removeItem')->name('removeItem');
Route::get('category/{category}', 'CupCakeController@categories')->name('category');
Route::get('checkout','CupCakeController@checkout')->middleware('auth')->name('checkout');
//paystack
Route::post('/pay', 'CupCakeController@redirectToGateway')->name('pay');
Route::get('/payment/callback', 'CupCakeController@handleGatewayCallback');
Route::get('profile','CupCakeController@profile')->middleware('auth')->name('profile');
Route::get('orderDetails/{id}','CupCakeController@orderDetails')->middleware('auth')->name('orderDetails');
Route::resource('categories', 'CategoryController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('store', 'HomeController@store')->name('admin.store');
