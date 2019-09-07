<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Time;

class TimeController extends Controller
{
	public function create()
	{
    	return view('time');
	}


	public function store(Request $request)
{
     $time= new Time;
     $time->title = $request->get('title');
     $time->body = $request->get('body');

     $time->save();

     return response($time);
}
    
}
