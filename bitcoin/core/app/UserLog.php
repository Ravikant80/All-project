<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class UserLog extends Model
{
    protected $table = 'user_logs';

    protected $fillable = ['user_id','amount','transaction_id','charge','amount_type','description','post_bal'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
    public function createEntry($data){
        
        $this->user_id = Auth::id();
        $this->transaction_id = $data["transactionId"];
        $this->amount = $data["amount"];
        $this->amount_type =$data["amount_type"];
        $this->charge =1;
        $this->description = $data["message"];
        $this->save();
    }

}
