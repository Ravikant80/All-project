<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $table = 'exchange';

    protected $fillable = ['user_id','from_amount','to_amount','from_wallet','to_wallet','status'];

    public function member()
    {
        return $this->belongsTo(User::class,'user_id');
    }
	
    /*public function bank()
    {
        return $this->belongsTo(PaymentMethod::class,'payment_type');
    }*/


}
