<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Order;
use App\OrderProduct;
use Auth;
use Mail;
use App\Mail\OrderPlaced;
use App\User;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            
            return redirect('checkout/payment-method');
            
        }
        else{
          return view('checkout.index');  
        }
      
    }
    public function getPaymentMethod()
    {
        if (Auth::check()) {
      
            return view('checkout.payment-method');
            
        }
        else{
          return redirect('checkout/init');  
        }
      
    }
    public function guest()
    {
      return view('checkout.guest');
    }
   
    public function updateBillingAddress(Request $request){
        
    $data['update_billingAddress']= User::where('id',Auth::id())
                ->update([
                           'name'=>$request->name,
                           'phone_number'=>$request->phone_number,
                           'address'=>$request->address,
                           'city'=>$request->city,
                           'state'=>$request->state,
                           'pincode'=>$request->pincode
                    ]);
    return redirect()->back();    
    }
    public function placeOrder(Request $request){
       if(Auth::check()){
       
         $order = Order::create([
          'user_id'=>Auth::id(),
          'user_name'=>Auth::user()->name,
          'billing_email'=>Auth::user()->email,
          'billing_address'=>Auth::user()->address,
          'billing_city'=>Auth::user()->city,
          'billing_state'=>Auth::user()->state,
          'billing_pincode'=>Auth::user()->pincode,
          'billing_country'=>'INDIA',
          'billing_phone'=>Auth::user()->phone_number,
          'billing_discount'=>0,
          'billing_discount_code'=>0,
          'billing_subtotal'=>Cart::getSubTotal(),
          'billing_tax'=>0,
          'billing_total'=>Cart::getTotal()

        ]);
         $orderId =$order->id;

         foreach (Cart::getContent() as $item) {
          OrderProduct::create([
            'order_id'=>$orderId,
            'product_id'=>$item->id,
            'quantity'=>$item->quantity,
          ]);

        }
        Mail::send(new OrderPlaced($order));
         return redirect('/checkout/order/success')->with( ['orderdata' => $order] );
       }else{
         return redirect()->route('cart');
       }
    }

    public function orderSuccess(){
     if(Session::has('orderdata')){
         $data['order'] =Session::get('orderdata');
         Cart::clear();
         return view('checkout/success',$data);
       }else{
         return redirect()->route('cart');
       }
    }

}
