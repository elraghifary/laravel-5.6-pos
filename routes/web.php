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

Route::get('/', function() {
    return redirect(route('login'));
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    // Category Routes
    Route::resource('/category', 'CategoryController')->except('show');
    Route::get('/categories', 'CategoryController@getData')->name('category.getData');
    Route::post('/category/import', 'CategoryController@importExcel')->name('category.importExcel');

    // Product Routes
    Route::resource('/product', 'ProductController');
    Route::get('/products', 'ProductController@getData')->name('product.getData');

    // Dashboard Routes
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});