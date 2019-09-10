<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitCoinRequest extends Model
{
    protected $table = 'bitcoin_request';
    
    protected $primaryKey = "btcreqid"; 
    protected $guarded = [''];
    public function btcmembers(){
      
        return $this->belongsTo(User::class,'user_id');
    }
}
