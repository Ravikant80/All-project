<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['user_id','user_name','billing_email','billing_address','billing_city','billing_state',
    'billing_pincode','billing_country','billing_phone','billing_discount','billing_discount_code','billing_subtotal',
    'billing_tax','billing_total'
     ];

   public function user()
   {
      return $this->belongsTo('App\User');
   }

  public function produts()
  {
    return $this->hasMany('App\Product');
  }

}
