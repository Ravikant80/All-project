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
//     return view('welcome');
// });


Route::view('/','nature.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Admin Area
Route::get('admin-dashboard','Admin\AdminController@index');
Route::get('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin','Admin\LoginController@login')->name('admin.login.post');
Route::get('admin/logout', 'Admin\LoginController@logout');
Route::get('admin/register','Admin\RegisterController@registerForm')->name('admin.register');
Route::post('admin/register','Admin\RegisterController@create');
Route::get('users', 'UserController@index');
Route::get('changeStatus', 'UserController@changeStatus');

Route::match(['get', 'post'], 'ajax-image-upload', 'ImageController@ajaxImage');
Route::delete('ajax-remove-image/{filename}', 'ImageController@deleteImage');
//Route::get('hello', ['as' =>'Hello' ,'uses'=>'ImageController@hello']);

Route::get('validation','ValidationController@validation');
Route::post('validation','ValidationController@validationPost');