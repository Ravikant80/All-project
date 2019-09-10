<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;

use Validator;

use App\User;

use Illuminate\Support\Facades\Auth;

use App\UserLog;



define("mtn_api_email",env("MTN_EMAIL"));
define("mtn_api_password",env("MTN_PASS"));
define("WITHDRAW","http://api.webshinobis.com/api/v1/momo/pay");
define("DEPOSIT","http://api.webshinobis.com/api/v1/momo/checkout");


define("LITECOIN","6944-2a82-9927-8bef");
define("BITCOIN","594d-82a2-3946-73ae");
define("DOGECOIN","cfef-a537-8365-bbe4");

define("LITECOIN_TESTNET","85cf-cc6a-6d47-430d");
define("BITCOIN_TESTNET","461f-a494-3c80-a24b");
define("DOGECOIN_TESTNET","76c6-1b20-0c41-9bbb");


define("PIN","3QoccmsgjyYbjT3tGkJzEfPf");
define("VERSION",2);

use BlockIo;
use App\BitcoinWalletAddress;

class PaymentController extends Controller {
    
    private $bitcoin;
    
    public function __construct() {
        $this->bitcoin = new BlockIo(BITCOIN_TESTNET,PIN,VERSION);
    }
    
    public function createWallet($data){
        
        $bitcoinWallet = new BitcoinWalletAddress();
        
        $wallet = $this->bitcoin->get_new_address(['label'=>"wallet_".$data["id"]]);
        
        $responseArr = $wallet;
        
        $create = User::where("id",$data["id"])
                 ->update(["wallet_address"=>$responseArr->data->address]);
        
        $bitcoinWallet->createAddress($responseArr->data,$data["id"]);
        
    }
    
public function getBitcoinBalance(){
   
    $address  = Auth::user()->wallet_address;    
    
    $address  =  $this->bitcoin->get_address_balance(["address"=>$address]);
    
    $balance  =  $address->data->available_balance;
    
    
    User::where("id",Auth::id())->update([
        'bitcoin' => $balance,
    ]);
    
}
    
    
    public function sendBitocoin($sender,$receiver,$amount){
        
        $query = [
            'amounts'       =>  $amount,
            'from_address'  =>  $sender,
            'to_addresses'  =>  $receiver,
            'pin'           =>  PIN
        ];
        
       return $this->bitcoin->withdraw($query);  
    }
    
    public function byBitcoin(){
        
    }

    public function dashboard(){
        
        $data['page_title'] = "Payment Method ";
        $data['log'] = [];
        
        return view("payment.first_step",$data);
                    
    }

    public function amountStep(){
        
        $data['page_title'] = "Payment Method ";
        $data['log'] = [];
        
        return view("payment.amount-step",$data);
                    
    }
    
    public function deposit(Request $request) {
       
       
        
        
        $validator = Validator::make($request->all(), [
            'phone'  => 'required|min:7',
            'amount' => 'required',
        ]);

        /*return Response::json([
                        "email" => mtn_api_email,
                        "password" =>mtn_api_password,
                        "phone" =>$request->phone,
                        "amount" =>$request->amount,
            ],500);*/
       
        if ($validator->fails()) {
           return  Response::json(["success"=>false,"error"=>$validator->errors()]);
        }
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => DEPOSIT,
            CURLOPT_USERAGENT => '',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                "email" => mtn_api_email,
                "password" =>mtn_api_password,
                "phone" =>$request->phone,
                "amount" =>$request->amount,
            )
        ));
        // Send the request & save response to $resp
        $resp = json_decode(curl_exec($curl),true);
        // Close request to clear up some resources
        curl_close($curl);
        /*$resp = [
             "status" =>"success",
             "message" =>"description of status", 
             "amount" =>  $request->amount,
             "phoneNumber" =>"Client's Phone Number", 
             "transactionId" =>"Id of the transaction that just occured", 
             "transactionDate"=>"date and time of the transaction"
        ];*/
        
        $resp["redirect"] = url("user/dashboard");
        $resp["amount_type"] = 1;
        
        return $this->saveAndSend($resp);
    }
    
    
   public function saveAndSend($resp){
       if($resp["status"] == "success"){
           if($resp["amount_type"] == 1){
               User::where("id",Auth::id())
                  ->increment('balance',$resp["amount"]);
           }else{
               User::where("id",Auth::id())
                  ->decrement('balance',$resp["amount"]);
           }
           $log = new UserLog();
           $log->createEntry($resp);
       }
    return Response::json($resp);
   }
    
    
    public function withdraw(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'phone'  => 'required|min:7',
            'amount' => 'required',
            'withdraw_commission1'=>'required',
            //'withdraw_commission'=>'required',
        ]);

        
        
        $validator->after(function () use ($request,$validator) {
            
            if ( ((intval($request->amount) - intval($request->withdraw_commission1)) <=0) || (Auth::user()->balance < $request->amount) ) {
                
                $msg = "Invalid Amount!!" ;
                
                $validator->errors()->add('amount', $msg);
                
            }
            
        });
        
        
        if ($validator->fails()) {
           return  Response::json(["success"=>false,"error"=>$validator->errors()]);
        }
        
        
        
        $amount = (intval($request->amount)-intval($request->withdraw_commission1));  
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => WITHDRAW,
            CURLOPT_USERAGENT => '',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                "email" => mtn_api_email,
                "password" =>mtn_api_password,
                "phone" =>$request->phone,
                "amount" =>$amount,
            )
        ));
        // Send the request & save response to $resp
        $resp = json_decode(curl_exec($curl),true);
        // Close request to clear up some resources
        curl_close($curl);
        /*$resp = [
             "status" =>"success",
             "message" =>"description of status", 
             "amount" =>  $request->amount,
             "phoneNumber" =>"Client's Phone Number", 
             "transactionId" =>"Id of the transaction that just occured", 
             "transactionDate"=>"date and time of the transaction"
        ];*/
        
        $resp["redirect"] = url("user/withdraw-request");
        $resp["amount_type"] = 5;
        return $this->saveAndSend($resp);
    }
    
    
    public function secondStep(Request $request ){
        
        $validator = Validator::make($request->all(), [
            'phone'  => 'required|min:7',
        ]);
        
        if($validator->fails()){
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }
        $data['page_title'] = "Complete Payment ";
        $data['phone']      = $request->phone;
        return view("payment.second_step",$data);
    }
    
}  