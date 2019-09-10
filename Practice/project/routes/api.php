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

//User area
Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');
Route::get('users', 'ApiController@userList');
Route::post('user-update/{id}', 'ApiController@updateUser');
Route::get('user-delete/{id}', 'ApiController@destroyUser');

// Patient area
Route::post('register-patient', 'ApiController@registerPatient');
Route::post('loginp', 'ApiController@loginPantient');

