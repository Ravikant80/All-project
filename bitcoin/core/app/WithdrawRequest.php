<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    protected $table = 'withdraw_request';

    protected $fillable = ['user_id','transaction_id','from_wallet','amount','charge','message','status','net_amount'];

    /*public function method()
    {
        return $this->belongsTo(WithdrawMethod::class,'method_id');
    }*/
	
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}