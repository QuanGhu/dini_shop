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

// Route::get('/', function () {
//     return view('master.index');
// });
Route::get('/', 'Web\DashboardController@index')->name('dashboard');
Route::get('/categories', 'Web\CategoriesController@index')->name('category');
Route::get('/product', 'Web\ProductController@index')->name('product');


