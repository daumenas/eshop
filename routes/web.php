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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ProductController@index');

Route::get('/order', 'OrderController@index')->name('order');

Route::get('/checkout', 'OrderController@checkout')->name('order');

Route::get('/payment', 'OrderController@payment')->name('payment');