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


Auth::routes();

//Route::get('/', 'HomeController@index');
Route::group(['middleware' => 'auth','prefix' => 'my'], function () {
    
  Route::get('profile','HomeController@getProfile');
  Route::get('orders','HomeController@getOrders'); 
  Route::get('wishlist','HomeController@getWishlist');
  Route::post('profile/update','HomeController@updateProfile');
    
});


Route::get('/','FronEndController@index')->name('index');

Route::get('return_policy','FronEndController@returnPolicy');
Route::get('terms_condition','FronEndController@termsCondition');
Route::get('security','FronEndController@security');
Route::get('privacy_policy','FronEndController@privacyPolicy');
Route::get('sitemap','FronEndController@sitemap');
Route::get('blog','FronEndController@blog');
Route::get('about_us','FronEndController@aboutUs');
Route::get('contact_us','FronEndController@contactUs');
Route::get('faq','FronEndController@faq');

Route::get('search','FronEndController@seachData');

Route::get('filter_data','FronEndController@getFilterPoduct');

Route::post('filter_data','FronEndController@getFilterData');

Route::get('shop/{getproduct}','FronEndController@getProductPage')
->where(['getproduct' => '[A-Za-z0-9_\-]+']);

Route::get('product/{category}/{name}','FronEndController@getProductDetails')
        ->where(['category' => '[A-Za-z0-9_\-]+','name' => '[A-Za-z0-9_\-]+']);

Route::post('add-to-cart',['as'=>'add-to-cart','uses'=>'CartController@addToCart']);
Route::get('/cart/page/details',['as'=>'cart','uses'=>'CartController@getCartView']);
Route::get('/cart/item/remove/{id}','CartController@removeCartItem')->where('id', '[0-9]+');
Route::get('addToCart/p/{id}','CartController@addTocart2')->where('id', '[0-9]+');
Route::post('/cart/quantity/update','CartController@updateCartView');

// Route::get('/{mainCategory}/{category}/callback', 'FronEndController@getProductPage')->where('mainCategory', 'twitter|facebook|linkedin|google|github|bitbucket');

Route::group(['prefix' => 'checkout'], function () {
  Route::get('init','CheckoutController@index');
  Route::get('payment-method','CheckoutController@getPaymentMethod');
  Route::post('update/billing-address','CheckoutController@updateBillingAddress');
  Route::get('place-order','CheckoutController@placeOrder');
  Route::get('order/success','CheckoutController@orderSuccess');
});




/*============== Start Admin Authentication Route List =========================*/

Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login')->name('admin.login.post');
Route::get('admin-logout', 'Admin\LoginController@logout');

/*============== Admin Password Reset Route list ===========================*/

Route::get('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin-password/reset', 'Admin\ResetPasswordController@reset');

/*============== Admin Dashboard and View  ===========================*/

Route::get('admin-dashboard',['as'=>'dashboard','uses'=>'AdminController@getDashboard']);

Route::group(['prefix' => 'admin'], function () {

  //------------------- Category ------------------------//

  Route::get('category', ['as'=>'category', 'uses'=>'AdminController@getCategory']);
  Route::get('category-create', ['as'=>'category-create', 'uses'=>'AdminController@createCategory']);
  Route::post('category-store', ['as'=>'category-store', 'uses'=>'AdminController@storeCategory']);
  Route::get('category/edit/{id}', ['as'=>'category-edit', 'uses'=>'AdminController@editCategory']);
  Route::post('category/update/{id}', ['as'=>'category-update', 'uses'=>'AdminController@updateCategory']);
  Route::get('category/view/{id}', ['as'=>'category-view', 'uses'=>'AdminController@viewCategory']);
  Route::get('category/delete/{id}', ['as'=>'category-delete', 'uses'=>'AdminController@destroyCategory']);

  //------------------- Product ------------------------//

  Route::get('product', ['as'=>'product', 'uses'=>'AdminController@getProduct']);
  Route::get('product-create', ['as'=>'product-create', 'uses'=>'AdminController@createProduct']);
  Route::post('product-store', ['as'=>'product-store', 'uses'=>'AdminController@storeProduct']);
  Route::get('product/edit/{id}', 'AdminController@editProduct');
  Route::post('product/update/{id}', ['as'=>'product-update', 'uses'=>'AdminController@updateProduct']);
  Route::get('product/show/{id}', 'AdminController@showProduct');
  Route::get('product/delete/{id}', 'AdminController@deleteProduct');
  Route::post('product-image/upload','AdminController@uploadImage');
  Route::post('product-image/delete','AdminController@deleteImage');
  
  Route::get('attribute', ['as'=>'attribute', 'uses'=>'AdminController@getAttribute']);
  
  Route::get('customers/', 'AdminController@getCustomers');
  
  Route::get('banner_settings/', 'AdminController@getCustomers');

 });





