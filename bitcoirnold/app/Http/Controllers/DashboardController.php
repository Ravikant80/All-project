<?php

namespace App\Http\Controllers;

use App\BasicSetting;
use App\Compound;
use App\CashoutRequest;
use App\Deposit;
use App\PaymentMethod;
use App\Exchange;
use App\Plan;
use App\RepeatLog;
use App\Support;
use App\SupportMessage;
use App\TraitsFolder\MailTrait;
use App\User;
use App\UserLog;
use App\UserLogin;
use App\UserIdentityProof;
use App\WithdrawLog;
use App\WithdrawMethod;
use App\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\News;
use Auth;

class DashboardController extends Controller
{
    use MailTrait;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function getDashboard()
    {
        $data['page_title'] = "Dashboard";

        $data['total_earn'] = UserLog::whereIn('amount_type', [1,2,5,9,10])->sum('amount') - UserLog::whereIn('amount_type', [4,3,6,8])->sum('amount');

        $data['total_pending_ticket'] = Support::whereIn('status', [1,3])->count();
        $data['total_ticket'] = Support::all()->count();
        $data['total_answer'] = Support::whereStatus(2)->count();
        $data['total_close'] = Support::whereStatus(9)->count();

        $data['user_balance'] = User::sum('balance');
        $data['total_repeat'] = RepeatLog::sum('amount');

        $data['total_user'] = User::all()->count();
        $data['block_user'] = User::whereStatus(1)->count();
        $data['email_verify'] = User::whereEmail_verify(0)->count();
        $data['phone_verify'] = User::wherePhone_verify(0)->count();

        $data['total_deposit'] = Deposit::whereNotIn('status',[0])->sum('amount');
        $data['deposit_method'] = PaymentMethod::all()->count();
        $data['deposit_number'] = Deposit::whereNotIn('status',[0])->count();
        $data['deposit_pending'] = Deposit::whereStatus(0)->count();

        $data['total_plan'] = Plan::all()->count();
        $data['active_plan'] = Plan::whereStatus(1)->count();
        $data['deactive_plan'] = Plan::whereStatus(0)->count();


        $data['total_withdraw'] = WithdrawLog::whereStatus(2)->sum('amount');
        $data['withdraw_method'] = WithdrawMethod::all()->count();
        $data['withdraw_charge'] = WithdrawLog::whereStatus(2)->sum('charge');
        $data['withdraw_number'] = WithdrawLog::all()->count();
        $data['withdraw_success'] = WithdrawLog::whereStatus(2)->count();
        $data['withdraw_pending'] = WithdrawLog::whereStatus(1)->count();
        $data['withdraw_refund'] = WithdrawLog::whereStatus(3)->count();
        $data['user_btcrequest'] = WithdrawLog::whereStatus(3)->count();


        return view('dashboard.dashboard', $data);
    }
    public function manageCompound()
    {
        $data['page_title'] = "Manage Investment Compound";
        $data['compound'] = Compound::all();
        return view('dashboard.compound-manage', $data);
    }
    public function storeCompound(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'compound' => 'required',
        ]);
        $product = Compound::create($request->input());
        return response()->json($product);
    }
    public function editCompound($product_id)
    {
        $product = Compound::find($product_id);
        return response()->json($product);
    }
    public function updateCompound(Request $request,$product_id)
    {
        $product = Compound::find($product_id);
        $product->name = $request->name;
        $product->compound = $request->compound;
        $product->save();
        return response()->json($product);
    }
    public function createPlan()
    {
        $data['page_title'] = "New Investment Plan";
        $data['compound'] = Compound::all();
        return view('dashboard.plan-create', $data);
    }
    public function storePlan(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:plans,name',
            'minimum' => 'required|numeric|integer',
            'maximum' => 'required|numeric|integer',
            'time' => 'required|integer',
            'compound_id' => 'required',
            'percent' => 'required|numeric',
            'image' => 'required|mimes:jpg,png'
        ]);
        $plan = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(445,350)->save($location);
            $plan['image'] = $filename;
        }
        $plan['status'] = $request->status == 'on' ? '1' : '0';
        Plan::create($plan);
        session()->flash('message', 'Investment Plan Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function showPlan()
    {
        $data['page_title'] = "All Investment Plan";
        $data['plan'] = Plan::all();
        return view('dashboard.plan-show', $data);
    }
    public function editPlan($id)
    {
        $data['page_title'] = "All Investment Plan";
        $data['plan'] = Plan::findOrFail($id);
        $data['compound'] = Compound::all();
        return view('dashboard.plan-edit', $data);
    }
    public function updatePlan(Request $request,$id)
    {
        $p = Plan::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|unique:plans,name,'.$p->id,
            'minimum' => 'required|numeric|integer',
            'maximum' => 'required|numeric|integer',
            'time' => 'required|integer',
            'compound_id' => 'required',
            'percent' => 'required|numeric',
            'image' => 'mimes:jpg,png'
        ]);
        $plan = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(445,350)->save($location);
            $plan['image'] = $filename;
            $path = './assets/images/';
            $link = $path.$p->image;
            if (file_exists($link)) {
                unlink($link);
            }
        }
        $plan['status'] = $request->status == 'on' ? '1' : '0';
        $p->fill($plan)->save();
        session()->flash('message', 'Investment Plan Update Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
//    public function depositMethod()
//    {
//        $data['page_title'] = 'Deposit Method';
//        $data['paypal'] = PaymentMethod::whereId(1)->first();
//        $data['perfect'] = PaymentMethod::whereId(2)->first();
//        $data['btc'] = PaymentMethod::whereId(3)->first();
//        $data['stripe'] = PaymentMethod::whereId(4)->first();
//        return view('dashboard.payment-method',$data);
//    }


    public function depositMethod()
    {
        $data['page_title'] = 'Deposit Method';
//        $data['paypal'] = PaymentMethod::whereId(1)->first();
//        $data['perfect'] = PaymentMethod::whereId(2)->first();
//        $data['btc'] = PaymentMethod::whereId(3)->first();
//        $data['stripe'] = PaymentMethod::whereId(4)->first();

        $data['gateways'] = PaymentMethod::take(5)->get();
        return view('dashboard.payment-method',$data);
    }

    public function updateDepositMethod(Request $request, $id)
    {
        $gateway = PaymentMethod::find($id);

        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'fix' => 'required',
            'percent' => 'required',
            'rate' => 'required',
            'val1' => 'nullable',
            'val2' => 'nullable',
            'status' => 'nullable'
        ]);

        if($request->hasFile('image'))
        {
            if (file_exists('assets/images/'.$gateway->image)) {
                unlink('assets/images/'.$gateway->image);
            }
            $gateway['image'] = uniqid().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('assets/images/',$gateway['image']);
        }

        $gateway['name'] = $request->name;
        $gateway['fix'] = $request->fix;
        $gateway['percent'] = $request->percent;
        $gateway['rate'] = $request->rate;
        $gateway['val1'] = $request->val1;
        $gateway['val2'] = $request->val2;
        $gateway['status'] = $request->status;

        $gateway->save();

        return back()->with('success','Gateway Information Updated successfully.');

    }
    

