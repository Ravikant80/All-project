<?php

namespace App\Http\Controllers;

use App\BasicSetting;
use App\Compound;
use App\CashoutRequest;
use App\Exchange;
use App\Deposit;
use App\DepositImage;
use App\Investment;
use App\PaymentLog;
use App\PaymentMethod;
use App\Lib\GoogleAuthenticator;
use App\Plan;
use App\Countries;
use App\Industries;
use App\IdentityProof;
use App\Repeat;
use App\RepeatLog;
use App\Support;
use App\SupportMessage;
use App\TraitsFolder\MailTrait;
use App\User;
use App\UserLog;
use App\UserIdentityProof;
use App\WithdrawLog;
use App\WithdrawMethod;
use App\WithdrawRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    use MailTrait;
    public function __construct()
    {
        $this->middleware('verifyUser');
        $this->middleware(['auth', 'ckstatus']);

    }
    public function getDashboard()
    {

        $bitcoinC = new \App\Http\Controllers\PaymentController();
        
        $bitcoinC->getBitcoinBalance();
        
        $data['page_title'] = 'User Dashboard';

        $data['reference_title'] = "Reference User";
        $data['basic_setting'] = BasicSetting::first();
        $data['reference_user'] = User::whereUnder_reference(Auth::user()->id)->orderBy('id','desc')->get();

        $data['user'] = User::findOrFail(Auth::user()->id);
        $data['balance'] = $data['user'];
        $data['deposit'] = Deposit::whereUser_id(Auth::user()->id)->whereStatus(1)->sum('amount');
        $data['repeat'] = RepeatLog::whereUser_id(Auth::user()->id)->sum('amount');
        $data['withdraw'] = WithdrawLog::whereUser_id(Auth::user()->id)->whereIn('status',[2])->sum('amount');
        $data['refer'] = User::where('under_reference',Auth::user()->id)->count();
        $data['log'] = UserLog::limit(5)->whereUser_id(Auth::user()->id)->orderBy('id','desc')->paginate(15);
        return view('user.dashboard',$data);
    }

    public function getReferedUsers()
    {

      $data['page_title'] = 'Reference User';

      $data['basic_setting'] = BasicSetting::first();
      $data['user'] = User::findOrFail(Auth::user()->id);
      $data['balance'] = $data['user'];
      $data['reference_user'] = User::whereUnder_reference(Auth::user()->id)->orderBy('id','desc')->get();
      $data['refer'] = User::where('under_reference',Auth::user()->id)->count();
      $data['amountsum'] = UserLog::where('user_id',Auth::user()->id)
      ->where('amount_type',3)->sum('amount');
      return view('user.reference-user',$data);
  }

  public function changePassword()
  {
    $data['page_title'] = "Change Password";
    return view('user.change-password', $data);
}

