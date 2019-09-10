<?php

namespace App\Http\Controllers;

use App\Admin;
use App\BasicSetting;
use App\BlockchainSetting;
use App\GeneralSetting;
use App\Countries;
use App\Industries;
use App\IdentityProof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class BasicSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function getChangePass()
    {
        $data['page_title'] = "Change Password";
        return view('admin.change-pass',$data);
    }
    public function postChangePass(Request $request)
    {
        $this->validate($request, [
            'current_password' =>'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try {
            $c_password = Auth::guard('admin')->user()->password;
            $c_id = Auth::guard('admin')->user()->id;

            $user = Admin::findOrFail($c_id);

            if(Hash::check($request->current_password, $c_password)){

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                session()->flash('message', 'Password Changes Successfully.');
                session()->flash('title','Success');
                Session::flash('type', 'success');
                return redirect()->back();
            }else{
                session()->flash('message', 'Current Password Not Match');
                Session::flash('type', 'warning');
                session()->flash('title','Opps');
                return redirect()->back();
            }

        } catch (\PDOException $e) {
            session()->flash('message', $e->getMessage());
            Session::flash('type', 'warning');
            session()->flash('title','Opps');
            return redirect()->back();
        }

    }
    public function getBasicSetting()
    {
        $data['page_title'] = "Basic Setting";
        return view('webControl.basic-setting',$data);
    }
    protected function putBasicSetting(Request $request,$id)
    {
        $basic = BasicSetting::findOrFail($id);
        $this->validate($request,[
           'title' => 'required',
        ]);
        $in = Input::except('_method','_token');
        $in['user_reg'] = $request->user_reg == 'on' ? '1' : '0';
        $in['email_verify'] = $request->email_verify == 'on' ? '1' : '0';
        $in['phone_verify'] = $request->phone_verify == 'on' ? '1' : '0';
        $in['withdraw_status'] = $request->withdraw_status == 'on' ? '1' : '0';
        $in['repeat_status'] = $request->repeat_status == 'on' ? '1' : '0';
        $in['email_notify'] = $request->email_notify == 'on' ? '1' : '0';
        $in['phone_notify'] = $request->phone_notify == 'on' ? '1' : '0';
        $in['google_recap'] = $request->google_recap == 'on' ? '1' : '0';
        $basic->fill($in)->save();
        session()->flash('message', 'Basic Setting Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
	
	public function getBlockchainSetting()
    {
        $data['page_title'] = "Blockchain Setting";
		$data['blockchain'] = BlockchainSetting::first();
        return view('dashboard.blockchain',$data);
    }
	
	 protected function putBlockchainSetting(Request $request,$id)
    {
        $blockchain = BlockchainSetting::findOrFail($id);
        $this->validate($request,[
           'app_id' => 'required',
		   'api_code' => 'required',
		   'main_password' => 'required'
        ]);
        $in = Input::except('_method','_token');
		
		$app_id 	= $request->app_id;
		$api_code 	= $request->api_code;
		$password 	= $request->main_password;
		$password2 	= $request->second_password;
		
        $in['app_id'] = $app_id;
        $in['api_code'] = $api_code;
        $in['main_password'] = $password;
        $in['second_password'] = $password2;
		
        $blockchain->fill($in)->save();
        session()->flash('message', 'Blockchain Setting Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
	
    public function getContact()
    {
        $data['page_title'] = "Contact Setting";
        return view('webControl.contact-setting',$data);
    }
    public function putContactSetting(Request $request, $id)
    {
        $basic = BasicSetting::findOrFail($id);
        $request->validate([
           'phone' => 'required',
           'email' => 'required',
           'address' => 'required',
        ]);
        $in = Input::except('_method','_token');
        $basic->fill($in)->save();
        session()->flash('message', 'Contact Setting Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function emailSetting()
    {
        $data['page_title'] = "Manage Email Setting";
        return view('webControl.email-setting',$data);
    }
    public function updateEmailSetting(Request $request)
    {
        $this->validate($request,[
            'from_email' => 'required',
            'email_body' => 'required'
        ]);
        $basic = BasicSetting::first();
        $basic->from_email = $request->from_email;
        $basic->email_body = $request->email_body;
        $basic->save();
        session()->flash('message', 'Email Setting Successfully Updated.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function smsSetting()
    {
        $data['page_title'] = "Manage SMS Setting";
        return view('webControl.sms-setting',$data);
    }
    public function updateSmsSetting(Request $request)
    {
        $basic = BasicSetting::first();
        $basic->smsapi = $request->smsapi;
        $basic->save();
        session()->flash('message', 'SMS Setting Successfully Updated.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
	
	public function getGovernmentProofs()
    {
        $data['page_title'] = "All Proofs";
		$data['identityproof'] = IdentityProof::get();
        return view('dashboard.identity-proofs',$data);
    }
	
	public function addGovernmentText()
    {
        $data['page_title'] = "New Proof";
        return view('dashboard.government', $data);
    }

    public function submitGovernmentText(Request $request)
    {
		$request->validate([
            'name' => 'required|unique:identity_proofs,name',
        ]);
		
		$lo['name'] 	= $request->name;
		$lo['status'] 	= $request->status;
		IdentityProof::create($lo);
		
        session()->flash('message','Proof Text Added Successfully.');
        session()->flash('title','Success');
        session()->flash('type','success');
        return redirect()->back();
    }
	
	public function updateGovernmentText(Request $request)
    {
        $data['page_title'] = "Proof Update";
		$data['identityproof'] = IdentityProof::findOrFail($request->id);
        return view('dashboard.proof-edit',$data);
    }
	
	public function updateSubmitGovernmentText(Request $request)
    {
        $basic = IdentityProof::findOrFail($request->id);
        $basic->name = $request->name;
		$basic->status = $request->status;
        $basic->save();
		
        session()->flash('message', 'Proof Text Successfully Updated.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
	
	public function getAllIndustries()
    {
        $data['page_title'] = "All Industries";
		$data['industries'] = Industries::get();
        return view('dashboard.industries',$data);
    }
	
	public function addIndustryText()
    {
        $data['page_title'] = "New Industry";
        return view('dashboard.industry-add', $data);
    }

    public function submitIndustryText(Request $request)
    {
		$request->validate([
            'name' => 'required|unique:industries,name',
        ]);
		
		$lo['name'] 	= $request->name;
		$lo['status'] 	= $request->status;
		Industries::create($lo);
		
        session()->flash('message','Industry Text Added Successfully.');
        session()->flash('title','Success');
        session()->flash('type','success');
        return redirect()->back();
    }
	
	public function editIndustryText(Request $request)
    {
        $data['page_title'] = "Industry Update";
		$data['industry'] = Industries::findOrFail($request->id);
        return view('dashboard.industry-edit',$data);
    }
	
	public function updateIndustryText(Request $request)
    {
        $basic = Industries::findOrFail($request->id);
        $basic->name = $request->name;
		$basic->status = $request->status;
        $basic->save();
		
        session()->flash('message', 'Industry Text Successfully Updated.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

}
