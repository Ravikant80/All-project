<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
      'item_name',
      'item_code',
      'item_price',
      'item_qty',
      'item_tax',
      'item_status',
     
    ];
}
