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
    Route::group(['middleware' => ['role:admin']], function () {
        // Category Routes
        Route::resource('/category', 'CategoryController')->except('show');
        Route::get('/categories', 'CategoryController@getData')->name('category.getData');
        Route::post('/category/import', 'CategoryController@importExcel')->name('category.importExcel');

        // Product Routes
        Route::resource('/product', 'ProductController');
        Route::get('/products', 'ProductController@getData')->name('product.getData');

        // Dashboard Routes
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Role Routes
        Route::resource('/role', 'RoleController')->except([
            'create', 'show', 'edit', 'update'
        ]);
        Route::get('/roles', 'RoleController@getData')->name('role.getData');

        // User Routes
        Route::resource('/user', 'UserController');
        Route::get('/user/roles/{id}', 'UserController@roles')->name('user.roles');
        Route::put('/user/roles/{id}', 'UserController@setRole')->name('user.set_role');
        Route::put('/user/permission/{role}', 'UserController@setRolePermission')->name('user.setRolePermission');
        Route::post('/user/permission', 'UserController@addPermission')->name('user.add_permission');
        Route::get('/user/role-permission', 'UserController@rolePermission')->name('user.roles_permission');
        Route::get('/users', 'UserController@getData')->name('user.getData');
    });
});