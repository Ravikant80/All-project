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


Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');
Route::post('getproducts', 'ApiController@products');
Route::post('searchproducts', 'ApiController@searchData');
Route::post('productsbycat', 'ApiController@getProductByCategory');
Route::post('viewproduct', 'ApiController@getProductById');
Route::post('addtocart', 'ApiController@addToCart');
Route::post('categories', 'ApiController@getCategories');



Route::middleware('auth:api')->group(function () {
    
    Route::get('user', 'ApiController@details');
    
    Route::resource('products', 'ProductController');
    
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
