<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellBTCReq extends Model
{
    protected $table = 'sell_bitcoins';
    
    protected $primaryKey = "buybitcoinId"; 
    protected $guarded = [''];
    
    public function sellmembers(){
      
        return $this->belongsTo(User::class,'user_id');
    }
}
