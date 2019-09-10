<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashoutRequest extends Model
{
    protected $table = 'cashout_request';

    protected $fillable = ['user_id','transaction_id','from_wallet','amount','from_wallet_address','message','status','receipient_name','to_wallet_address'];

    /*public function method()
    {
        return $this->belongsTo(WithdrawMethod::class,'method_id');
    }*/
	
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}