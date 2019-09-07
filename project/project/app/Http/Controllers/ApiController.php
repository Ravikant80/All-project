<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;


use Illuminate\Support\Facades\Validator;
use App\Category;

use App\Product;

use Image;

use Cart;

class ApiController extends Controller
{
    
    
    public function register(Request $request) {
        
        $validator      =   Validator::make($request->all(), [
            
            
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'phone_number' => ['required','numeric'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'pincode' => ['required','string'],
            'gender' => ['required'],
         ]);
        
        if ($validator->fails()) {
            return response()->json(['success' =>0,"error"=>1,'message'=>$validator->errors()], 200);
        }

        $user = User::create([
                    'name'          =>  $request->name,
                    'email'         =>  $request->email,
                    'password'      =>  bcrypt($request->password)
        ]);

        
        
        $token = $user->createToken('TutsForWeb')->accessToken;

        return response()->json(['success'=>1,"error"=>0,'message'=>'Registered successfully!!','token' => $token], 200);
    }
    
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('TutsForWeb')->accessToken;
            
            User::where("id",auth()->user()->id)->update(
                            [
                                 "api_token" => $token,   
                            ]
                        )
                    
                    ;
            return response()->json(['success'=>1,"error"=>0,'message'=>'Logged in successfully!!','token' => $token,"user"=>auth()->user()], 200);
        } else {
            return response()->json(['success'=>0,"error"=>1,'message'=>'UnAuthorised'], 200);
        }
    }
    
    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
    
    public function products(){
        
        $data['product']= Product::all()->random(25);
        $data['tvaudio']= Product::where('product_category','LCD')->take(10)->get();
        $data['smartphone']= Product::where('product_category','mi')->take(10)->get();
        $data['shoes']= Product::where('product_category','men-shoe')->take(10)->get();
        $data['sunglass']= Product::where('product_category','Men-Sunglass')->take(10)->get();
        $data['watch']= Product::where('product_category','watch')->take(10)->get();
        $data['accessories']= Product::where('product_category','accessories')->take(10)->get();
        $data['featured']= Product::where('featured','featured')->take(10)->get();
        $data['special']= Product::where('special','special')->take(10)->get();
        $data['onsale']= Product::where('onsale','onsale')->take(10)->get();

        return response()->json(['success'=>1,'error'=>0,'product_data'=>$data,'image_url'=>asset('ecommerce/assets/admin/upload/catalog/images/')], 200);
        
    }


    
    public function addToCart(Request $request ){

    $validator = Validator::make($request->all(), [
         'quantity' => 'required',
         'id'       =>  'required',
         'name'     =>  'required',
         'price'    =>  'required',
     ]);
     if ($validator->fails()) {
         
         return response()->json(['success' =>0,"error"=>1,'message'=>$validator->errors()], 200);
    }

     $cart =   Cart::add([
        'id'=>$request->product_id,
        'name'=>$request->name,
        'price'=>$request->price,
        'quantity'=>$request->quantity,
      ]);

      if($cart){
          
          
          return response()->json(['success' =>1,"error"=>0,'message'=>'Item Added Successfully to Your Cart.'], 200);
        
      }else{
          
          return response()->json(['success' =>0,"error"=>1,'message'=>'Oops something went wrong please try again later!'], 200);
          
      }
   }



   
    
   public function searchData(Request $request){
        
        $validator = Validator::make($request->all(), [
            'query' => 'required',
        ]);
        
        if ($validator->fails()) {
            
            return response()->json(['success' =>0,"error"=>1,'message'=>$validator->errors()], 200);
            
        }
        
        $query = $request->input('query');
        
        $data['product'] = Product::where('name','like',"%$query%")
                               ->orWhere('product_category','like',"%$query%")
                               ->orWhere('short_description','like',"%$query%")
                               ->orWhere('description','like',"%$query%")
                               ->paginate(20);
            
        return response()->json(['success' =>1,"error"=>0,'data'=>$data,'image_url'=>asset('ecommerce/assets/admin/upload/catalog/images/')], 200);
        
    }

    public function getProductByCategory(Request $request){
        
        $validator = Validator::make($request->all(), [
            
            'product_category' => 'required',
            
        ]);
        
        
        if ($validator->fails()) {
            
            return response()->json(['success' =>0,"error"=>1,'message'=>$validator->errors()], 200);
            
        }
        
        
        $data = Product::where('product_category',$request->product_category)->take(10)->get();
        
        return response()->json(['success' =>1,"error"=>0,'data'=>$data,'image_url'=>asset('ecommerce/assets/admin/upload/catalog/images/')], 200);
        
    }
    
    public function getProductById(Request $request){
        
        $validator = Validator::make($request->all(), [
            
            'product_id' => 'required',
            
        ]);
        
        
        if ($validator->fails()) {
            
            return response()->json(['success' =>0,"error"=>1,'message'=>$validator->errors()], 200);
            
        }
        
        
        $data = Product::where('id',$request->product_id)->first();
        
        return response()->json(['success' =>1,"error"=>0,'data'=>$data,'image_url'=>asset('ecommerce/assets/admin/upload/catalog/images/')], 200);
        
    }
    
    public function getCategories(Request $request){
        
        
        
        $data = Category::get();
        
        return response()->json(['success' =>1,"error"=>0,'category'=>$data]);
        
    }
   
    

}
