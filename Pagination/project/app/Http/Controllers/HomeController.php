<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Mail\Mailable;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function sendMail()
    {
       
        $name = 'Ravikant';
        Mail::to('ravikantgagan007@gmail.com')->send(new SendMailable($name));

       //  $name = 'Gagan';
       // Mail::to('ravikantgagan4@gmail.com')->send(new SendMailable($name));
       
    return 'Your email has been send';
    }

    public function email_view(){

        return view('email_view');
    }

     public function admin()
    {
        return view('admin');
    }

 


}
