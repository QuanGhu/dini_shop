<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'Auth\LoginController@loginForMobile');
Route::post('/register', 'Auth\RegisterController@registerNewUser');


Route::group(['middleware' => ['auth:api']], function(){
    Route::get('/auth' , 'API\TestController@withAuth');
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/list/{id}','API\ProductController@getProductByCategory');
    Route::get('/detail/{id}','API\ProductController@getProductDetail');
    Route::group(['middleware' => ['auth:api']], function(){
        Route::post('/addtocart','API\ProductController@addProductToCart');
    });
});

Route::group(['middleware' => ['auth:api']], function(){
    Route::group(['prefix' => 'cart'], function () {
        Route::get('/list','API\CartController@getAllData');    
        Route::delete('/remove','API\CartController@removeItemFromCart');    
    });
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/','API\UserController@getMyProfileData');      
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('/create','API\OrderController@createOrder');      
    });
});

Route::get('/categories','API\CategoriesController@getAll');
