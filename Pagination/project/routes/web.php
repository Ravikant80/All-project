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
	// Auth::routes();


	// Route::resource('articles','ArticleController');

	// Auth::routes();

	//Email route
	// Auth::routes(['verify' => true]);

	//only varifie user 
	// Route::get('profile', function () {
	   
	// })->middleware('verified');

	// Route::get('/email_view', 'HomeController@email_view');
	// Route::post('/send/email', 'HomeController@sendMail');
	// Route::get('/home', 'HomeController@index')->name('home');


//*********************************Admin Authontication ****************************************
	Route::get('/paginatedata','PaginationController@getData');
	Route::get('events', 'EventController@index');
	//DataBaseNotification
	Route::get('post', 'PostController@create')->name('create');
	Route::post('post', 'PostController@store')->name('store');
	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/view', 'OneRelationController@view');

	Route::get('product/create', 'ManyRelationshipController@create')->name('product.create');
	Route::get('product/{product}', 'ManyRelationshipController@show')->name('product.show');

	Route::get('time', 'TimeController@create')->name('create');
	Route::post('time', 'TimeController@store')->name('store');
	
	Route::get('/home', 'HomeController@index')->name('home'); 
	//middleware Route
	// Route::get('admin/routes', 'HomeController@admin')->middleware('admin');
	
	// Route::get('admin/routes', 'HomeController@admin')->middleware(['admin','auth']);

	// Route::group(['middleware' => ['admin']], function () {
 //    Route::get('admin/routes', 'HomeController@admin');
	// });
		
	// Route::get('photo', 'PhotoController@uploadImage');
	// Route::post('photo', 'PhotoController@index')->name('photo');
	// // Route::get('deleteimg/{id}', 'PhotoController@deleteImg');

	// Route::get('members', 'MemberController@index');
	// Route::delete('member/{id}', ['as'=>'members.destroy','uses'=>'MemberController@destroy']);






	// Route::get('post', 'PostController@create')->name('create');

	//Ajax controller//
	Route::get('/live_search', 'LiveSearchController@index');
	Route::get('/live_search/action', 'LiveSearchController@action')->name('live_search.action');
	Route::get('/algolia','SearchController@search');

// 	Route::get('/test','FirebaseController@index');
// //
	Route::get('autocomplete', 'AjaxAutocompleteController@index');
	Route::get('searchajax', ['as'=>'searchajax','uses'=>'AjaxAutocompleteController@searchResponse']);

	//File uploading
	//Route::get('resizeImage', 'ImageController@resizeImage');
	//Route::post('resizeImagePost', 'ImageController@resizeImagePost')->name('resizeImagePost');

	Route::get('ajaxRequest', 'AjaxController@ajaxRequest');
	Route::post('ajaxRequest', 'AjaxController@ajaxRequestPost');

	//import and export
	Route::get('export', 'MyController@export')->name('export');
	Route::get('importExportView', 'MyController@importExportView');
	Route::post('import', 'MyController@import')->name('import');
	Route::get('image', 'ImageController@index');
	Route::post('save', 'ImageController@save');


	Route::get('formvalid', 'FormController@formValid');
	Route::post('formvalid', 'FormController@formvaliStore');

	Route::get('/notify', 'PusherController@sendNotification');
	Route::view('/home', 'home');
	Route::resource('ajax-crud', 'AjaxCrudController');
	
	Route::post('contact-post', 'FrontEndController@storeContact');