public function submitPassword(Request $request)
{
        /*$this->validate($request, [
            'current_password' =>'required',
            'password' => 'required|min:5|confirmed'
        ]);*/

        try {
            $c_password = Auth::user()->password;
            $c_id = Auth::user()->id;
            $user = User::findOrFail($c_id);
            if(Hash::check($request->current_password, $c_password) && ($request->password == $request->password_confirmation)){

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                session()->flash('message', 'Password Changes Successfully.');
                session()->flash('title','Success');
                Session::flash('type', 'success');
                return redirect()->back();
            }else{
                session()->flash('alert', 'Current / New Password are Not Match');
                Session::flash('type', 'warning');
                session()->flash('title','Opps');
                return redirect()->back();
            }

        } catch (\PDOException $e) {
            session()->flash('alert', $e->getMessage());
            Session::flash('type', 'warning');
            session()->flash('title','Opps');
            return redirect()->back();
        }
    }

    public function editProfile()
    {
        $data['page_title'] = "Edit Profile";
        $data['user'] = User::findOrFail(Auth::user()->id);
        return view('user.edit-profile', $data);
    }

    public function userLimits()
    {
        $data['page_title'] = "Trust and Verification";
        $data['user'] = User::findOrFail(Auth::user()->id);
        return view('user.limits', $data);
    }

    public function wallet()
    {
        $data['page_title'] = "Wallet";
        $data['user'] = User::findOrFail(Auth::user()->id);
        $data['refer'] = User::where('under_reference',Auth::user()->id)->count();
        $data['amountsum'] = UserLog::where('user_id',Auth::user()->id)
        ->where('amount_type',3)->sum('amount');
        $data['log'] = UserLog::limit(5)->whereUser_id(Auth::user()->id)->orderBy('id','desc')->paginate(15);
        $data['cfavalues']= \App\UsdToCfas::orderBy('updated_at','DESC')->first();
        $data['basic'] = BasicSetting::first();
        if ($data['basic']->withdraw_status == 0){
            session()->flash('message','Currently Withdraw Is Deactivated.');
            session()->flash('type','warning');
            session()->flash('title','Warning');
        }
        return view('user.wallet', $data);
    }

    public function exchange()
    {
	/*	if(Auth::user()->phone_verify_status != 1 || Auth::user()->email_verify_status != 1 || Auth::user()->identity_verify_status != 1 || Auth::user()->selfie_verify_status != 1)
		{
			return redirect()->route('user/wallet');
		}
		*/
        $data['page_title'] = "Convert";
        $data['user'] = User::findOrFail(Auth::user()->id);
        return view('user.exchange', $data);
    }

    public function submitProfile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'required|string|min:10|unique:users,phone,'.$user->id,
            'username' => 'required|min:5|unique:users,username,'.$user->id,
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $in = Input::except('_method','_token');
        $in['reference'] = $request->username;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = $request->username.'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            $in['image'] = $filename;
            if ($user->image != 'user-default.png'){
                $path = './assets/images/';
                $link = $path.$user->image;
                if (file_exists($link)) {
                    unlink($link);
                }
            }
            Image::make($image)->resize(400,400)->save($location);
        }
        $user->fill($in)->save();
        session()->flash('message', 'Profile Updated Successfully.');
        session()->flash('title','Success');
        Session::flash('type', 'success');
        return redirect()->back();
    }

    public function depositMethod()
    {
        $data['page_title'] = 'Deposit Method';
        $data['paypal'] = PaymentMethod::whereId(1)->first();
        $data['perfect'] = PaymentMethod::whereId(2)->first();
        $data['btc'] = PaymentMethod::whereId(3)->first();
        $data['stripe'] = PaymentMethod::whereId(4)->first();
//        $count = PaymentMethod::count();
//        $skip = 4;
//        $limit = $count - $skip;
//        $data['bank'] = PaymentMethod::orderBy('id','asc')->skip($skip)->take($limit)->whereStatus(1)->get();
        $data['bank'] = PaymentMethod::orderBy('id','asc')->where('id', '>', 4)->whereStatus(1)->get();
        return view('user.deposit-fund',$data);
    }

    public function submitDepositFund(Request $request)
    {
      if(Auth::user()->phone_verify_status != 1 || Auth::user()->email_verify_status != 1 || Auth::user()->identity_verify_status != 1 || Auth::user()->selfie_verify_status != 1)
      {
         return redirect()->route('user-dashboard');
     }
		//print_r($request); exit;
     $basic = BasicSetting::first();
        /*$request->validate([
            'amount' => 'required',
            'payment_type' => 'required',
        ]);*/
        $pay_id = $request->payment_type;
        $amou = $request->amount;
        $charge = $request->charge;
        /*if ($pay_id == 1) {
            $paypal = PaymentMethod::whereId(1)->first();
            $charge = ($paypal->fix + ( $amou*$paypal->percent / 100 ));
        }elseif ($pay_id == 2) {
            $paypal = PaymentMethod::whereId(2)->first();
            $charge = ($paypal->fix + ( $amou*$paypal->percent / 100 ));
        }elseif ($pay_id == 3) {
            $paypal = PaymentMethod::whereId(3)->first();
            $charge = ($paypal->fix + ( $amou*$paypal->percent / 100 ));
        }elseif ($pay_id == 4) {
            $paypal = PaymentMethod::whereId(4)->first();
            $charge = ($paypal->fix + ( $amou*$paypal->percent / 100 ));
        }else{
            $paypal = PaymentMethod::whereId($pay_id)->first();
            $charge = $paypal->fix + ( $amou*$paypal->percent / 100 );
        }*/
        $tr = strtoupper(Str::random(20));
        $lo['user_id'] = Auth::user()->id;
        $lo['transaction_id'] = strtoupper(Str::random(20));
        $lo['amount'] = $amou;
        $lo['rate']		= $request->payment_fee;
        $lo['charge'] = round($charge,$basic->deci);
        $lo['net_amount'] = $amou + $charge + $request->payment_fee;
       // $lo['usd'] = round(($amou + $charge) + $request->payment_fee,2);
        $lo['message'] = "";
        $lo['payment_type'] = $request->payment_method;
        $data = Deposit::create($lo);

        $bal4 = User::findOrFail(Auth::user()->id);
        $ul['user_id'] = $bal4->id;
        $ul['amount'] = $amou;
        $ul['charge'] = $charge;
        $ul['amount_type'] = 1;
        $ul['post_bal'] = $bal4->balance + $amou;
        $ul['description'] = $amou." ".$basic->currency." Deposit Request Send.";
        $ul['transaction_id'] = $tr;
        UserLog::create($ul);

        $bal4 = User::findOrFail(Auth::user()->id);
        $ul['user_id'] = $bal4->id;
        $ul['amount'] = $charge;
        $ul['charge'] = null;
        $ul['amount_type'] = 10;
        $ul['post_bal'] = $bal4->balance + ($amou + $charge);
        $ul['description'] = $charge." ".$basic->currency." Charged for Deposit Request.";
        $ul['transaction_id'] = $tr;
        UserLog::create($ul);

        if($amou != 0 && !empty($amou))
        {
         $usd_wallet	= Auth::user()->balance;
         $user = User::findOrFail(Auth::user()->id);
         $in = Input::except('_method','_token','amount','payment_fee','card_month','card_no','charge','card_year','cvc','final','payment_method','rate');
         $in['balance'] = $amou + $usd_wallet;
         $user->fill($in)->save();

         session()->flash('message', 'Deposit Successfully Submitted. Wait For Confirmation.');
         Session::flash('type', 'success');
         Session::flash('title', 'Completed');
         return redirect()->route('user-dashboard');
     }
     else
     {
         session()->flash('alert','Deposit amount should greater than zero.');
         session()->flash('type','alert');
         session()->flash('title','Warning');
         return redirect()->back();
     }

 }

 public function depositPreview($id)
 {
    $data['fund'] = PaymentLog::whereCustom($id)->first();
    $data['page_title'] = "Deposit Preview";
    $data['paypal'] = PaymentMethod::whereId(1)->first();
    $data['perfect'] = PaymentMethod::whereId(2)->first();
    $data['btc'] = PaymentMethod::whereId(3)->first();
    $data['stripe'] = PaymentMethod::whereId(4)->first();
//        $count = PaymentMethod::count();
//        $skip = 4;
//        $limit = $count - $skip;
//        $data['bank'] = PaymentMethod::orderBy('id','asc')->skip($skip)->take($limit)->whereStatus(1)->get();
    $data['bank'] = PaymentMethod::orderBy('id','asc')->where('id', '>', '4')->whereStatus(1)->get();
    return view('user.deposit-preview',$data);
}

public function manualDepositSubmit(Request $request)
{
    $request->validate([
        'image' => 'required',
        'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        'fund_id' => 'required'
    ]);

    $fund = PaymentLog::findOrFail($request->fund_id);

    $de['user_id'] = Auth::user()->id;
    $de['amount'] = $fund->amount;
    $de['charge'] = $fund->charge;
    $de['net_amount'] = $fund->net_amount;
    $de['payment_type'] = $fund->payment_type;
    $de['message'] = $request->message;
    $de['transaction_id'] = $fund->custom;
    $dep = Deposit::create($de);

    if($request->hasFile('image')){
        $image3 = $request->file('image');
        foreach ($image3 as $img){
            $filename3 = time().'h3'.'.'.$img->getClientOriginalExtension();
            $location = 'assets/deposit/' . $filename3;
            Image::make($img)->save($location);
            $in['image'] = $filename3;
            $in['deposit_id'] = $dep->id;
            DepositImage::create($in);
        }
    }
    session()->flash('message', 'Deposit Successfully Submitted. Wait For Confirmation.');
    Session::flash('type', 'success');
    Session::flash('title', 'Completed');
    return redirect()->route('deposit-fund');

}