//    public function updateDepositMethod(Request $request)
//    {
//        return "asdf";
//        $this->validate($request,[
//            'paypal_name' => 'required',
//            'paypal_rate' => 'numeric',
//            'paypal_image' => 'mimes:png,jpeg,jpg',
//            'paypal_email' => 'required',
//            'perfect_name' => 'required',
//            'perfect_rate' => 'numeric',
//            'perfect_image' => 'mimes:png,jpeg,jpg',
//            'perfect_account' => 'required',
//            'perfect_alternate' => 'required',
//            'btc_name' => 'required',
//            'btc_rate' => 'numeric',
//            'btc_image' => 'mimes:png,jpeg,jpg',
//            'btc_api' => 'required',
//            'btc_xpub' => 'required',
//            'stripe_name' => 'required',
//            'stripe_rate' => 'numeric',
//            'stripe_image' => 'mimes:png,jpeg,jpg',
//            'stripe_secret' => 'required',
//            'stripe_publishable' => 'required',
//        ]);
//
//        $paypal = PaymentMethod::whereId(1)->first();
//        $perfect = PaymentMethod::whereId(2)->first();
//        $btc = PaymentMethod::whereId(3)->first();
//        $stripe = PaymentMethod::whereId(4)->first();
//
//        $paypal->name = $request->paypal_name;
//        $paypal->val1 = $request->paypal_email;
//        $paypal->status = $request->paypal_status == 'on' ? '1' : '0';
//        $paypal->fix = $request->paypal_fix;
//        $paypal->rate = $request->paypal_rate;
//        $paypal->percent = $request->paypal_percent;
//        if($request->hasFile('paypal_image')){
//            $image3 = $request->file('paypal_image');
//            $filename3 = time().'h3'.'.'.$image3->getClientOriginalExtension();
//            $location = 'assets/images/' . $filename3;
//            Image::make($image3)->resize(400,400)->save($location);
//            $path = './assets/images/';
//            $link = $path.$paypal->image;
//            if (file_exists($link)){
//                unlink($link);
//            }
//            $paypal->image = $filename3;
//        }
//        $perfect->name = $request->perfect_name;
//        $perfect->val1 = $request->perfect_account;
//        $perfect->val2 = $request->perfect_alternate;
//        $perfect->status = $request->perfect_status == 'on' ? '1' : '0';
//        $perfect->fix = $request->perfect_fix;
//        $perfect->rate = $request->perfect_rate;
//        $perfect->percent = $request->perfect_percent;
//        if($request->hasFile('perfect_image')){
//            $image3 = $request->file('perfect_image');
//            $filename3 = time().'h4'.'.'.$image3->getClientOriginalExtension();
//            $location = 'assets/images/' . $filename3;
//            Image::make($image3)->resize(400,400)->save($location);
//            $path = './assets/images/';
//            $link = $path.$perfect->image;
//            if (file_exists($link)){
//                unlink($link);
//            }
//            $perfect->image = $filename3;
//        }
//        $btc->name = $request->btc_name;
//        $btc->val1 = $request->btc_api;
//        $btc->val2 = $request->btc_xpub;
//        $btc->status = $request->btc_status == 'on' ? '1' : '0';
//        $btc->fix = $request->btc_fix;
//        $btc->rate = $request->btc_rate;
//        $btc->percent = $request->btc_percent;
//        if($request->hasFile('btc_image')){
//            $image3 = $request->file('btc_image');
//            $filename3 = time().'h5'.'.'.$image3->getClientOriginalExtension();
//            $location = 'assets/images/' . $filename3;
//            Image::make($image3)->resize(400,400)->save($location);
//            $path = './assets/images/';
//            $link = $path.$btc->image;
//            if (file_exists($link)){
//                unlink($link);
//            }
//            $btc->image = $filename3;
//        }
//        $stripe->name = $request->stripe_name;
//        $stripe->val1 = $request->stripe_secret;
//        $stripe->val2 = $request->stripe_publishable;
//        $stripe->status = $request->stripe_status == 'on' ? '1' : '0';
//        $stripe->fix = $request->stripe_fix;
//        $stripe->rate = $request->stripe_rate;
//        $stripe->percent = $request->stripe_percent;
//        if($request->hasFile('stripe_image')){
//            $image3 = $request->file('stripe_image');
//            $filename3 = time().'h6'.'.'.$image3->getClientOriginalExtension();
//            $location = 'assets/images/' . $filename3;
//            Image::make($image3)->resize(400,400)->save($location);
//            $path = './assets/images/';
//            $link = $path.$stripe->image;
//            if (file_exists($link)){
//                unlink($link);
//            }
//            $stripe->image = $filename3;
//        }
//
//        $paypal->save();
//        $perfect->save();
//        $btc->save();
//        $stripe->save();
//
//        session()->flash('message', 'Deposit Method Updated Successfully.');
//        Session::flash('type', 'success');
//        Session::flash('title', 'Success');
//        return redirect()->back();
//    }
    public function bankDeposit()
    {
        $data['page_title'] = 'Add Manual Method';
        return view('dashboard.bank-create',$data);
    }

    public function showBitcoinManualDeposit()
    {
        $data['page_title'] = 'All Bitcoin Manual Method';
        $data['btc'] = PaymentMethod::where('id', 5)->first();
        return view('dashboard.manual-bitcoin-show',$data);
    }
    public function editBitcoinManualDeposit($id)
    {
        $data['page_title'] = 'Edit Manual Method';
        $data['btc'] = PaymentMethod::findOrFail($id);
        return view('dashboard.manual-bitcoin-edit',$data);
    }
    public function updateBitcoinManual(Request $request, $id)
    {
        $btc = PaymentMethod::findOrFail($id);
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:png,jpg,jpeg',
            'val1' => 'required',
            'fix' => 'required',
            'percent' => 'required',
        ]);
        $in = Input::except('_method','_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        if($request->hasFile('image')) {
            $image3 = $request->file('image');
            $filename3 = time() . 'h7' . '.' . $image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(400, 400)->save($location);
            $in['image'] = $filename3;
            $path = './assets/images/';
            $link = $path.$btc->image;
            if (file_exists($link)){
                unlink($link);
            }
        }
        $btc->fill($in)->save();
        session()->flash('message', 'Manual Method Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function submitBankDeposit(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
            'val1' => 'required',
            'fix' => 'required|numeric',
            'percent' => 'required|numeric',
            'currency' => 'required',
            'rate' => 'required|numeric',
        ]);
        $in = Input::except('_method','_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        if($request->hasFile('image')){
            $image3 = $request->file('image');
            $filename3 = time().'h7'.'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(400,400)->save($location);
            $in['image'] = $filename3;
        }
        PaymentMethod::create($in);
        session()->flash('message', 'Manual Method Added Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function showBank()
    {
        $data['page_title'] = 'All Manual Method';
        $count = PaymentMethod::count();
        $skip = 5;
        $limit = $count - $skip;
        $data['gateways'] = PaymentMethod::orderBy('id','asc')->skip($skip)->take($limit)->get();
        return view('dashboard.bank-show',$data);
    }
    public function editBank($id)
    {
        $data['page_title'] = 'Edit Manual Method';
        $data['bank'] = PaymentMethod::findOrFail($id);
        return view('dashboard.bank-edit',$data);
    }
    public function updateBank(Request $request,$id)
    {
        $bank = PaymentMethod::findOrFail($id);
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:png,jpg,jpeg',
            'val1' => 'required',
            'fix' => 'required|numeric',
            'rate' => 'required|numeric',
            'percent' => 'required|numeric',
            'status' => 'nullable|numeric'
        ]);
        $in = Input::except('_method','_token');
        if($request->hasFile('image')) {
            $image3 = $request->file('image');
            $filename3 = time() . 'h7' . '.' . $image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(400, 400)->save($location);
            $in['image'] = $filename3;
            $path = './assets/images/';
            $link = $path.$bank->image;
            if (file_exists($link)){
                unlink($link);
            }
        }
        $bank->fill($in)->save();
        session()->flash('message', 'Manual Method Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function withdrawMethod()
    {
        $data['page_title'] = 'Add Withdraw Method';
        return view('dashboard.withdraw-method',$data);
    }
    public function storeWithdrawMethod(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
            'fix' => 'required|numeric',
            'withdraw_min' => 'numeric',
            'withdraw_max' => 'numeric',
            'percent' => 'required|numeric',
        ]);
        $in = Input::except('_method','_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        if($request->hasFile('image')) {
            $image3 = $request->file('image');
            $filename3 = time() . 'h8' . '.' . $image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(400, 400)->save($location);
            $in['image'] = $filename3;
        }
        WithdrawMethod::create($in);
        session()->flash('message','Withdraw Method Added Successfully.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
    public function showWithdrawMethod()
    {
        $data['page_title'] = 'All Withdraw Method';
        $data['bank'] = WithdrawMethod::orderBy('id','desc')->get();
        return view('dashboard.withdraw-show',$data);
    }
    public function editWithdrawMethod($id)
    {
        $data['page_title'] = 'Edit Withdraw Method';
        $data['bank'] = WithdrawMethod::findOrFail($id);
        return view('dashboard.withdraw-edit',$data);
    }
    public function updateWithdrawMethod(Request $request,$id)
    {
        $wit = WithdrawMethod::findOrFail($id);
        $this->validate($request,[
            'name' => 'required',
            'withdraw_min' => 'numeric',
            'withdraw_max' => 'numeric',
            'image' => 'mimes:png,jpg,jpeg',
            'fix' => 'required|numeric',
            'percent' => 'required|numeric',
        ]);
        $in = Input::except('_method','_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        if($request->hasFile('image')) {
            $image3 = $request->file('image');
            $filename3 = time() . 'h8' . '.' . $image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(400, 400)->save($location);
            $in['image'] = $filename3;
            $path = './assets/images/';
            $link = $path.$wit->image;
            if (file_exists($link)){
                unlink($link);
            }
        }
        $wit->fill($in)->save();
        session()->flash('message','Withdraw Method Updated Successfully.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
    public function pendingDeposit()
    {
        $data['page_title'] = 'All Pending Manual Deposit Request';
        $data['deposit'] = Deposit::whereStatus(0)->orderBy('id','desc')->paginate(15);
        return view('dashboard.request-all',$data);
    }
    public function viewRequest($id)
    {
        $data['page_title'] = "Deposit Request View";
        $data['deposit'] = Deposit::findOrFail($id);
        return view('dashboard.request-view', $data);
    }
    public function approveManualRequest(Request $request)
    {

        $this->validate($request,[
            'id' => 'required'
        ]);

        $data = Deposit::findOrFail($request->id);
        $bank = $data->bank->name;
        $basic = BasicSetting::first();
        $mem = User::findOrFail($data->user_id);
        $data->status = 1;

        $ul['user_id'] = $mem->id;
        $ul['amount'] = $data->amount;
        $ul['charge'] = $data->charge;
        $ul['post_bal'] = $mem->balance + $data->amount;
        $ul['amount_type'] = 1;
        $ul['description'] = "Deposit ".$data->amount." ".$basic->currency." . By $bank.";
        $ul['transaction_id'] = $data->transaction_id;
        UserLog::create($ul);

        if ($mem->under_reference != 0){
            $refMem = User::findOrFail($mem->under_reference);
            $refAmo = round(($data->amount * $basic->reference_percent) / 100,$basic->deci);
            $ul['user_id'] = $refMem->id;
            $ul['amount'] = $refAmo;
            $ul['charge'] = null;
            $ul['post_bal'] = $refMem->balance + $refAmo;
            $ul['amount_type'] = 3;
            $ul['description'] = "Reference Deposit Bonus ".$refAmo." ".$basic->currency." . From - $mem->username.";
            $ul['transaction_id'] = $data->transaction_id;
            UserLog::create($ul);

            $refMem->balance = $refMem->balance + $refAmo;
            $refMem->save();
            if ($basic->email_notify == 1){
                $text = $refAmo." - ". $basic->currency ." Reference Deposit Bonus From - $mem->username. <br> Transaction ID Is : <b>#".$data->custom."</b>";
                $this->sendMail($refMem->email,$refMem->name,'Reference Deposit Bonus.',$text);
            }
            if ($basic->phone_notify == 1){
                $text = $refAmo." - ".$basic->currency ." Reference Deposit Bonus From - $mem->username.. <br> Transaction ID Is : <b>#".$data->custom."</b>";
                $this->sendSms($refMem->phone,$text);
            }

        }

        $mem->balance = $mem->balance + ($data->amount);
        $mem->save();

        $data->save();
        if ($basic->email_notify == 1){
            $text = $data->amount." - ". $basic->currency ." Payment Request Approve via $bank. <br> Transaction ID Is : <b>#".$data->transaction_id."</b>";
            $this->sendMail($mem->email,$mem->name,'Deposit Completed.',$text);
        }
        if ($basic->phone_notify == 1){
            $text = $data->amount." - ".$basic->currency ." Payment Request Approve via $bank. <br> Transaction ID Is : <b>#".$data->transaction_id."</b>";
            $this->sendSms($mem->phone,$text);
        }

        session()->flash('message', 'Payment Request Successfully Approved.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->route('request-deposit');
    }
    public function cancelManualRequest(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $data = Deposit::findOrFail($request->id);
        $data->status = 2;
        $data->save();
        $basic = BasicSetting::first();
        if ($basic->email_notify == 1){
            $text = "$data->amount $basic->currency Payment Request Cancel. <br> Transaction ID Is : <b>#$data->transaction_id</b>";
            $this->sendMail($data->member->email,$data->member->name,'Payment Request Cancel.',$text);
        }
        if ($basic->phone_notify == 1){
            $text = "$data->amount $basic->currency Payment Request Cancel. <br> Transaction ID Is : <b>#$data->transaction_id</b>";
            $this->sendSms($data->member->phone,$text);
        }

        session()->flash('message', 'Payment Request Successfully Cancel.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->route('request-deposit');
    }
    public function requestDeposit()
    {
        $data['page_title'] = 'All Manual Deposit Request';
        $data['deposit'] = Deposit::whereNotIn('payment_type', [1,2,3,4])->orderBy('id','desc')->paginate(15);
        return view('dashboard.request-all',$data);
    }
    public function userDepositHistory()
    {
        $data['page_title'] = 'User Deposit History';
        $data['deposit'] = Deposit::orderBy('id','desc')->paginate(15);
        return view('dashboard.deposit-history',$data);
    }
    public function allWithdrawRequest()
    {
        $data['page_title'] = "All Withdraw Request";
        $data['log'] = WithdrawRequest::whereNotIn('status',[0])->orderBy('id','desc')->get();
        return view('dashboard.withdraw-request-all', $data);
    }
    public function singleWithdrawView($id)
    {
        $data['page_title'] = 'Withdraw Details';
        $data['deposit'] = WithdrawRequest::findOrFail($id);
        return view('dashboard.single-withdraw',$data);
    }
    public function confirmWithdraw(Request $request)
    {
        $basic = BasicSetting::first();
        $this->validate($request,[
            'id' => 'required'
        ]);
        $ee = WithdrawLog::findOrFail($request->id);
        $parent = User::findOrFail($ee->user_id);
        $ee->status = 1;
        $ee->save();

        if ($basic->email_notify == 1){
            $text = "$ee->amount $basic->currency Withdraw Request Approved. Withdraw Via ".$ee->method->name.". <br> Transaction ID Is : <b>#$ee->transaction_id</b>";
            $this->sendMail($parent->email,$parent->name,'Withdraw Approved.',$text);
        }
        if ($basic->phone_notify == 1){
            $text = "$ee->amount $basic->currency Withdraw Request Approved. Withdraw Via ".$ee->method->name.". <br> Transaction ID Is : <b>#$ee->transaction_id</b>";
            $this->sendSms($parent->phone,$text);
        }

        session()->flash('message','Withdraw Confirmed Successfully.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
    public function refundWithdraw(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $ww = WithdrawLog::findOrFail($request->id);
        $ww->status = 2;


        $basic = BasicSetting::first();
        $parent = User::whereId($ww->user_id)->first();

        $bal36 = $parent;
        $ul['user_id'] = $parent->id;
        $ul['amount'] = $ww->amount;
        $ul['charge'] = null;
        $ul['post_bal'] = $bal36->balance + $ww->amount;
        $ul['amount_type'] = 6;
        $ul['description'] = $ww->amount." ".$basic->currency." Withdraw Refunded.";
        $ul['transaction_id'] = $ww->transaction_id;
        UserLog::create($ul);

        $ul['user_id'] = $parent->id;
        $ul['amount'] = $ww->charge;
        $ul['charge'] = null;
        $ul['post_bal'] = $bal36->balance + $ww->amount + $ww->charge;
        $ul['amount_type'] = 10;
        $ul['description'] = $ww->charge." ".$basic->currency." Withdraw Charge Refunded.";
        $ul['transaction_id'] = $ww->transaction_id;
        UserLog::create($ul);

        $parent->balance = $parent->balance + ($ww->net_amount);
        $parent->save();

        $ww->save();

        if ($basic->email_notify == 1){
            $text = "$ww->amount $basic->currency Withdraw Refunded. <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
            $this->sendMail($parent->email,$parent->name,'Withdraw Refunded.',$text);
        }
        if ($basic->phone_notify == 1){
            $text = "$ww->amount $basic->currency Withdraw Refunded.  <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
            $this->sendSms($parent->phone,$text);
        }


        session()->flash('message','Withdraw Refund Successfully.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
    public function withdrawConfirm()
    {
        $data['page_title'] = "Confirm Withdraw Request";
        $data['log'] = WithdrawLog::whereStatus(2)->orderBy('id','desc')->get();
        return view('dashboard.withdraw-request-all', $data);
    }
    public function withdrawPending()
    {
        $data['page_title'] = "Pending Withdraw Request";
        $data['log'] = WithdrawLog::whereStatus(1)->orderBy('id','desc')->get();
        return view('dashboard.withdraw-request-all', $data);
    }
    public function withdrawRefund()
    {
        $data['page_title'] = "Refund Withdraw Request";
        $data['log'] = WithdrawLog::whereStatus(3)->orderBy('id','desc')->get();
        return view('dashboard.withdraw-request-all', $data);
    }

    public function repeatHistory()
    {
        $data['page_title'] = "Investment Repeat History";
        $data['log'] = RepeatLog::orderBy('id','desc')->paginate(15);
        return view('dashboard.repeat-history', $data);
    }
    public function adminSupport()
    {
        $data['page_title'] = "All Support Ticket";
        $data['support'] = Support::orderBy('id','desc')->get();
        return view('dashboard.support-all', $data);
    }

    public function adminSupportPending()
    {
        $data['page_title'] = "Pending Support Ticket";
        $data['support'] = Support::whereIn('status', [1,3])->orderBy('id','desc')->get();
        return view('dashboard.support-pending', $data);
    }
    public function adminSupportMessage($id)
    {
        $data['page_title'] = "Support Message";
        $data['support'] = Support::whereTicket_number($id)->first();
        $data['message'] = SupportMessage::whereTicket_number($id)->orderBy('id','asc')->get();
        return view('dashboard.support-message', $data);
    }
    public function adminSupportMessageSubmit(Request $request)
    {
        $this->validate($request,[
            'message' => 'required',
            'support_id' => 'required'
        ]);
        $mm = Support::findOrFail($request->support_id);
        $mm->status = 2;
        $mm->save();
        $mess['support_id'] = $mm->id;
        $mess['ticket_number'] = $mm->ticket_number;
        $mess['message'] = $request->message;
        $mess['type'] = 2;
        SupportMessage::create($mess);
        session()->flash('message','Support Ticket Successfully Reply.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
    public function adminSupportClose(Request $request)
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
    public function userDetails($id)
    {
        $data['page_title'] = 'User Details';
        $data['user'] = User::find($id);
        $user = $data['user'];
        $data['total_repeat'] = RepeatLog::whereUser_id($user->id)->count();
        $data['total_repeat_amount'] = RepeatLog::whereUser_id($user->id)->sum('amount');
        $data['total_deposit'] = Deposit::whereUser_id($user->id)->whereStatus(1)->count();
        $data['total_deposit_amount'] = Deposit::whereUser_id($user->id)->whereStatus(1)->sum('amount');
        $data['total_withdraw'] = WithdrawLog::whereUser_id($user->id)->whereIn('status',[3,2])->count();
        $data['total_withdraw_amount'] = WithdrawLog::whereUser_id($user->id)->whereIn('status',[2])->sum('amount');
        $data['total_login'] = UserLogin::whereUser_id($user->id)->count();
        $data['last_login'] = UserLogin::whereUser_id($user->id)->orderBy('id','desc')->first();
        return view('dashboard.user-details',$data);
    }
    public function userDetailsUpdate(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $uss = User::findOrFail($request->user_id);

        $in = Input::except('_method','_token','user_id');
        $in['email_verify'] = $request->email_verify == 'on' ? '1' : '0';
        $in['phone_verify'] = $request->phone_verify == 'on' ? '1' : '0';
        $in['status'] = $request->status == 'on' ? '0' : '1';
        $uss ->fill($in)->save();

        session()->flash('message', 'User Details Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function userSendMail($id)
    {
        $data['page_title'] = 'User Details';
        $data['user'] = User::findOrFail($id);
        return view('dashboard.user-send-email',$data);
    }
    public function userSendMailSubmit(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required',
            'message' => 'required',
            'user_id' => 'required'
        ]);
        $user = User::findOrFail($request->user_id);
        $this->sendMail($user->email,$user->name,$request->subject,$request->message);
        session()->flash('message', 'Email Send Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function userMoney($id)
    {
        $data['page_title'] = 'User Balance Manage';
        $data['user'] = User::whereUsername($id)->first();
        return view('dashboard.user-money',$data);
    }
    public function userMoneySubmit(Request $request)
    {
        $this->validate($request,[
            'amount' => 'required',
            'reason' => 'required'
        ]);
        $basic = BasicSetting::first();
        $ac = $request->operation == 'on' ? '1' : '2';
        if ($ac == 1)
        {
            $user = User::findOrFail($request->user_id);
            $bal = $user;

            $cus = strtoupper(Str::random(20));
            $ul['user_id'] = $user->id;
            $ul['amount'] = $request->amount;
            $ul['charge'] = null;
            $ul['amount_type'] = 8;
            $ul['post_bal'] = $bal->balance + $request->amount;
            $ul['description'] = "Add $request->amount $basic->currency - For $request->reason";
            $ul['transaction_id'] = $cus;
            UserLog::create($ul);

            $bal->balance = $bal->balance + $request->amount;
            $bal->save();

            if ($basic->email_notify == 1){
                $text = "Add ".$request->amount." - ". $basic->currency ." For $request->reason. <br> Transaction ID Is : <b>#".$cus."</b>";
                $this->sendMail($bal->email,$bal->name,'Manual Add Balance.',$text);
            }
            if ($basic->phone_notify == 1){
                $text = "Add ".$request->amount." - ".$basic->currency ." For $request->reason. <br> Transaction ID Is : <b>#".$cus."</b>";
                $this->sendSms($bal->phone,$text);
            }

            session()->flash('message', 'User balance Added Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
            return redirect()->back();
        }else{
            $user = User::findOrFail($request->user_id);
            $bal = $user;

            $cus = strtoupper(Str::random(20));
            $ul['user_id'] = $user->id;
            $ul['amount'] = $request->amount;
            $ul['charge'] = null;
            $ul['amount_type'] = 9;
            $ul['post_bal'] = $bal->balance - $request->amount;
            $ul['description'] = "Subtract $request->amount $basic->currency - For $request->reason";
            $ul['transaction_id'] = $cus;
            UserLog::create($ul);

            $bal->balance = $bal->balance - $request->amount;
            $bal->save();

            if ($basic->email_notify == 1){
                $text = "Subtract ".$request->amount." - ". $basic->currency ." For $request->reason. <br> Transaction ID Is : <b>#".$cus."</b>";
                $this->sendMail($bal->email,$bal->name,'Manual Subtract Balance.',$text);
            }
            if ($basic->phone_notify == 1){
                $text = "Subtract ".$request->amount." - ".$basic->currency ." For $request->reason. <br> Transaction ID Is : <b>#".$cus."</b>";
                $this->sendSms($bal->phone,$text);
            }

            session()->flash('message', 'User Balance Subtract Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
            return redirect()->back();
        }

    }
    public function manageUser()
    {
        $data['page_title'] = "Manage User";
        $data['user'] = User::orderBy('id','desc')->paginate(15);
        return view('dashboard.user-manage',$data);
    }
    public function showBlockUser()
    {
        $data['page_title'] = 'All Blocked User';
        $data['user'] = User::whereStatus(1)->paginate(15);
        return view('dashboard.user-manage',$data);
    }
    public function allVerifyUser()
    {
        $data['page_title'] = 'All Verified User';
        $data['user'] = User::whereStatus(0)->whereEmail_verify(1)->wherePhone_verify(1)->orderBy('id','desc')->paginate(15);
        return view('dashboard.user-manage',$data);
    }
    public function phoneUnVerifyUser()
    {
        $data['page_title'] = 'Phone UnVerified User';
        $data['user'] = User::wherePhone_verify(0)->orderBy('id','desc')->paginate(15);
        return view('dashboard.user-manage',$data);
    }
    public function emailUnVerifyUser()
    {
        $data['page_title'] = 'Email UnVerified User';
        $data['user'] = User::whereEmail_verify(0)->orderBy('id','desc')->paginate(15);
        return view('dashboard.user-manage',$data);
    }
    public function blockUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = 1;
        $user->save();
        session()->flash('message', 'User Successfully Blocked');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function unblockUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = 0;
        $user->save();
        session()->flash('message', 'User Successfully Unblocked');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function userDepositAll($id)
    {
        $data['user'] = User::whereUsername($id)->first();
        $data['page_title'] = $data['user']->username.' - Deposit Log';
        $data['deposit'] = Deposit::whereUser_id($data['user']->id)->orderBy('id','desc')->get();
        return view('dashboard.user-deposit-log',$data);
    }
    public function userWithdrawAll($id)
    {
        $data['user'] = User::whereUsername($id)->first();
        $data['page_title'] = $data['user']->username.' - Withdraw Log';
        $data['log'] = WithdrawLog::whereUser_id($data['user']->id)->orderBy('id','desc')->get();
        return view('dashboard.user-withdraw-log',$data);
    }
    public function userLogInAll($id)
    {
        $data['user'] = User::whereUsername($id)->first();
        $data['page_title'] = $data['user']->username.' - Login Details';
        $data['log'] = UserLogin::whereUser_id($data['user']->id)->orderBy('id','desc')->get();
        return view('dashboard.user-login-log',$data);
    }

    public function userRepeatAll($id)
    {
        $data['user'] = User::whereUsername($id)->first();
        $data['page_title'] = $data['user']->username.' - All Repeat';
        $data['log'] = RepeatLog::whereUser_id($data['user']->id)->orderBy('id','desc')->paginate(15);
        return view('dashboard.repeat-history',$data);
    }
    public function adminActivity()
    {
        $data['page_title'] = 'Transaction Log';
        $data['log'] = UserLog::orderBy('id','desc')->paginate(15);
        return view('dashboard.admin-activity',$data);
    }
	
	public function manageExchange()
    {
        $data['page_title'] = "Manage Exchange Request";
        $data['exchange'] = Exchange::orderBy('id','desc')->paginate(15);
        return view('dashboard.manage-exchange', $data);
    }
	
	 public function singleExchangeView($id)
    {
        $data['page_title'] = 'Exchange Details';
        $data['exchange'] = Exchange::findOrFail($id);
        return view('dashboard.single-exchange',$data);
    }
	
	 public function singleCashinView($id)
    {
        $data['page_title'] = 'Cash-in Details';
        $data['deposit'] = Deposit::findOrFail($id);
        return view('dashboard.cashin-view',$data);
    }
	
	public function confirmExchange(Request $request)
    {
        $basic = BasicSetting::first();
        $this->validate($request,[
            'id' => 'required'
        ]);
        $ee = Exchange::findOrFail($request->id);
        $parent = User::findOrFail($ee->user_id);		
        $ee->status = 1;
        $ee->save();

        if ($basic->email_notify == 1){
            $text = "$ee->amount $basic->currency Exchange Request Approved. Exchange Via ".$ee->method->name.". <br> Transaction ID Is : <b>#$ee->transaction_id</b>";
            $this->sendMail($parent->email,$parent->name,'Exchange Approved.',$text);
        }
        if ($basic->phone_notify == 1){
            $text = "$ee->amount $basic->currency Exchange Request Approved. Exchange Via ".$ee->method->name.". <br> Transaction ID Is : <b>#$ee->transaction_id</b>";
            $this->sendSms($parent->phone,$text);
        }

        session()->flash('message','Exchange Confirmed Successfully.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
	
    public function rejectExchange(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $ww = Exchange::findOrFail($request->id);
        $ww->status = 2;


        $basic = BasicSetting::first();
        $parent = User::whereId($ww->user_id)->first();

        $bal36 = $parent;
        /*$ul['user_id'] = $parent->id;
        $ul['amount'] = $ww->amount;
        $ul['charge'] = null;
        $ul['post_bal'] = $bal36->balance + $ww->amount;
        $ul['amount_type'] = 6;
        $ul['description'] = $ww->amount." ".$basic->currency." Withdraw Refunded.";
        $ul['transaction_id'] = $ww->transaction_id;
        UserLog::create($ul);

        $ul['user_id'] = $parent->id;
        $ul['amount'] = $ww->charge;
        $ul['charge'] = null;
        $ul['post_bal'] = $bal36->balance + $ww->amount + $ww->charge;
        $ul['amount_type'] = 10;
        $ul['description'] = $ww->charge." ".$basic->currency." Withdraw Charge Refunded.";
        $ul['transaction_id'] = $ww->transaction_id;
        UserLog::create($ul);*/
		
		if($ww->from_wallet == "USD")
		{
			$usd_amount = $ww->from_amount;
		}
		else
		{
			$usd_amount = $ww->to_amount;
		}
		
		if($ww->from_wallet == "BTC")
		{
			$btc_amount = $ww->from_amount;
		}
		else
		{
			$btc_amount = $ww->to_amount;
		}
		
		if($ww->from_wallet == "USD")
		{
			$parent->balance = $parent->balance + $ww->from_amount;
			$parent->bitcoin = $parent->bitcoin - $ww->to_amount;
		}
		else
		{
			$parent->balance = $parent->balance - $ww->from_amount;
			$parent->bitcoin = $parent->bitcoin + $ww->to_amount;
		}

        
        $parent->save();

        $ww->save();

        if ($basic->email_notify == 1){
            $text = "$ww->amount $basic->currency Exchange Refunded. <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
            $this->sendMail($parent->email,$parent->name,'Withdraw Refunded.',$text);
        }
        if ($basic->phone_notify == 1){
            $text = "$ww->amount $basic->currency Exchange Refunded.  <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
            $this->sendSms($parent->phone,$text);
        }


        session()->flash('message','Exchange Refund Successfully.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
	
	public function confirmCashin(Request $request)
    {
        $basic = BasicSetting::first();
        $this->validate($request,[
            'id' => 'required'
        ]);
        $ee = Deposit::findOrFail($request->id);
        $parent = User::findOrFail($ee->user_id);
        $ee->status = 1;
        $ee->save();

        if ($basic->email_notify == 1){
            $text = "$ee->amount $basic->currency Cash-in Request Approved. Cash-in Via ".$ee->method->name.". <br> Transaction ID Is : <b>#$ee->transaction_id</b>";
            $this->sendMail($parent->email,$parent->name,'Cash-in Approved.',$text);
        }
        if ($basic->phone_notify == 1){
            $text = "$ee->amount $basic->currency Cash-in Request Approved. Cash-in Via ".$ee->method->name.". <br> Transaction ID Is : <b>#$ee->transaction_id</b>";
            $this->sendSms($parent->phone,$text);
        }

        session()->flash('message','Cash-in Confirmed Successfully.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
	
    public function rejectCashin(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $ww = Deposit::findOrFail($request->id);
        $ww->status = 2;


        $basic = BasicSetting::first();
        $parent = User::whereId($ww->user_id)->first();

        $bal36 = $parent;
        $ul['user_id'] = $parent->id;
        $ul['amount'] = $ww->amount;
        $ul['charge'] = null;
        $ul['post_bal'] = $bal36->balance + $ww->amount;
        $ul['amount_type'] = 6;
        $ul['description'] = $ww->amount." ".$basic->currency." Cash-in Refunded.";
        $ul['transaction_id'] = $ww->transaction_id;
        UserLog::create($ul);

        $ul['user_id'] = $parent->id;
        $ul['amount'] = $ww->charge;
        $ul['charge'] = null;
        $ul['post_bal'] = $bal36->balance + $ww->amount + $ww->charge;
        $ul['amount_type'] = 10;
        $ul['description'] = $ww->charge." ".$basic->currency." Cash-in Charge Refunded.";
        $ul['transaction_id'] = $ww->transaction_id;
        UserLog::create($ul);
		
		$parent->balance = $parent->balance - $ww->net_amount;
        $parent->save();

        $ww->save();

        if ($basic->email_notify == 1){
            $text = "$ww->amount $basic->currency Cash-in Refunded. <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
            $this->sendMail($parent->email,$parent->name,'Cash-in Refunded.',$text);
        }
        if ($basic->phone_notify == 1){
            $text = "$ww->amount $basic->currency Cash-in Refunded.  <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
            $this->sendSms($parent->phone,$text);
        }


        session()->flash('message','Cash-in Refund Successfully.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
	
	public function manageCashout()
    {
        $data['page_title'] = "Manage Cashout Request";
        $data['cashout'] = CashoutRequest::orderBy('id','desc')->paginate(15);
        return view('dashboard.manage-cashout', $data);
    }
	
	public function singleCashoutView($id)
    {
        $data['page_title'] = 'Cash-out Details';
        $data['cashout'] = CashoutRequest::findOrFail($id);
        return view('dashboard.cashout-view',$data);
    }
	
	public function confirmCashout(Request $request)
    {
        $basic = BasicSetting::first();
        $this->validate($request,[
            'id' => 'required'
        ]);
        $ee = CashoutRequest::findOrFail($request->id);
        $parent = User::findOrFail($ee->user_id);
		$recipient = User::select('*')->where('wallet_address', $ee->to_wallet_address)->first();
		//$recipient = User::findOrFail($ee->to_wallet_address);		
        $ee->status = 1;
        
		
		$parent_bitcoin = $parent->bitcoin;
		$parent_btc_balance = $parent_bitcoin - $ee->amount;
		$parent->bitcoin = $parent_btc_balance;
		$parent->save();
		
		$recipient_bitcoin = $recipient->bitcoin;		
		$recipient_btc_balance = $recipient_bitcoin + $ee->amount;
		$recipient->bitcoin = $recipient_btc_balance;
		$recipient->save();
		
		$ee->save();

        if($basic->email_notify == 1)
		{
            $parent_text = "$ee->amount $basic->bitcoin_currency Cash-out Request Approved. <br> Transaction ID Is : <b>#$ee->transaction_id</b>";
            $this->sendMail($parent->email,$parent->name,'Cash-out Approved.', $parent_text);
			
			/*$recipient_text = "$ee->amount $basic->bitcoin_currency Cash-in Request Approved. Cash-in Via ".$ee->method->name.". <br> Transaction ID Is : <b>#$ee->transaction_id</b>";
            $this->sendMail($parent->email,$parent->name,'Cash-in Approved.',$text);*/
			
        }
        if ($basic->phone_notify == 1)
		{
            $text = "$ee->amount $basic->bitcoin_currency Cash-out Request Approved. <br> Transaction ID Is : <b>#$ee->transaction_id</b>";
            $this->sendSms($parent->phone,$text);
        }

        session()->flash('message','Cash-out Confirmed Successfully.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
	
    public function rejectCashout(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $ww = CashoutRequest::findOrFail($request->id);
        $ww->status = 2;


        $basic = BasicSetting::first();
        $parent = User::whereId($ww->user_id)->first();

        /*$bal36 = $parent;
        $ul['user_id'] = $parent->id;
        $ul['amount'] = $ww->amount;
        $ul['charge'] = null;
        $ul['post_bal'] = $bal36->balance + $ww->amount;
        $ul['amount_type'] = 6;
        $ul['description'] = $ww->amount." ".$basic->currency." Cash-in Refunded.";
        $ul['transaction_id'] = $ww->transaction_id;
        UserLog::create($ul);

        $ul['user_id'] = $parent->id;
        $ul['amount'] = $ww->charge;
        $ul['charge'] = null;
        $ul['post_bal'] = $bal36->balance + $ww->amount + $ww->charge;
        $ul['amount_type'] = 10;
        $ul['description'] = $ww->charge." ".$basic->currency." Cash-in Charge Refunded.";
        $ul['transaction_id'] = $ww->transaction_id;
        UserLog::create($ul);*/
		
		/*$parent->balance = $parent->balance - $ww->net_amount;
        $parent->save();*/

        $ww->save();

        if ($basic->email_notify == 1){
            $text = "$ww->amount $basic->currency Cash-out Rejected. <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
            $this->sendMail($parent->email,$parent->name,'Cash-out Rejected.',$text);
        }
        if ($basic->phone_notify == 1){
            $text = "$ww->amount $basic->currency Cash-out Rejected.  <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
            $this->sendSms($parent->phone,$text);
        }


        session()->flash('message','Cash-out Rejected Successfully.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
	
	public function manageIdentityProofs()
    {
        $data['page_title'] = "Manage Identity Proof";
        $data['idproofs'] = UserIdentityProof::orderBy('id','desc')->paginate(15);
        return view('dashboard.manage-proofs', $data);
    }
	
	public function singleIdentityVerify($id)
    {
        $data['page_title'] = 'Identity Verify';
        $data['idproof'] = UserIdentityProof::findOrFail($id);
        return view('dashboard.identity-verify',$data);
    }
	
	public function confirmIDverification(Request $request,$id)
    {
        $basic = BasicSetting::first();
        $this->validate($request,[
            'id' => 'required'
        ]);
        $ee = UserIdentityProof::findOrFail($id);
        $parent = User::findOrFail($ee->user_id);
        $ee->status = 1;
        $ee->save();
        $parent->identity_verify_status=1;
        $parent->save();

        if ($basic->email_notify == 1){
            $text = "Your given identity documents and informations verified by admin successfully.";
            $this->sendMail($parent->email,$parent->name,'Identity Verification Approved',$text);
        }
        if ($basic->phone_notify == 1){
            $text = "Your given identity documents and informations verified by admin successfully.";
            $this->sendSms($parent->phone,$text);
        }

        session()->flash('message','Identity Verification Confirmed Successfully.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
	
    public function rejectIDverification(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
		
		 $ee = UserIdentityProof::findOrFail($request->id);
         $ee->status = 2;
         $ee->save();
		
		 $parent = User::findOrFail($ee->user_id);
		
         $basic = BasicSetting::first();

        if ($basic->email_notify == 1){
            $text = "Your given identity documents and informations rejected by admin. please check your CT-pay dashboad.";
            $this->sendMail($parent->email,$parent->name,'Identity Verification Rejected',$text);
        }
		
        if ($basic->phone_notify == 1){
            $text = "Your given identity documents and informations rejected by admin. please check your CT-pay dashboad.";
            $this->sendSms($parent->phone,$text);
        }


        session()->flash('message','Identity Verification Rejected Successfully.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
     
    public function adminNews(){
        
        $data['page_title'] = 'News Section';
        
        $data['newsdata']=News::orderBy('updated_at','DESC')->get();
        return view('dashboard.news-section',$data);
    }
    
    public function adminAddNews(Request $request){
         
        $this->validate($request,[
            'headlines' => 'required',
            'story' => 'required',
            'image'=>'sometimes|required',
            'video'=>'sometimes|required',
            'otherlinks'=>'sometimes|required',
        ]);
        /*
         if ($this->fails()) {
            return Response::json(['success' => false, 'message' => 'Error while added news!!']);
        }
        */
        // $new = new News;
        // $news =$new->createNews($request->all());
        
        $news = new News;
        $news->headlines=$request->headlines;
        $news->story=$request->story;
      
         if ($request->hasFile('image')) {      
            $image = $request->file('image');
            $filename ="img_" .$image->getClientOriginalName();
            Image::make($image)->save('assets/images/news/' . $filename);
            $news->image = $filename;
            $news->save();
        }
        if ($request->hasFile('video')) {      
            $video = $request->file('video');
            $fileVideo ="video_". $video->getClientOriginalName();
            $location ="assets/images/news/".$fileVideo;
            $video->move($location);
          //  Image::make($video)->save('assets/images/news/' . $fileVideo);
            $news->video = $fileVideo;
            $news->save();
        }
        $news->otherlinks=$request->otherlinks;
        $news->save();
        
        return response()->json($news);
      
    }
    public function editNews($news_id)
    {
        $news = News::find($news_id);
        return response()->json($news);
    }
    public function updateNews(Request $request,$news_id)
    {
        
        $this->validate($request,[
            'headlines' => 'required',
            'story' => 'required',
            'image'=>'sometimes|required',
            'video'=>'sometimes|required',
            'otherlinks'=>'sometimes|required',
        ]);
        
//        if($this->fails()){
//          return Response::json(["success"=>false,"error"=>$this->errors()]);
//        }
  
       //print_r($request->all());
      
        
        $news = News::find($news_id);
        $news->headlines=$request->headlines;

        $news->story=$request->story;
      
         if ($request->hasFile('image')) {      
            $image = $request->file('image');
            $filename ="img_" .$image->getClientOriginalName();
            Image::make($image)->save('assets/images/news/' . $filename);
            $news->image = $filename;
            $news->save();
        }
        if ($request->hasFile('video')) {      
            $video = $request->file('video');
            $fileVideo ="video_". $video->getClientOriginalName();
            $location ="assets/images/news/".$fileVideo;
            $video->move($location);
         
            $news->video = $fileVideo;
            $news->save();
        }
    
        $news->otherlinks=$request->otherlinks;
        $news->save();
        return response()->json($news);
    }
    public function admindeleteNews($id){
        
        $news =  News::find($id);
        $news->delete();
        return redirect('admin/news-section');
        
        
    }
    public function adminViewNews($id){
        $news =  News::find($id);
        
        
    }
    public function setcfaValues(){
        
        $data['page_title'] = 'Set CFA Values Section';
        
        $data['cfavalues']= \App\UsdToCfas::orderBy('updated_at','DESC')->first();
        return view('dashboard.setcfa-values',$data);
        
    }
    
    public function submitCfaValues($id, Request $request){
        
        $data['cfavalues']= \App\UsdToCfas::where('usdcfaId',$id)->update([
            'usd_value'=>$request->usd_value,
            'cfa_value'=>$request->cfa_value
        ]);
     
        return redirect('admin/setcfa-values');
        
    }
    
    public function btcBuyReq(Request $request){
        $data['page_title'] = 'Bitcoin Buy Request';
          
        $data['btcrequest']= \App\BitCoinRequest::orderBy('btcreqid','desc')
                ->paginate(15);
      
        return view('dashboard.buy-bitcoin-request',$data);
        
    }
    public function singleBuyBtcView(Request $request, $id){
        
        $data['page_title'] = 'Btc Buy  Details';
        $data['deposit'] = \App\BitCoinRequest::findOrFail($id);
        return view('dashboard.buycoin-view',$data);
    }
    
    public function submitBuyBtcReq(Request $request,$id){
 
        $btcrequest= \App\BitCoinRequest::findOrFail($id)
                ->update(['status'=>1]);
        $btcreq = \App\BitCoinRequest::findOrFail($id);
       // echo $btcreq->cfa_amount;
        $admindata = \App\Admin::first();
              $admindata->balance=$admindata->balance+$btcreq->cfa_amount;
              $admindata->bitcoin=$admindata->bitcoin-$btcreq->btc_amount;

              $admindata->save();
    
       // echo $admindata;
        //die();
      

        $userbal = User::find($btcreq->user_id);
        $userbal->bitcoin=$userbal->bitcoin + $btcreq->btc_amount;
      
        $userbal->save();
        $tr = strtoupper(Str::random(20)); 
        $ul['user_id'] = $userbal->id;
        $ul['amount'] = $btcreq->btc_amount;
        $ul['charge'] = 0;
        $ul['amount_type'] = 8;
        $ul['post_bal'] = $userbal->bitcoin + $btcreq->btc_amount;
        $ul['description'] = $btcreq->btc_amount." BTC Deposited by buy conversion request Accepted";
        $ul['transaction_id'] = $tr;
        UserLog::create($ul);


        return redirect('admin/bitcoin-buy-request');
        
    }
    public function rejectBuyBtcReq(Request $request,$id){
        
        $btc= \App\BitCoinRequest::findOrFail($id)
                ->update(['status'=>2]);

        $btcreq = \App\BitCoinRequest::findOrFail($id);
        $userbal = User::findOrFail($btcreq->user_id);
        $userbal->balance=$userbal->balance + $btcreq->cfa_amount;
        $userbal->save();

         $tr = strtoupper(Str::random(20)); 
        $ul['user_id'] = $userbal->id;
        $ul['amount'] = $btcreq->cfa_amount;
        $ul['charge'] = 0;
        $ul['amount_type'] = 8;
        $ul['post_bal'] =   $userbal->balance + $btcreq->cfa_amount;
        $ul['description'] = $btcreq->cfa_amount." CFA Deposited  By conversion request rejected";
        $ul['transaction_id'] = $tr;
        UserLog::create($ul);

        return redirect('admin/bitcoin-buy-request');
        
    }
    
     //========== sell Btc functionality ==========//

    public function btcSellReq(Request $request){
        $data['page_title'] = 'Sell Bitcoin Request';
      
        $data['sellrequest']= \App\SellBTCReq::orderBy('buybitcoinId','desc')
                ->paginate(15);
        return view('dashboard.sell-bitcoin-request',$data);
        
    }
     public function singleSellBtcView(Request $request, $id){
        
        $data['page_title'] = 'Btc Sell Details';
        $data['deposit'] = \App\SellBTCReq::findOrFail($id);
        return view('dashboard.sellcoin-view',$data);
    }

 

    public function submitSellBtcReq(Request $request,$id){
        
        $sellrequest= \App\SellBTCReq::findOrFail($id)
                ->update(['status'=>1]);
        $sellreq = \App\SellBTCReq::findOrFail($id);
        echo $sellreq;
        //die();
        $admindata = \App\Admin::first();
              $admindata->balance=$admindata->balance-$sellreq->cfa_amount;
              $admindata->bitcoin=$admindata->bitcoin+$sellreq->btc_amount;
              $admindata->save();
        // echo $admindata;
        //die();
        $userbal = User::find($sellreq->user_id);
        $userbal->balance=$userbal->balance + $sellreq->cfa_amount;
      
        $userbal->save();

        $tr = strtoupper(Str::random(20)); 
        $ul['user_id'] = $userbal->id;
        $ul['amount'] = $sellreq->cfa_amount;
        $ul['charge'] = 0;
        $ul['amount_type'] = 8;
        $ul['post_bal'] = $userbal->balance + $sellreq->cfa_amount;
        $ul['description'] = $sellreq->cfa_amount." CFA Deposited by  Sale conversion request accepted";
        $ul['transaction_id'] = $tr;
        UserLog::create($ul);

       
        return redirect('admin/bitcoin-sell-request');
        
    }
    
    public function rejectSellBtcReq(Request $request,$id){
        
        $data['cfavalues']= \App\SellBTCReq::findOrFail($id)
                ->update(['status'=>2]);

        $sellreq = \App\SellBTCReq::findOrFail($id);
        $userbal = User::findOrFail($sellreq->user_id);
        $userbal->bitcoin=$userbal->bitcoin + $sellreq->btc_amount;
        $userbal->save();
        $tr = strtoupper(Str::random(20)); 
        $ul['user_id'] = $userbal->id;
        $ul['amount'] = $sellreq->btc_amount;
        $ul['charge'] = 0;
        $ul['amount_type'] = 8;
        $ul['post_bal'] = $userbal->bitcoin + $sellreq->btc_amount;
        $ul['description'] = $sellreq->btc_amount." BTC Sale request  for CFA rejected.";
        $ul['transaction_id'] = $tr;
        UserLog::create($ul);
        return redirect('admin/bitcoin-sell-request');
        
    }
    
    public function getCommissionChart(){
       $data['page_title'] = 'Commission Chart In USD';
       $data['getcommision'] = BasicSetting ::orderBy('updated_at','DESC')->first(); 
       
       return view('dashboard.commission-chart',$data);
        
    }
      public function submitCommissionChart(Request $request,$id){
          
         // print_r($request->all());
        //  die();
          $data['commsionchart']= BasicSetting::findOrFail($id)
                          ->update(['reference_bonus'=>$request->reference_bonus,
                          'reference_percent'=>$request->reference_percent,
                          'cashin_commission'=>$request->cashin_commission,
                          'cashout_commission'=>$request->cashout_commission,
                          'exchange_commission'=>$request->exchange_commission,
                          'withdraw_commission'=>$request->withdraw_commission,
                          'btc_buy_commision'=>$request->btc_buy_commision,
                          'btc_sell_commision'=>$request->btc_sell_commision
                          ]);
          return redirect('admin/commission-chart');
          
        
        
    }

}
