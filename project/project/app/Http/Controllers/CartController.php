<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Product;
class CartController extends Controller
{


  public function addToCart(Request $request ){

    $validator = Validator::make($request->all(), [
         'quantity' => 'required',
     ]);
     if ($validator->fails()) {
       return redirect()->back()
           ->with('errorNotificationText', 'Not Enough Qty Available. Please with less qty or Contact site Administrator!');
     }

     $cart =   Cart::add([
        'id'=>$request->product_id,
        'name'=>$request->name,
        'price'=>$request->price,
        'quantity'=>$request->quantity,
      ]);

      if($cart){
        session()->flash('message', 'Item Added Successfully to Your Cart.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        // return redirect ('cart');
         return redirect()->route('cart');

      }else{
        return redirect()->back()->with('notificationText', 'No Items!');
      }
   }
   public function addTocart2(Request $request ,$id){

    /* $validator = Validator::make($request->all(), [
          'quantity' => 'required',
      ]);
      if ($validator->fails()) {
        return redirect()->back()
            ->with('errorNotificationText', 'Not Enough Qty Available. Please with less qty or Contact site Administrator!');
      }
*/
    $product = Product::findOrFail($id);

      $cart =   Cart::add([
         'id'=>$product->id,
         'name'=>$product->name,
         'price'=>$product->price,
         'quantity'=>1,
       ]);

       if($cart){
         session()->flash('message', 'Item Added Successfully to Your Cart.');
         Session::flash('type', 'success');
         Session::flash('title', 'Success');
          //return redirect ('cart');
          return redirect()->route('cart');
       }else{
         return redirect()->back()->with('notificationText', 'No Items!');
       }
    }



    public function getCartView(){
         $cartdata = Cart::getContent();

         return view('cart-view',['cartdata'=>$cartdata])->with('message', ' Item  Added to  your Cart !');

    }
    public function updateCartView(Request $request){

      Cart::update($request->id, array(
        'quantity' => array(
      'relative' => false,
      'value' => $request->quantity
        )
    
      ));
    //session()->flash('success', 'Cart updated successfully');
     return;
     return Response::json(['success'=>true]);
    }
    public function removeCartItem($id){
        Cart::remove($id);
        session()->flash('message', 'Your cart Item removed successfully.');
        return redirect()->route('cart');
    }


}