public function historyDepositFund()
{
    $data['page_title'] = "Deposit History";
    $data['deposit'] = Deposit::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
    return view('user.deposit-history',$data);
}

public function userActivity()
{
    $data['page_title'] = "Transaction Log";
    $data['log'] = UserLog::whereUser_id(Auth::user()->id)->orderBy('id','desc')->paginate(15);
    return view('user.user-activity',$data);
}

public function withdrawRequest()
{

    $data['page_title'] = "Withdraw Request";
    $data['paypal'] = PaymentMethod::whereId(1)->first();
    $data['perfect'] = PaymentMethod::whereId(2)->first();
    $data['btc'] = PaymentMethod::whereId(3)->first();
    $data['stripe'] = PaymentMethod::whereId(4)->first();
    $data['bank'] = PaymentMethod::orderBy('id','asc')->where('id', '>', 4)->whereStatus(1)->get();
    $data['basic'] = BasicSetting::first();
    if ($data['basic']->withdraw_status == 0){
        session()->flash('message','Currently Withdraw Is Deactivated.');
        session()->flash('type','warning');
        session()->flash('title','Warning');
    }
    $data['method'] = WithdrawMethod::whereStatus(1)->get();
    return view('user.withdraw-request',$data);
}
   
   public function withdrawPayment()
{

    $data['page_title'] = "Withdraw Payment";
    $data['paypal'] = PaymentMethod::whereId(1)->first();
    $data['perfect'] = PaymentMethod::whereId(2)->first();
    $data['btc'] = PaymentMethod::whereId(3)->first();
    $data['stripe'] = PaymentMethod::whereId(4)->first();
    $data['bank'] = PaymentMethod::orderBy('id','asc')->where('id', '>', 4)->whereStatus(1)->get();
    $data['basic'] = BasicSetting::first();
    if ($data['basic']->withdraw_status == 0){
        session()->flash('message','Currently Withdraw Is Deactivated.');
        session()->flash('type','warning');
        session()->flash('title','Warning');
    }
    $data['method'] = WithdrawMethod::whereStatus(1)->get();
    return view('user.withdraw-payment',$data);
}

	/*public function submitWithdrawRequest(Request $request)
    {
        $this->validate($request,[
            'withdraw_amount' 	=> 'required',
			'from_wallet'		=> 'required'
        ]);
		
        $basic 	= BasicSetting::first();
        $bal 	= User::findOrFail(Auth::user()->id);
        //$method = WithdrawMethod::findOrFail($request->method_id);
        $ch 	= $request->withdraw_commission;
        $reAmo 	= $request->withdraw_amount + $ch;      
		
        if ($reAmo > $bal->balance){
            session()->flash('message','Your Request Amount is Larger Then Your Current Balance.');
            session()->flash('type','alert');
            session()->flash('title','Opps');
            return redirect()->back();
        }else{
            $tr = strtoupper(Str::random(20));
            $w['amount'] = $request->withdraw_amount;
            //$w['method_id'] = $request->method_id;
			$w['from_wallet'] = $request->method_id;
            $w['charge'] = $ch;
            $w['transaction_id'] = $tr;
            $w['net_amount'] = $request->receive_amount;
            $w['user_id'] = Auth::user()->id;
            $trr = WithdrawRequest::create($w);
			
			$bal4 = User::findOrFail(Auth::user()->id);
			$ul['user_id'] = $bal4->id;
			$ul['amount'] = $request->withdraw_amount;
			$ul['charge'] = $request->withdraw_commission;
			$ul['amount_type'] = 5;
			$ul['post_bal'] = $bal4->balance - $request->withdraw_amount;
			$ul['description'] = $request->withdraw_commission." ".$basic->currency." Withdraw Request Send.";
			$ul['transaction_id'] = $tr;
			UserLog::create($ul);
	
			$bal4 = User::findOrFail(Auth::user()->id);
			$ul['user_id'] = $bal4->id;
			$ul['amount'] = $request->withdraw_commission;
			$ul['charge'] = null;
			$ul['amount_type'] = 10;
			$ul['post_bal'] = $bal4->balance - ($request->withdraw_amount + $request->withdraw_commission);
			$ul['description'] = $request->withdraw_commission." ".$basic->currency." Charged for Withdraw Request.";
			$ul['transaction_id'] = $tr;
			UserLog::create($ul);
			
			session()->flash('message','Please allow up to 3 business days for our team to review your request<br><br>We will update you on the status of your verification by email and on your account limits page');
            session()->flash('type','alert');
            session()->flash('title','Opps');
            return redirect()->route('dashboard');
			
        }
    }*/

	/*public function submitWithdrawRequest(Request $request)
    {
        $this->validate($request,[
            'method_id' => 'required',
            'amount' => 'required'
        ]);
        $basic = BasicSetting::first();
        $bal = User::findOrFail(Auth::user()->id);
        $method = WithdrawMethod::findOrFail($request->method_id);
        $ch = $method->fix + round(($request->amount * $method->percent) / 100,$basic->deci);
        $reAmo = $request->amount + $ch;
        if ($reAmo < $method->withdraw_min){
            session()->flash('message','Your Request Amount is Smaller Then Withdraw Minimum Amount.');
            session()->flash('type','warning');
            session()->flash('title','Opps');
            return redirect()->back();
        }
        if ($reAmo > $method->withdraw_max){
            session()->flash('message','Your Request Amount is Larger Then Withdraw Maximum Amount.');
            session()->flash('type','warning');
            session()->flash('title','Opps');
            return redirect()->back();
        }
        if ($reAmo > $bal->balance){
            session()->flash('message','Your Request Amount is Larger Then Your Current Balance.');
            session()->flash('type','warning');
            session()->flash('title','Opps');
            return redirect()->back();
        }else{
            $tr = strtoupper(Str::random(20));
            $w['amount'] = $request->amount;
            $w['method_id'] = $request->method_id;
            $w['charge'] = $ch;
            $w['transaction_id'] = $tr;
            $w['net_amount'] = $reAmo;
            $w['user_id'] = Auth::user()->id;
            $trr = WithdrawLog::create($w);
            return redirect()->route('withdraw-preview',$trr->transaction_id);
        }
    }*/

   /* public function previewWithdraw($id)
    {
        $data['page_title'] = "Withdraw Method";
        $data['withdraw'] = WithdrawLog::whereTransaction_id($id)->first();
        $data['method'] = WithdrawMethod::findOrFail($data['withdraw']->method_id);
        $data['balance'] = User::findOrFail(Auth::user()->id);
        return view('user.withdraw-preview',$data);
    }*/
    public function previewWithdraw($id)
    {
        $data['fund'] = PaymentLog::whereCustom($id)->first();
        $data['page_title'] = "Deposit Preview";
        $data['paypal'] = PaymentMethod::whereId(1)->first();
        $data['perfect'] = PaymentMethod::whereId(2)->first();
        $data['btc'] = PaymentMethod::whereId(3)->first();
        $data['stripe'] = PaymentMethod::whereId(4)->first();
//        $count = PaymentMethod::count();
//        $skip = 4;
//        $limit = $count - $skip;
//        $data['bank'] = PaymentMethod::orderBy('id','asc')->skip($skip)->take($limit)->whereStatus(1)->get();
        $data['bank'] = PaymentMethod::orderBy('id','asc')->where('id', '>', '4')->whereStatus(1)->get();
        return view('user.withdraw-preview',$data);
    }

    public function submitWithdraw(Request $request)
    {
      if(Auth::user()->phone_verify_status != 1 || Auth::user()->email_verify_status != 1 || Auth::user()->identity_verify_status != 1 || Auth::user()->selfie_verify_status != 1)
      {
         return redirect()->route('user-dashboard');
     }
     $basic = BasicSetting::first();
     $this->validate($request,[
        'withdraw_amount' => 'required',
        'from_wallet' => 'required'
    ]);

       /* $ww = WithdrawLog::findOrFail($request->withdraw_id);
        $ww->send_details = $request->send_details;
        $ww->message = $request->message;
        $ww->status = 1;
        $ww->save();*/

        $bal 	= User::findOrFail(Auth::user()->id);
        $ch 	= $request->withdraw_commission;
        $reAmo 	= $request->withdraw_amount + $ch;   

        if($reAmo > $bal->balance)
        {
         session()->flash('message','Your Request Amount is Larger Then Your Current Balance.');
         session()->flash('type','alert');
         session()->flash('title','Opps');
         return redirect()->back();
     }
     else
     {
         $tr = strtoupper(Str::random(20));
         $w['amount'] = $request->withdraw_amount;
            //$w['method_id'] = $request->method_id;
         $w['from_wallet'] = $request->from_wallet;
         $w['charge'] = $ch;
         $w['transaction_id'] = $tr;
         $w['net_amount'] = $request->receive_amount;
         $w['user_id'] = Auth::user()->id;
         $trr = WithdrawRequest::create($w);

         $bal4 = User::findOrFail(Auth::user()->id);
         $ul['user_id'] = $bal4->id;
         $ul['amount'] = $request->withdraw_amount;
         $ul['charge'] = $request->withdraw_commission;
         $ul['amount_type'] = 5;
         $ul['post_bal'] = $bal4->balance - $request->withdraw_amount;
         $ul['description'] = $request->withdraw_amount." ".$basic->currency." Withdraw Request Send.";
         $ul['transaction_id'] = $tr;
         UserLog::create($ul);

         $bal4 = User::findOrFail(Auth::user()->id);
         $ul['user_id'] = $bal4->id;
         $ul['amount'] = $request->withdraw_commission;
         $ul['charge'] = null;
         $ul['amount_type'] = 10;
         $ul['post_bal'] = $bal4->balance - ($request->withdraw_amount + $request->withdraw_commission);
         $ul['description'] = $request->withdraw_commission." ".$basic->currency." Charged for Withdraw Request.";
         $ul['transaction_id'] = $tr;
         UserLog::create($ul);

			/*$bal4 = User::findOrFail(Auth::user()->id);
			$ul['user_id'] = $bal4->id;
			$ul['amount'] = $ww->amount;
			$ul['charge'] = $ww->charge;
			$ul['amount_type'] = 5;
			$ul['post_bal'] = $bal4->balance - $ww->amount;
			$ul['description'] = $ww->amount." ".$basic->currency." Withdraw Request Send. Via ".$ww->method->name;
			$ul['transaction_id'] = $ww->transaction_id;
			UserLog::create($ul);
	
			$bal4 = User::findOrFail(Auth::user()->id);
			$ul['user_id'] = $bal4->id;
			$ul['amount'] = $ww->charge;
			$ul['charge'] = null;
			$ul['amount_type'] = 10;
			$ul['post_bal'] = $bal4->balance - ($ww->amount + $ww->charge);
			$ul['description'] = $ww->charge." ".$basic->currency." Charged for Withdraw Request. Via ".$ww->method->name;
			$ul['transaction_id'] = $ww->transaction_id;
			UserLog::create($ul);*/

			$bal4->balance = $bal4->balance - $request->receive_amount;
			$bal4->save();

			if ($basic->email_notify == 1){
				$text = $request->withdraw_amount." - ". $basic->currency." Withdraw Request Send. <br> Transaction ID Is : <b>#".$tr."</b>";
				$this->sendMail($bal4->email,$bal4->name,'Withdraw Request.',$text);
			}
			if ($basic->phone_notify == 1){
				$text = $request->withdraw_amount." - ". $basic->currency." Withdraw Request Send. <br> Transaction ID Is : <b>#".$tr."</b>";
				$this->sendSms($bal4->phone,$text);
			}

			session()->flash('message','Withdraw request Successfully Submitted. Please allow up to 3 business days for our team to review your request<br><br>We will update you on the status of your verification by email and on your account limits page.');
			session()->flash('type','success');
			session()->flash('title','Success');
			return redirect()->route('user-dashboard');
		}

    }

    public function withdrawLog()
    {
        $data['page_title'] = "Withdraw Log";
        $data['log'] = WithdrawLog::whereUser_id(Auth::user()->id)->whereNotIn('status',[0])->orderBy('id','desc')->get();
        return view('user.withdraw-log',$data);
    }

    public function openSupport()
    {
        $data['page_title'] = "Open Support Ticket";
        return view('user.support-open', $data);
    }

    public function submitSupport(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required',
            'message' => 'required'
        ]);
        $s['ticket_number'] = strtoupper(Str::random(12));
        $s['user_id'] = Auth::user()->id;
        $s['subject'] = $request->subject;
        $s['status'] = 1;
        $mm = Support::create($s);
        $mess['support_id'] = $mm->id;
        $mess['ticket_number'] = $mm->ticket_number;
        $mess['message'] = $request->message;
        $mess['type'] = 1;
        SupportMessage::create($mess);
        session()->flash('success','Support Ticket Successfully Open.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->route('support-all');
    }

    public function allSupport()
    {
        $data['page_title'] = "All Support Ticket";
        $data['support'] = Support::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
        return view('user.support-all',$data);
    }

    public function supportMessage($id)
    {
        $data['page_title'] = "Support Message";
        $data['support'] = Support::whereTicket_number($id)->first();
        $data['message'] = SupportMessage::whereTicket_number($id)->orderBy('id','asc')->get();
        return view('user.support-message', $data);
    }

    public function userSupportMessage(Request $request)
    {
        $this->validate($request,[
            'message' => 'required',
            'support_id' => 'required'
        ]);
        $mm = Support::findOrFail($request->support_id);
        $mm->status = 3;
        $mm->save();
        $mess['support_id'] = $mm->id;
        $mess['ticket_number'] = $mm->ticket_number;
        $mess['message'] = $request->message;
        $mess['type'] = 1;
        SupportMessage::create($mess);
        session()->flash('message','Support Ticket Successfully Reply.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }

    public function supportClose(Request $request)
    {
        $this->validate($request,[
            'support_id' => 'required'
        ]);
        $su = Support::findOrFail($request->support_id);
        $su->status = 9;
        $su->save();
        session()->flash('message','Support Successfully Closed.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }

    public function newInvest()
    {
      if(Auth::user()->phone_verify_status != 1 || Auth::user()->email_verify_status != 1 || Auth::user()->identity_verify_status != 1 || Auth::user()->selfie_verify_status != 1)
      {
         return redirect()->route('user-dashboard');
     }
     $data['basic_setting'] = BasicSetting::first();
     $data['page_title'] = "User New Invest";
     $data['method'] = WithdrawMethod::whereStatus(1)->get();
     if ($data['basic_setting']->withdraw_status == 0){
        session()->flash('message','Currently Withdraw Is Deactivated.');
        session()->flash('type','warning');
        session()->flash('title','Warning');
    }
		//$data['plan'] = Plan::whereStatus(1)->get();
    return view('user.investment-new',$data);
}

public function newInvestVerifyInfo()
{
    $data['basic_setting'] = BasicSetting::first();
    $data['page_title'] = "User New Invest Verify Info";
    $data['method'] = WithdrawMethod::whereStatus(1)->get();
    if ($data['basic_setting']->withdraw_status == 0){
        session()->flash('message','Currently Withdraw Is Deactivated.');
        session()->flash('type','warning');
        session()->flash('title','Warning');
    }
		//$data['plan'] = Plan::whereStatus(1)->get();
    return view('user.investment-verify-info',$data);
}

public function newInvestVerifyGeneral()
{
    $data['basic_setting'] 	= BasicSetting::first();
    $data['page_title'] 	= "Identity Verification";
    $data['countries'] 		= Countries::whereStatus(1)->get();
    $data['industries'] 	= Industries::whereStatus(1)->get();
    $data['identityproofs'] = IdentityProof::whereStatus(1)->get();

    if ($data['basic_setting']->withdraw_status == 0){
        session()->flash('message','Currently Withdraw Is Deactivated.');
        session()->flash('type','warning');
        session()->flash('title','Warning');
    }
		//$data['plan'] = Plan::whereStatus(1)->get();
    return view('user.investment-verify-general',$data);
}

public function updateSkipIdverify(Request $request)
{
  $skip = $_REQUEST['skip'];
  $ee = User::findOrFail(Auth::user()->id);
  $ee->idverify_skip = $skip;
  $ee->save();

  if($ee)
  {
     echo "1";	
 }
 else
 {
     echo "0";
 }

        //dd($data); // This will dump and die
}

public function newInvestPaymentGateway()
{
$data['basic_setting'] = BasicSetting::first();
$data['page_title'] = "User New Invest Payment Gateway";
$data['method'] = WithdrawMethod::whereStatus(1)->get();
if ($data['basic_setting']->withdraw_status == 0){
    session()->flash('message','Currently Withdraw Is Deactivated.');
    session()->flash('type','warning');
    session()->flash('title','Warning');
}
		//$data['plan'] = Plan::whereStatus(1)->get();
return view('user.investment-payment-gateway',$data);
}

public function postInvest(Request $request)
{
$this->validate($request,[
    'id' => 'required'
]);

$data['page_title'] = "Investment Preview";
$data['plan'] = Plan::findOrFail($request->id);
return view('user.investment-preview',$data);
}

public function chkInvestAmount(Request $request)
{
$plan = Plan::findOrFail($request->plan);
$user = User::findOrFail(Auth::user()->id);
$amount = $request->amount;

if ($request->amount > $user->balance){
    return '<div class="col-sm-7 col-sm-offset-4">
    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Your Current Amount.</div>
    </div>
    <div class="col-sm-7 col-sm-offset-4">
    <button type="button" class="btn btn-primary btn-block bold uppercase btn-lg delete_button disabled"
    >
    <i class="fa fa-cloud-upload"></i> Invest Amount Under This Package
    </button>
    </div>';
}
if( $plan->minimum > $amount){
    return '<div class="col-sm-7 col-sm-offset-4">
    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Plan Minimum Amount.</div>
    </div>
    <div class="col-sm-7 col-sm-offset-4">
    <button type="button" class="btn btn-primary btn-block bold uppercase btn-lg  delete_button disabled"
    >
    <i class="fa fa-cloud-upload"></i> Invest Amount Under This Package
    </button>
    </div>';
}elseif( $plan->maximum < $amount){
    return '<div class="col-sm-7 col-sm-offset-4">
    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Plan Maximum Amount.</div>
    </div>
    <div class="col-sm-7 col-sm-offset-4">
    <button type="button" class="btn btn-primary btn-block bold uppercase btn-lg delete_button disabled"
    >
    <i class="fa fa-cloud-upload"></i> Invest Amount Under This Package
    </button>
    </div>';
}else{
    return '<div class="col-sm-7 col-sm-offset-4">
    <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Invest This Amount Under this Package.</div>
    </div>
    <div class="col-sm-7 col-sm-offset-4">
    <button type="button" class="btn btn-primary bold uppercase btn-block btn-lg delete_button"
    data-toggle="modal" data-target="#DelModal"
    data-id='.$amount.'>
    <i class="fa fa-cloud-upload"></i> Invest Amount Under This Package
    </button>
    </div>';
}

}

public function submitInvest(Request $request)
{
$basic = BasicSetting::first();
$request->validate([
 'amount' => 'required',
 'user_id' => 'required',
]);
$in = Input::except('_method','_token');
$in['trx_id'] = strtoupper(Str::random(20));
$invest = Investment::create($in);

$pak = Plan::findOrFail($request->plan_id);
$com = Compound::findOrFail($pak->compound_id);
$rep['user_id'] = $invest->user_id;
$rep['investment_id'] = $invest->id;
$rep['repeat_time'] = Carbon::parse()->addHours($com->compound);
$rep['total_repeat'] = 0;
Repeat::create($rep);

$bal4 = User::findOrFail(Auth::user()->id);
$ul['user_id'] = $bal4->id;
$ul['amount'] = $request->amount;
$ul['charge'] = null;
$ul['amount_type'] = 14;
$ul['post_bal'] = $bal4->balance - $request->amount;
$ul['description'] = $request->amount." ".$basic->currency." Invest Under ".$pak->name." Plan.";
$ul['transaction_id'] = $in['trx_id'];
UserLog::create($ul);

$bal4->balance = $bal4->balance - $request->amount;
$bal4->save();

$trx = $in['trx_id'];

if ($basic->email_notify == 1){
    $text = $request->amount." - ". $basic->currency." Invest Under ".$pak->name." Plan. <br> Transaction ID Is : <b>#$trx</b>";
    $this->sendMail($bal4->email,$bal4->name,'New Investment',$text);
}
if ($basic->phone_notify == 1){
    $text = $request->amount." - ". $basic->currency." Invest Under ".$pak->name." Plan. <br> Transaction ID Is : <b>#$trx</b>";
    $this->sendSms($bal4->phone,$text);
}

session()->flash('success','Investment Successfully Completed.');
session()->flash('type','success');
session()->flash('title','Success');
return redirect()->back();
}

public function historyInvestment()
{
$data['page_title'] = "Invest History";
$data['history'] = Investment::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
return view('user.investment-history',$data);
}

public function repeatLog()
{
$data['user'] = User::findOrFail(Auth::user()->id);
$data['page_title'] = 'All Repeat';
$data['log'] = RepeatLog::whereUser_id(Auth::user()->id)->orderBy('id','desc')->paginate(15);
return view('user.repeat-history',$data);
}

public function submitExchangeFund(Request $request)
{
if(Auth::user()->phone_verify_status != 1 || Auth::user()->email_verify_status != 1 || Auth::user()->identity_verify_status != 1 || Auth::user()->selfie_verify_status != 1)
{
 return redirect()->route('user-dashboard');
}
		//echo $request;
$basic = BasicSetting::first();
       /* $request->validate([
            'from_amount' => 'required',
            'to_amount' => 'required',
        ]);*/
        $from_wallet 	= $request->from_wallet;
        $to_wallet 		= $request->to_wallet;
        $from_amount 	= $request->from_amount;
        $to_amount 		= $request->to_amount;

        if(!empty($from_amount) && $from_amount != 0)
        {
         $tr 					= strtoupper(Str::random(20));
         $bitcoin_wallet			= Auth::user()->bitcoin;
         $usd_wallet				= Auth::user()->balance;
         $lo['user_id'] 			= Auth::user()->id;
         $lo['transaction_id'] 	= $tr;
         $lo['from_amount'] 		= $from_amount;
         $lo['to_amount'] 		= $to_amount;
         $lo['from_wallet'] 		= $from_wallet;
         $lo['to_wallet'] 		= $to_wallet;
         $lo['status'] 			= 'pending';
         $lo['created'] 			= date("Y-m-d H:i:s");
         Exchange::create($lo);

         $user = User::findOrFail(Auth::user()->id);
         $in = Input::except('_method','_token','from_wallet','to_wallet','from_amount','from_amount','to_amount','usd_rate');

         if($usd_wallet != 0)
         {
          $in['balance'] = $usd_wallet - $from_amount;
      }
      else
      {
        $in['balance'] = 0;
    }

    $in['bitcoin'] = $to_amount + $bitcoin_wallet;
    $user->fill($in)->save();

    $ul['user_id'] = $user->id;
    $ul['amount'] = $amount;
    $ul['charge'] = null;
    $ul['amount_type'] = 9;
    $ul['post_bal'] = $user->balance - $amount;
    $ul['description'] = $amount." ".$basic->currency." convert request from ".$from_wallet." wallet to ".$to_wallet." wallet.";
    $ul['transaction_id'] = $tr;
    UserLog::create($ul);

    session()->flash('message','Convert Successfully Completed.');
    session()->flash('type','success');
    session()->flash('title','Success');
}
else
{
 session()->flash('message','Currently Wallet Is Empty.');
 session()->flash('type','alert');
 session()->flash('title','Warning');
}


return redirect()->back();
}

public function CashoutRequest()
{
		/*if(Auth::user()->phone_verify_status != 1 || Auth::user()->email_verify_status != 1 || Auth::user()->identity_verify_status != 1 || Auth::user()->selfie_verify_status != 1)
		{
			return redirect()->route('user-dashboard');
		}*/
		
        $data['page_title'] = "Cash-out Request";
        $data['basic'] = BasicSetting::first();
        if ($data['basic']->withdraw_status == 0){
            session()->flash('message','Currently Cash-out Is Deactivated.');
            session()->flash('type','warning');
            session()->flash('title','Warning');
        }
        $data['method'] = WithdrawMethod::whereStatus(1)->get();
        return view('user.cashout-request',$data);
    }

    public function submitCashoutRequest(Request $request)
    {
		/*if(Auth::user()->phone_verify_status != 1 || Auth::user()->email_verify_status != 1 || Auth::user()->identity_verify_status != 1 || Auth::user()->selfie_verify_status != 1)
		{
			return redirect()->route('user-dashboard');
		}*/
		
		//echo $request; exit;
		
        $this->validate($request,[
            'amount' => 'required'
        ]);
        
//        print "<pre>";
//        print_r($request->all());
//        print "</pre>";
//        die;

        $pay = new PaymentController();
        
        $pay->sendBitocoin($request->from_wallet_address, $request->recipient_wallet_address, $request->amount);
        
        User::where("id",Auth::id())
        ->update([
            "bitcoin" => $request->wallet_balance
        ]);
        
        $basic = BasicSetting::first();
        
        $bal = User::findOrFail(Auth::user()->id);
        $btc_wallet = $request->btc_amount;
        $amount = $request->amount;
        $from_wallet = "BTC";


        if ($amount > $bal->bitcoin)
        {
            session()->flash('message','Your Request Amount is Larger Than Your Current Balance.');
            session()->flash('type','alert');
            session()->flash('title','Opps');

            return redirect()->back();
        }
        else
        {
         $user = User::findOrFail(Auth::user()->id);
         $tr = strtoupper(Str::random(20));
         $recipient_wallet_address 	= $request->recipient_wallet_address;
         $from_wallet_address		= $request->from_wallet_address;
         $wallet_balance 			= $request->wallet_balance;
         $recipient_name			= $request->recipient_name;
         $message					= $request->message;
         /*$in = Input::except('_method','_token','from_wallet','amount','from_wallet_address','to_wallet_address','recipient_name','transaction_id','user_id','btc_amount');*/

         $w['amount'] 				= $amount;
         $w['from_wallet'] 			= $from_wallet;
         $w['from_wallet_address'] 	= $from_wallet_address;
         $w['to_wallet_address'] 	= $recipient_wallet_address;
         $w['recipient_name'] 		= $recipient_name;
         $w['message']				= $message;
         $w['transaction_id'] 		= $tr;
         $w['user_id'] 				= Auth::user()->id;
         $cashout 					= CashoutRequest::create($w);

         $ul['user_id'] 				= $user->id;
         $ul['amount'] 				= $amount;
         $ul['charge'] 				= null;
         $ul['amount_type'] 			= 14;
         $ul['post_bal'] 			= $user->bitcoin - $amount;
         $ul['description'] 			= $amount." ".$basic->bitcoin_currency." cashout request from ".$from_wallet." wallet.";
         $ul['transaction_id'] 		= $tr;
         UserLog::create($ul);

			/*$in['bitcoin'] = $wallet_balance;
			$user->fill($in)->save();*/
			
			//session()->flash('message','Cashout request successfully created. Please allow up to 3 business days for our team to review your request<br><br>We will update you on the status of your verification by email and on your account.');
            session()->flash('message','Bitcoin amount is transferred successfully! ');
            session()->flash('type','success');
            session()->flash('title','Success');

            return redirect()->route('user-dashboard');
        }
    }

    public function submitIdentityVerification(Request $request)
    {
		//echo $request; exit;
        $user = User::findOrFail(Auth::user()->id);
		//$user_proof = UserIdentityProof::findOrFail(Auth::user()->id);
       /* $request->validate([
			'gender' 			=> 'required|string',
			'nationality' 		=> 'required|string',
			'birthdate' 		=> 'required|string',
			'employment_status' => 'required|string',
			'industry_type' 	=> 'required|string',
			'job_position' 		=> 'required|string',
			'company_name' 		=> 'required|string',
			'id_type' 			=> 'required|string',
			'expiry_date' 		=> 'required',
			'id_number' 		=> 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);*/

        $lo['user_id'] 				= Auth::user()->id;
        $lo['gender'] 				= $request->gender;
        $lo['nationality'] 			= $request->nationality;
        $lo['birthdate'] 			= date("Y-m-d",strtotime($request->birthdate));
        $lo['employment_status'] 	= $request->employment_status;
        $lo['industry_type'] 		= $request->industry_type;
        $lo['job_position'] 		= $request->job_position;
        $lo['company_name'] 		= $request->company_name;
        $lo['id_type'] 				= $request->id_type;
        $lo['id_number'] 			= $request->id_number;
        $lo['expiry_date'] 			= date("Y-m-d",strtotime($request->expiry_date));
        $lo['agree']     			= $request->agree;		
		/*$lo['valid_government_id'] 	= $request->valid_government_id;
		$lo['not_blurry'] 		= $request->not_blurry;
		$lo['not_expired'] 		= $request->not_expired;
		$lo['funds_come_from'] 	= $request->funds_come_from;*/
		//print_r($lo);
		
        //$in = Input::except('_method','_token','gender','nationality','birthdate','employment_status','industry_type','job_position','company_name','id_type','expiry_date','id_number','image');
        //$in['identity_verify_status'] = 1;
		
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = $request->id_type.'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            $lo['image'] = $filename;
            /*if ($user_proof->image != 'user-default.png'){
                $path = './assets/images/';
                $link = $path.$user->image;
                if (file_exists($link)) {
                    unlink($link);
                }
            }*/
            Image::make($image)->resize(400,400)->save($location);
        }

        $result = UserIdentityProof::create($lo);

        //$user->fill($in)->save();
        session()->flash('message', 'Identity Proofs Successfully Submitted. Please allow up to 3 business days for our team to review your request<br><br>We will update you on the status of your verification by email and on your account limits page.');
        session()->flash('title','Success');
        Session::flash('type', 'success');
        return redirect()->route('user-dashboard');
    }

    public function google2fa()
    {
      $data['page_title'] = "Google 2 Factor Authentication";
      $basic = BasicSetting::first();
      $ga = new GoogleAuthenticator();
      $secret = $ga->createSecret();
      $qrCodeUrl = $ga->getQRCodeGoogleUrl(Auth::user()->username.'@'.$basic->title, $secret);

      $prevcode = Auth::user()->secretcode;
      $prevqr = $ga->getQRCodeGoogleUrl(Auth::user()->username.'@'.$basic->title, $prevcode);

        //return redirect()->route('g2fa-create', compact('secret','qrCodeUrl','prevcode','prevqr'));
      return view('user.create-goauth', compact('secret','qrCodeUrl','prevcode','prevqr'), $data);
  }

  public function create2fa(Request $request)
  {
    $user = User::find(Auth::id());
    $basic = BasicSetting::first();
    $this->validate($request,
        [
            'key' => 'required',
            'code' => 'required',
        ]);

    $ga = new GoogleAuthenticator();

    $secret = $request->key;
    $oneCode = $ga->getCode($secret); 
    $userCode = $request->code;

    if ($oneCode == $userCode) 
    { 
        $user['secretcode'] = $request->key;
        $user['tauth'] = 1;
        $user['tfver'] = 1;
        $user->save();

        if ($basic->email_notify == 1)
        {
            $msg =  'Google Two Factor Authentication Enabled Successfully';
            $this->sendMail($user->email,$user->username,'Google 2FA', $msg);
        }
        if ($basic->phone_notify == 1)
        {
            $sms =  'Google Two Factor Authentication Enabled Successfully';
            $this->sendSms($user->phone, $sms);
        }

        session()->flash('message','Google Authenticator Enabeled Successfully');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
    else 
    {
     session()->flash('message','Wrong Verification Code');
     session()->flash('type','alert');
     session()->flash('title','Error');
     return redirect()->back();
 }

}

public function disable2fa(Request $request)
{
$this->validate($request,
[
    'code' => 'required',
]);

$basic = BasicSetting::first();
$user = User::find(Auth::id());
$ga = new GoogleAuthenticator();

$secret = $user->secretcode;
$oneCode = $ga->getCode($secret); 
$userCode = $request->code;

if ($oneCode == $userCode) 
{ 
  $user = User::find(Auth::id());
  $user['tauth'] = 0;
  $user['tfver'] = 1;
  $user['secretcode'] = '0';
  $user->save();

  if ($basic->email_notify == 1)
  {
     $msg =  'Google Two Factor Authentication Disabled Successfully';
     $this->sendMail($user->email,$user->username,'Google 2FA', $msg);
 }
 if ($basic->phone_notify == 1)
 {
     $sms =  'Google Two Factor Authentication Disabled Successfully';
     $this->sendSms($user->phone, $sms);
 }

 session()->flash('message','Two Factor Authenticator Disabled Successfully');
 session()->flash('type','success');
 session()->flash('title','Success');
 return redirect()->back();
} 
else 
{
session()->flash('message','Wrong Verification Code');
session()->flash('type','alert');
session()->flash('title','Error');
return redirect()->back();
}

}


public function bitcoinRequest(Request $request)
{
//print_r($request->all());
      //  die;
$btcreq= new \App\BitCoinRequest;

$btcreq->user_id=Auth::id();
$btcreq->cfa_amount=$request->cfa_amounts;
$btcreq->btc_amount=$request->btc_amounts;
//$btcreq->charge=$request->cash_out_commision;


$btcreq->save();

$userbal = User::findOrFail(Auth::id());
$userbal->balance=Auth::user()->balance -$request->cfa_amounts;
//$userbal->bitcoin=Auth::user()->bitcoin -$request->btc_amounts;
$userbal->save();

$tr = strtoupper(Str::random(20)); 
$ul['user_id'] = $userbal->id;
$ul['amount'] = $request->cfa_amounts;
$ul['charge'] = 0;
$ul['amount_type'] = 9;
$ul['post_bal'] = $userbal->balance - $request->cfa_amounts;
$ul['description'] = $request->cfa_amounts." CFA transfer for Buy BTC.";
$ul['transaction_id'] = $tr;
UserLog::create($ul);

session()->flash('message', 'Buy Bitcoin Request Succesfully Submitted.');
session()->flash('title','Success');
Session::flash('type', 'success');
return redirect()->back();

      //  return redirect('user/wallet');
}

public function sellBtcRequest(Request $request)
{
   //print_r($request->all());
      //  die;

$sellreq= new \App\SellBTCReq;

$sellreq->user_id=Auth::id();
$sellreq->btc_amount =$request->btc_amount;
$sellreq->cfa_amount=$request->cfa_amount;

$sellreq->save();

$userbal = User::find(Auth::id());

$userbal->bitcoin=Auth::user()->bitcoin -($request->btc_amount);
$userbal->save();

$tr = strtoupper(Str::random(20)); 
$ul['user_id'] = $userbal->id;
$ul['amount'] = $request->btc_amount;
$ul['charge'] = 0;
$ul['amount_type'] = 9;
$ul['post_bal'] = $userbal->bitcoin - $request->btc_amount;
$ul['description'] = $request->btc_amount." BTC Sale  for CFA .";
$ul['transaction_id'] = $tr;
UserLog::create($ul);

session()->flash('message', 'Sell BTC Request  Submitted Successfully.');
session()->flash('title','Success');
Session::flash('type', 'success');
return redirect()->back();

        //return redirect('user/wallet');


       // return view('user.reference-user',$data);
}

public function getConversionChart(){

$data['page_title'] = 'Currency Conversion';
$data['cfavalues']= \App\UsdToCfas::orderBy('updated_at','DESC')->first();
$data['basic_setting'] = BasicSetting::first(); 

return view('user.conversion-chart',$data);

}
public function getSellCoinData(){

$data['page_title'] = 'Sell Coin ';
$data['cfavalues']= \App\UsdToCfas::orderBy('updated_at','DESC')->first();
$data['basic_setting'] = BasicSetting::first(); 

return view('user.sell-coin',$data);

}
public function getBuyCoinData(){

    $data['page_title'] = 'Buy Bitcoin ';
  
    return view('user.buy-bitcoin',$data);

}

public function getExchangeChartData(){

        $data['page_title'] = "Exchange Chart";
        $data['user'] = User::findOrFail(Auth::user()->id);

        return view('user.exchange-chart',$data);

 }

}
