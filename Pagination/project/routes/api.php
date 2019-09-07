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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('post', 'PostController@store')->name('store');

//student restfullApi
Route::post('/addstudents', 'ApiController@create');
Route::post('/allstudents', 'ApiController@allStudent');
Route::post('/showstudent/{id}', 'ApiController@show');
Route::post('/updatestudent/{id}', 'ApiController@updateStudent');
Route::post('/deletestudent/{id}', 'ApiController@destroyStudent');

//Route::resource('user', 'UserController');