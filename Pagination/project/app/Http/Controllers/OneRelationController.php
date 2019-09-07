<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Account;
use App\User;

class OneRelationController extends Controller
{
	public function view(){

	$account = User::find(1)->account;
	// echo "<pre>";
	// print_r($account);
	// die;
	// echo "<pre>";
	return view('view_account',compact('account'));
	}
    
}
