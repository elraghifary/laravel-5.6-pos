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

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/chart', 'DashboardController@getDataChart')->name('dashboard.chart.getData');

Route::resource('/category', 'CategoryController')->except('show');
Route::get('/categories', 'CategoryController@getData')->name('category.getData');
Route::resource('/product', 'ProductController');
Route::get('/products', 'ProductController@getData')->name('product.getData');
