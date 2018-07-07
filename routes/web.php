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
Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'Web\CategoriesController@index')->name('category');
    Route::post('/save', 'Web\CategoriesController@save')->name('category.save');
    Route::post('/list', 'Web\CategoriesController@list')->name('category.list');
    Route::delete('/delete', 'Web\CategoriesController@delete')->name('category.delete');
    Route::put('/update', 'Web\CategoriesController@update')->name('category.update');
});
Route::get('/product', 'Web\ProductController@index')->name('product');


