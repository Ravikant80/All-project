<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Order;
use DB;
class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order =$order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    	$data['product']=DB::table('order_products')
                      ->join('products','products.id','=','order_products.product_id')
                      ->join('orders','orders.id','=','order_products.order_id')
                       ->where('orders.id',$this->order->id)
                       ->select('products.*','order_products.*')
                       ->get();
        return $this->to($this->order->billing_email,$this->order->user_name)
                    ->cc('useretw@gmail.com')
                    ->subject('New Order From ETW Shopping Mall')
                    ->view('emails.order.placed',$data);
    }
}
