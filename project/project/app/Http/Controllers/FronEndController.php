
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Category;
use App\Product;
use Image;
class FronEndController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['product']= Product::all()->random(10);
      $data['tvaudio']= Product::where('product_category','LCD')->take(10)->get();
      $data['smartphone']= Product::where('product_category','mi')->take(10)->get();
      $data['shoes']= Product::where('product_category','men-shoe')->take(10)->get();
      $data['sunglass']= Product::where('product_category','Men-Sunglass')->take(10)->get();
      $data['watch']= Product::where('product_category','watch')->take(10)->get();
      $data['accessories']= Product::where('product_category','accessories')->take(10)->get();
      $data['featured']= Product::where('featured','featured')->take(10)->get();
      $data['special']= Product::where('special','special')->take(10)->get();
      $data['onsale']= Product::where('onsale','onsale')->take(10)->get();
//  $data['topselling_products']= Product::where('onsale','onsale');
      
//      print_r($featured_product);
//      die;
      return view('index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductPage($getproduct)
    {
//      print $getproduct;
//      die;
    $updatedName = str_replace('-','',$getproduct);
      $data['product'] = Product::where('product_category','like',"%{$getproduct}%")
      ->paginate(20);

        $data['recentlyview']= Product::inRandomOrder()->get();
        $data['productbreakcrumbs']=$getproduct;
      return view('product-page',$data);

    }
    public function getProductDetails(Request $request, $category,$name){

      $updatedCategory = str_replace('-',' ',$category);
      $updatedName = str_replace('-',' ',$name);

      $data['product'] = Product::where('product_category','=',$updatedCategory)
                     ->orWhere('name','=',$updatedName)->first();

      return view('product-details',$data);
    }
/*
    public function getAddtoCat(Request $request){

      print_r($request->all());
      die;
      $data['product'] = Product::where('product_category','=',$updatedCategory)
                     ->orWhere('name','=',$updatedName)->first();

      return view('product-details',$data);
    }
*/
    public function seachData(Request $request){
        
        $request->validate([
               'query'=>'required|min:3',    
        ]);
        
        $query = $request->input('query');
        
        $data['product'] = Product::where('name','like',"%$query%")
                               ->orWhere('product_category','like',"%$query%")
                               ->orWhere('short_description','like',"%$query%")
                               ->orWhere('description','like',"%$query%")
                               ->paginate(20);
        return view('search-result',$data);
        
    }
    public function getFilterPoduct(Request $request){
        
        print_r($request->all());
        die;
        
    }

    public function getFilterData(Request $request){
        
    // $updatedName = str_replace('-','',$request->beadcrums);
        if(isset($request->color)){
           $data['product'] = Product::where('product_category','like',"%{$request->beadcrums}%")
                ->where('color', $request->color)->paginate(20);
        }
        elseif(isset($request->minimum_price,$request->maximum_price)&& !empty($request->minimum_price) && !empty($request->maximum_price)){
        $data['product'] = Product::where('product_category','like',"%{$request->beadcrums}%")
              
                ->whereBetween('price',[$request->minimum_price,$request->maximum_price])
                ->paginate(20);
        }
        
        elseif(isset($request->minimum_price,$request->maximum_price)&& isset($request->color)){
        $data['product'] = Product::where('product_category','like',"%{$request->beadcrums}%")
              
                ->whereBetween('price',[$request->minimum_price,$request->maximum_price])
                ->paginate(20);
        }
        
        
        //return response()->json($product);
       return view('fetchdata',$data);
                  
    }
    public function returnPolicy(){
        
        return view('return-policy');
    }
    public function termsCondition(){
        
        return view('return-policy');
    }
    public function security(){
        
        return view('return-policy');
    }
    public function privacyPolicy(){
        
        return view('return-policy');
    }
    
    public function sitemap(){
        
        return view('return-policy');
    }
    public function blog(){
        
        return view('return-policy');
    }
    public function aboutUs(){
        
        return view('return-policy');
    }
    public function contactUs(){
        
        return view('return-policy');
    }
    public function faq(){
        
        return view('return-policy');
    }

}
