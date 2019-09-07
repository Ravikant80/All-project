<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Product;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\Session;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       session()->flash('message', 'You have successfully registered with ETW Shopping Mall!.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');

            $data['product']= Product::inRandomOrder()->get();
            
             return view('index',$data);
        
        
        
    }
    public function getProfile()
    {
        
        
        return view('users.profile');
        
        
    }
    public function getOrders()
    {
        
        return view('users.orders');
        
        
        
    }
    public function getWishlist()
    {
        
        return view('users.wishlist');
                
    }
    public function updateProfile(Request $request){
        print_r($request->all());
      //  die;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
          //  'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            
            'phone_number' => ['required','numeric'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'pincode' => ['required','string'],
             
        ]);
        $data['user']= User::where('id',Auth::id())
                ->update([
                    'name' => $request->name,
                  //  'email' =>$request->email,
                    'phone_number' =>$request->phone_number,
                    'address' =>$request->address,
                    'city' =>$request->city,
                    'state' =>$request->state,
                    'pincode' =>$request->pincode,
                    'gender' =>$request->gender,
                ]);
        session()->flash('message', 'Your Profile updated Successfully!.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
}
