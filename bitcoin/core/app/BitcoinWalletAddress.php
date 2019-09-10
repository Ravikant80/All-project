<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitcoinWalletAddress extends Model
{
    
    protected $table = 'bitcoin_wallet_addresses';
    
    protected $primaryKey = "bitcoin_id"; 

    public function createAddress($data,$id){
        $this->user_id = $id;
        $this->bitcoin_user_id = $data->user_id;
        $this->wallet_address = $data->address;
        $this->network = $data->network;
        $this->label = $data->label;
        $this->save();
    }
    
}
