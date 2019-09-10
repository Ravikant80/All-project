<?php

Route::get('dashboard',['as'=>'payment-dashboard','uses'=>'PaymentController@dashboard']);
Route::get('amount-step',['as'=>'payment-dashboard','uses'=>'PaymentController@amountStep']);

Route::post('deposit',['as'=>'payment-deposit','uses'=>'PaymentController@deposit']);

Route::post('withdraw',['as'=>'payment-withdraw','uses'=>'PaymentController@withdraw']);

Route::get('second-step',['as'=>'second-step','uses'=>'PaymentController@secondStep']);
