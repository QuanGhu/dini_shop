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
Route::group(['middleware' => ['auth']], function(){
    Route::get('/', 'Web\DashboardController@index')->name('dashboard');
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'Web\CategoriesController@index')->name('category');
        Route::post('/save', 'Web\CategoriesController@save')->name('category.save');
        Route::post('/list', 'Web\CategoriesController@list')->name('category.list');
        Route::delete('/delete', 'Web\CategoriesController@delete')->name('category.delete');
        Route::put('/update', 'Web\CategoriesController@update')->name('category.update');
    });
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'Web\ProductController@index')->name('product');
        Route::post('/save', 'Web\ProductController@save')->name('product.save');
        Route::post('/list', 'Web\ProductController@list')->name('product.list');
        Route::delete('/delete', 'Web\ProductController@delete')->name('product.delete');
        Route::put('/update', 'Web\ProductController@update')->name('product.update');
        Route::put('/upload', 'Web\ProductController@uploadNewImage')->name('product.upload');
    });
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', 'Web\RoleController@index')->name('role');
        Route::post('/save', 'Web\RoleController@save')->name('role.save');
        Route::post('/list', 'Web\RoleController@list')->name('role.list');
        Route::delete('/delete', 'Web\RoleController@delete')->name('role.delete');
        Route::put('/update', 'Web\RoleController@update')->name('role.update');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'Web\UserController@index')->name('users');
        Route::post('/save', 'Web\UserController@save')->name('users.save');
        Route::post('/list', 'Web\UserController@list')->name('users.list');
        Route::delete('/delete', 'Web\UserController@delete')->name('users.delete');
        Route::put('/update', 'Web\UserController@update')->name('users.update');
    });
    Route::group(['prefix' => 'order'], function () {
        Route::get('/', 'Web\OrderController@index')->name('order');
        Route::post('/list', 'Web\OrderController@list')->name('order.list');
    });
});

// Route::
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('doLogin');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
