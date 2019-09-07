<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    
    


    public function showLoginForm()
    {
        return view('admin.login');
    }

           protected function guard()
    {
        return Auth::guard('admin');
    }


     public function username()
    {
        return 'username';
    }
    public function logout()
    {
        $this->guard('admin')->logout();
        session()->flash('message', 'Just Logged Out!');
        return redirect('/admin');
    }



}


