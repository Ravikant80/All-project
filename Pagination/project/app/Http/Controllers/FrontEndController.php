<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class FrontEndController extends Controller
{
    public function storeContact(Request $request){

    	$contact=new Contact;
    	$contact->name=$request->name;
    	$contact->email=$request->email;
    	$contact->message=$request->message;
    	$contact->save();

    	return redirect('/')->with('message','sucessfully contactus!!!');

    }
}
