<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Authorization model for admin
* @Package: BullsAutoTaxi

* @Author: WYNOT Team

* @URL : https://wynotech.com/
 */
class Model_Authorize extends Model
{
	public function __construct()
    {
		$this->session = Session::instance();
		$this->userid=$this->session->get("userid");
		$this->mdate = commonfunction::getCurrentTimeStamp();
    }

    	public function login_validate($arr)
	{

		return Validation::factory($arr)

				->rule('email','not_empty',array(':value','Email'))
				->rule('email', 'email',array(':value','Email'))
				->rule('password','not_empty',array(':value','Password'));

	}


    	public function adminlogin_details($email,$password,$need_count=FALSE,$status=ACTIVE)
	{
		$loginIp = $_SERVER['REMOTE_ADDR'];
		$lastLogin = date("Y-m-d H:i:s");
		$update=DB::update(PEOPLE)->set(array("last_login"=>$lastLogin,"login_ip"=>$loginIp))->where('email','=',$email)->and_where('password','=',$password)->execute();
		//echo $password;exit;
		/*$query=DB::select()->from(PEOPLE)->where('email','=',$email)
					->and_where('password','=',$password)
					->where_open()
					->where('user_type','=','A')
					->or_where('user_type','=','S')
					->or_where('user_type','=','DA')
					->where_close()
					->and_where('status','=',ACTIVE)->limit(1)->execute()->as_array();*/
		$query=DB::select()->from(PEOPLE)->where('email','=',$email)
					->and_where('password','=',$password)
					->where_open()
					->where('user_type','=','A')
					->or_where('user_type','=','S')
					->or_where('user_type','=','DA')
					->or_where('user_type','=','SV')
					->or_where('user_type','=','AS')
					->or_where('user_type','=','RC')
					->where_close()
					->and_where('status','=',ACTIVE)->limit(1)->execute()->as_array();			
				if($need_count)
				{
					$result= count($query);
				}
				else
				{
					$result= $query;
				}

		return $result;
	}
	
	public function already_login_details($user_id){				
		$query=DB::select()->from("recharge_users_session")->where('user_id','=',$user_id)
					->and_where('status','=',1)->limit(1)->execute()->as_array();			
		$result= $query;
		return $result;
	}
	
	public function update_login_details($user_id, $type){				
		$loginIp = $_SERVER['REMOTE_ADDR'];
		$lastLogin = date("Y-m-d H:i:s");
		
		if($type == 1){
			$query=DB::select()->from("recharge_users_session")->where('user_id','=',$user_id)->limit(1)->execute()->as_array();	
			if(count($query) > 0){
				$update=DB::update("recharge_users_session")->set(array("logged_in"=>$lastLogin,"ip_address"=>$loginIp, "status"=>1))->where('user_id','=',$user_id)->execute();
			} else {
				$update   = DB::insert("recharge_users_session")
					->columns(array('user_id', 'ip_address', 'status', 'logged_in'))
					->values(array($user_id, $loginIp, 1, $lastLogin))
					->execute();
			}
		} else {
			$update=DB::update("recharge_users_session")->set(array("logged_out"=>$lastLogin, "status"=>0))->where('user_id','=',$user_id)->execute();
		}
		return $update;
	}

	public function companylogin_details($email,$password,$need_count=FALSE,$status=ACTIVE)
	{
		$query=DB::select('*',PEOPLE.'.id')->from(PEOPLE)
					->JOIN(COMPANY)->on(PEOPLE.'.company_id','=',COMPANY.'.cid')
					->JOIN(COMPANYINFO)->on(PEOPLE.'.company_id','=',COMPANYINFO.'.company_cid')
					->JOIN(PACKAGE_REPORT)->on(PEOPLE.'.company_id','=',PACKAGE_REPORT.'.upgrade_companyid')
					->where('email','=',$email)
					->where('password','=',$password)
					->where('user_type','=','C')
					->where('status','=','A')
					->order_by(PACKAGE_REPORT.'.upgrade_id','desc')
					->limit(1)
					->execute()
					->as_array();
					//print_r($query);
					//print_r($query);
				if($need_count)
				{
					$result= count($query);
				}
				else
				{
					$result= $query;
				}

		return $result;
	}

     	public function managerlogin_details($email,$password,$need_count=FALSE,$status=ACTIVE)
	{
		//echo $status;
		 $query=DB::select()->from(PEOPLE)
					->JOIN(COMPANY)->on(PEOPLE.'.company_id','=',COMPANY.'.cid')
					->where('email','=',$email)
					->where('password','=',$password)
					->where('user_type','=','M')
					->limit(1)
					->execute()
					->as_array();



				if($need_count)
				{
					$result= count($query);
				}
				else
				{
					$result= $query;
				}

		return $result;
		//print_r($result);
	}

	public function login_details($email,$password,$need_count=FALSE,$status=ACTIVE)
	{

		$query=DB::select()->from(PEOPLE)
				->where('email','=',$email)
				->and_where('password','=',$password)
				->and_where('user_type','=',ACTIVE)
				->limit(1)
				->execute()
				->as_array();

				if($need_count)
				{
					$result= count($query);
				}
				else
				{
					$result= $query;
				}

			return $result;
	}

	public static function forgotpassword_emailcheck($email)
	{
		$result=count(DB::select('email')
				->from(PEOPLE)
				->where('email','=',$email)
				->and_where('user_type','=',ADMIN)

                //->or_where('user_type','=',ADMIN)
				//->or_where('user_type','=',STOREADMIN)

				->execute()->as_array());
		return $result>0?TRUE:FALSE;
	}



	public static function forgotpassword_emailcompanycheck($email)
	{
		$result=count(DB::select('email')
				->from(PEOPLE)
				->where('email','=',$email)
				->and_where('user_type','=','C')

                //->or_where('user_type','=',ADMIN)
				//->or_where('user_type','=',STOREADMIN)

				->execute()->as_array());
		return $result>0?TRUE:FALSE;
	}

	public static function forgotpassword_emailmanagercheck($email)
	{
		$result=count(DB::select('email')
				->from(PEOPLE)
				->where('email','=',$email)
				->and_where('user_type','=','M')

                //->or_where('user_type','=',ADMIN)
				//->or_where('user_type','=',STOREADMIN)

				->execute()->as_array());
		return $result>0?TRUE:FALSE;
	}

    public function forgotpassword_validate($arr)
	{
		$validate=Validation::factory($arr)
				->rule('email','not_empty',array(':value','Email'))
				->rule('email','email_domain',array(':value','Email'))
				->rule('email','Model_Authorize::forgotpassword_emailcheck',array(':value','Email'));
		return $validate;
	}

    public function forgotpassword_companyvalidate($arr)
	{
		$validate=Validation::factory($arr)
				->rule('email','not_empty',array(':value','Email'))
				->rule('email','email_domain',array(':value','Email'))
				->rule('email','Model_Authorize::forgotpassword_emailcompanycheck',array(':value','Email'));
		return $validate;
	}

    public function forgotpassword_managervalidate($arr)
	{
		$validate=Validation::factory($arr)
				->rule('email','not_empty',array(':value','Email'))
				->rule('email','email_domain',array(':value','Email'))
				->rule('email','Model_Authorize::forgotpassword_emailmanagercheck',array(':value','Email'));
		return $validate;
	}

	public static function check_password($password,$userid)
	{
		$result=count(DB::select('password')
				->from(PEOPLE)
				->where('password','=',md5($password))
				->and_where('id','=',$userid)
				->execute()->as_array());
		return $result>0?TRUE:FALSE;
	}



	public function editprofile_validate($arr,$uid)
	{

		return Validation::factory($arr)

           		->rule('firstname', 'not_empty')
           		//->rule('firstname', 'alpha_dash')
			->rule('firstname', 'min_length', array(':value', '4'))
			->rule('firstname', 'max_length', array(':value', '30'))

            		->rule('lastname', 'not_empty')
            		//->rule('lastname', 'alpha_dash')
			//->rule('lastname', 'min_length', array(':value', '4'))
			//->rule('lastname', 'max_length', array(':value', '30'))

			//->rule('email', 'not_empty')
			->rule('email', 'email')
			//->rule('email', 'max_length', array(':value', '50'))
			//->rule('email', 'Model_Edit::checkemail', array(':value',$uid))

			->rule('phone', 'not_empty')
			//->rule('phone', 'numeric')
			->rule('phone', 'min_length', array(':value', '7'))
			->rule('phone', 'max_length', array(':value', '20'))
			//->rule('phone', 'phone', array(':value'))
			->rule('phone', 'contact_phone', array(':value'))
			->rule('phone', 'Model_Edit::checkphone', array(':value',$uid))


			->rule('address', 'not_empty')

			->rule('country', 'not_empty')

			->rule('state', 'not_empty')

			->rule('city', 'not_empty');

	}

	/** for passengers list **/
	public function editpassenger_validate($arr,$uid)
	{

		return Validation::factory($arr)

			->rule('name', 'not_empty')
			//->rule('name', 'alpha_dash')
			//->rule('name', 'min_length', array(':value', '4'))
			//->rule('name', 'max_length', array(':value', '30'))

			//->rule('lastname', 'not_empty')
			//->rule('lastname', 'alpha_dash')
			//->rule('lastname', 'min_length', array(':value', '4'))
			//->rule('lastname', 'max_length', array(':value', '30'))

			//->rule('email', 'not_empty')
			->rule('email', 'email')
			->rule('email', 'max_length', array(':value', '50'))
			->rule('email', 'Model_Edit::check_passengeremail', array(':value',$uid))

			->rule('phone', 'not_empty')
			//->rule('phone', 'numeric')
			->rule('phone','Model_Authorize::check_valid_phone_format',array(':value'))
			//->rule('phone', 'min_length', array(':value', '7'))
			//->rule('phone', 'max_length', array(':value', '20'))
			->rule('phone', 'phone', array(':value'))

			->rule('address', 'not_empty')
			->rule('office_address', 'not_empty');


	}

	public static function check_valid_phone_format($phone)
	{
		//only allowed the +91-188919992
		$plusSym = substr_count($phone, '+');
		$hypenSym = substr_count($phone, '-');
		if($plusSym > 1 || $hypenSym > 1)
		{
			return false;
		}
		else
		{
			$phoneArr = explode("-", $phone);
			if((strlen($phoneArr[0]) < 2 || strlen($phoneArr[0]) > 5) || (strlen($phoneArr[1]) < 8 ||  strlen($phoneArr[0]) > 14)) {
				return false;
			} else {
				return true;
			}
		}
	}

	public function changepassword_validate($arr,$id)
	{
		return Validation::factory($arr)

			->rule('oldpassword', 'not_empty')
			->rule('oldpassword','valid_password',array(':value','/^[A-Za-z0-9@#$%!^&*(){}?-_<>=+|~`\'".,:;[]+]*$/u'))
			->rule('oldpassword', 'max_length', array(':value', '16'))
			->rule('oldpassword', 'Model_Authorize::check_pass', array(':value',$id))

			->rule('password', 'not_empty')
			->rule('password','valid_password',array(':value','/^[A-Za-z0-9@#$%!^&*(){}?-_<>=+|~`\'".,:;[]+]*$/u'))
			->rule('password', 'max_length', array(':value', '16'))

			->rule('repassword', 'not_empty')
			->rule('repassword','valid_password',array(':value','/^[A-Za-z0-9@#$%!^&*(){}?-_<>=+|~`\'".,:;[]+]*$/u'))
			->rule('repassword',  'matches', array(':validation', 'password', 'repassword'))
			->rule('repassword', 'max_length', array(':value', '16'));

	}

	public function changepassword($password,$userid,$activity_user_id = 0)
	{
		$org_password = $password;
		$password = md5($password);
		$rs=DB::update(PEOPLE)->set(array("password"=>$password,"org_password"=>$org_password,"user_createdby"=>$activity_user_id))
				->where('id','=',$userid)
				->execute();
		if($rs>0){
			$query=DB::select('email','name','password')->from(PEOPLE)
					->where('id','=',$userid)
					->execute()->as_array();

			return $query;
		}else{
			return 0;
		}
	}


	public function select_users_exists($email,$status=ADMIN)
	{
		$query=DB::select()->from(PEOPLE)
							->where('email','=',$email)
							//->and_where('user_type','=',$status)
							->execute()
							->as_array();

			if(count($query) > 0)
			{
				return 1;
			}
			else
			{
				return 0;
			}
	}

	public function select_users_byemail($email)
	{
		$query=DB::select()->from(PEOPLE)
							->where('email','=',$email)
							->execute()->as_array();

		return $query;
	}

	public function select_user_details_by_idall($userid)
	{
		$query=DB::select()->from(PEOPLE)
							->where('id','=',$userid)->limit(1)->execute()->as_array();
		return $query;
	}

	public function count_all_user($type="")
	{
		$query=DB::select()->from(PEOPLE);
		if($type!="")
		{
			$result=$query->where('user_type','=',$type)->execute()->as_array();
		}
		else
		{
			$result=$query->execute()->as_array();
		}
		return count($result);
	}

	// Check Image Exist or Not while Updating Job Details
	public function check_userphoto($userid="")
	{
		$sql = "SELECT photo FROM ".PEOPLE." WHERE id ='$userid'";
		$result=Db::query(Database::SELECT, $sql)
			->execute()
			->as_array();

			if(count($result) > 0)
			{

				return $result[0]['photo'];

			}
	}

	public function edit_people($uid,$post)
	{
		if($post['email'] == '')
		{
			$email = 'null';

		}else{
			$email = $post['email'];
		}

			$result=DB::update(PEOPLE)->set(array('name'=>$post['firstname'],'address'=>$post['address'],'login_country'=>$post['country'],'login_state'=>$post['state'],'login_city'=>$post['city'],'lastname'=>$post['lastname'],'email'=>$email,'country_code'=>$post['telephone_code'],'phone'=>$post['phone']))
				->where('id','=',$uid)
				->execute();

		if($result)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	/** edit passengers details**/
	public function edit_passenger($uid,$post)
	{
		$country_code = '';
		$phone = $post['phone'];
		if(strpos($post['phone'],'-') !== false){
			$phoneArr = explode('-',$post['phone']);
			$country_code = $phoneArr[0];
			$phone = $phoneArr[1];
		}
		$result=DB::update(PASSENGERS)->set(array('name'=>$post['name'],'lastname'=>$post['lastname'],'address'=>$post['address'],'office_address'=>$post['office_address'],'email'=>$post['email'],'country_code'=>$country_code,'phone'=>$phone,'discount'=>$post['discount']))
			->where('id','=',$uid)
			->execute();

		if($result)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}


	//update user photo null
	public function update_user_photo($userid)
	{

		$sql_query = array('photo' => "");
		$result =  DB::update(PEOPLE)->set($sql_query)
			->where('id', '=' ,$userid)
			->execute();

		return 1;
	}
	public function fb_login_details($access_key)
	{
		$query=DB::select()->from(PEOPLE)
				->where('access_key','=',$access_key)
				->execute()
				->as_array();
		return $query;
	}

	public function login_details_byid($userid)
	{
		$query=DB::select()->from(PEOPLE)->where('id','=',$userid)
					->limit(1)
					->execute()
					->as_array();
			return $query;

	}

	/** get passenger id */
	public function login_details_by_passengerid($userid)
	{
		$query=DB::select()->from(PASSENGERS)->where('id','=',$userid)
					->limit(1)
					->execute()
					->as_array();
			return $query;

	}

	public function select_user_details_by_id($userid)
	{
		$query=DB::select()->from(PEOPLE)
							->where('id','=',$userid)
							->and_where('status','=',ACTIVE)->limit(1)->execute()->as_array();
		return $query;
	}

	public function select_alluser_details($id)
	{
		$query=DB::select()->from(PEOPLE)
							->where('id','!=',$id)
							//->and_where('status','=',ACTIVE)
							->execute()
							->as_array();
		return $query;
	}

	/**
	* Check inline textbox label not empty for javscript on focus and on blur
	**/
	public static function check_label_not_empty($fieldname,$value)
	{
		return ($fieldname == $value)?FALSE:TRUE;
	}

	public static function unique_email($email)
	{
		return ! DB::select(array(DB::expr('COUNT(email)'), 'total'))
					->from(PEOPLE)
					->where('email', '=', $email)
					->execute()
					->get('total');
	}

	public function user_list()
	{
	   $rs = DB::select()->from(PEOPLE)
	   			->where('user_type','!=','N')
	   			->where('user_type','!=','A')
	   			->where('status','!=','T')
				->order_by('created_date','desc')
				->execute()
				->as_array();
	   return $rs;
	}

	public function count_user_list()
	{
		 $rs = DB::select()->from(PEOPLE)
					->where('user_type','!=','A')
					->where('status','!=','P')
					->order_by('created_date','desc')
					->execute()
					->as_array();
		 return count($rs);
	}

	public function all_user_list($offset='', $val='')
	{
		$result = DB::select()->from(PEOPLE)
					->where('user_type','!=','A')
					->where('status','!=','P')
					->order_by('created_date','desc')
					->limit($val)
					->offset($offset)
					->execute()
					->as_array();

		  return $result;
	}
	public function validate_user_form($arr)
	{
		$arr['name'] = trim($arr['name']);
		$arr['email'] = trim($arr['email']);

		return Validation::factory($arr)
			->rule('name','not_empty')
			->rule('name', 'min_length', array(':value', '5'))
			->rule('name', 'min_length', array(':value', '32'))
			->rule('password', 'not_empty')
			->rule('password','min_length',array(':value','5'))
			->rule('file', 'Upload::type', array($files_value_array['photo'], array('jpg','jpeg', 'png', 'gif')))
			->rule('file', 'Upload::size', array($files_value_array['photo'],'2M'))
			->rule('email','not_empty')
			->rule('email','email')
			->rule('country_id','not_empty')
			->rule('paypal_account','email')
			->rule('username', 'not_empty')
			->rule('username', 'min_length', array(':value', '4'))
			->rule('username', 'max_length', array(':value', '30'));
	}

	public function add_users($validator,$post_value_array,$image_name,$activation_key)
	{
		$randomkey = Commonfunction::admin_random_user_password_generator();

		$email = $post_value_array['email'];
	    $status = isset($post_value_array['status'])?"A":"I";
		$rs   = DB::insert(USERS)
				->columns(array('firstname', 'lastname', 'email', 'username','paypal_account','photo','status','password','activation_code',
				'created_date','country_id'))
				->values(array($post_value_array['firstname'],$post_value_array['lastname'],
							   $post_value_array['email'], $post_value_array['username'],$post_value_array['paypal_account'],
							   $image_name,$status,md5($activation_key),$randomkey,$this->mdate,$post_value_array['country_id']))
				->execute();
		if($rs){
			$email = DB::select()->from(USERS)
				           ->where('email', '=', $email)
						    ->execute()
			               ->as_array();
			return $email;
			}
		else{

			if(count($email) == 0){
				return 2;
			}
				return 0;
		}
	}
	//Check Whether Email is Already Exist or Not
	public function check_email($email="")
	{
		$sql = "SELECT email FROM ".PEOPLE." WHERE email='$email' ";
		$result=Db::query(Database::SELECT, $sql)
			->execute()
			->as_array();

			if(count($result) > 0)
			{
				return 1;
			}
			else
			{
				return 0;
			}
	}

	// To Check User Name is Already Available or Not
	public static function unique_username($name)
	{
		// Check if the username already exists in the database
		$sql = "SELECT name FROM ".PEOPLE." WHERE name='$name'";
		$result=Db::query(Database::SELECT, $sql)
			->execute()
			->as_array();

			if(count($result) > 0)
			{
				return 1;
			}
			else
			{
				return 0;
			}
	}
	// Check Whether the Eneterd Password is Correct While User Change Password
	public static function check_pass($pass="",$userid="")
	{
		$result = DB::select()->from(PEOPLE)
		->where('id', '=', $userid)
		->execute()
		->as_array();
		$pass=md5($pass);
		$password = (count($result) > 0) ? $result[0]["password"] : '';
		//print_r($result);exit;
		if($password == $pass){
			return true;
		} else {
			return false;
		}
	}
   public function check_account_exist($userid){

		$result=DB::select()->from(SOCIAL_MEDIA_ACCOUNTS)
				->where("user_id","=",$userid)
				->where("fb_user_id","!=",'')
				->or_where("twitter_user_id","!=",'')
				->or_where("linkedin_user_id","!=",'')
				->execute()
				->as_array();

		return $result;

   }

	//check detail exist in database
	public static function check_id_exist($id,$ppl_fav_id)
	{
		// Check if the username already exists in the database
		$sql = "SELECT * FROM ".PEOPLE_FAVORITES." WHERE id='$id' AND people_favorites_id='$ppl_fav_id' ";
		$result=Db::query(Database::SELECT, $sql)
			->execute()
			->as_array();

			if(count($result) > 0)
			{
				return 1;
			}
			else
			{
				return 0;
			}
	}

	public function delete_people($current_uri)
	{
			//get username and email for sending mail to users
			$rs = DB::delete(PEOPLE)
						 ->where('id', '=', $current_uri)
						 ->execute();
			return $rs;
	}

	public function check_people_exist($id){

			$id = DB::select()->from(PEOPLE)
				           ->where('id', '=', $id)
						    ->execute()
			               ->as_array();
			return count($id);
	}

	public function activate_deactivate_people($chguserid,$status)
	{
            if($status=='A') { $update_status='I'; } else if($status=='I') { $update_status='A'; }

	        $rs=DB::update(PEOPLE)->set(array("status"=>$update_status))
					->where('id','=',$chguserid)
					->execute();

				if($rs)
				$update=1;
				else
				$update=0;

			return $update;
	}

	/** passenger delete function**/
	public function delete_passenger($current_uri)
	{
			$rs = DB::delete(PASSENGERS)
						 ->where('id', '=', $current_uri)
						 ->execute();
			return $rs;
	}

	/** passenger activate and deactivate **/
	public function activate_deactivate_passenger($chguserid,$status)
	{
            if($status=='A') { $update_status='I'; } else if($status=='I') { $update_status='A'; }

	        $rs=DB::update(PASSENGERS)->set(array("user_status"=>$update_status))
					->where('id','=',$chguserid)
					->execute();

				if($rs)
				$update=1;
				else
				$update=0;

			return $update;
	}

    	public function all_user_list_history($offset, $val)
	{
          $query = "select * from ". PEOPLE . " where   user_type!='A' and status='D'  order by created_date desc limit $offset,$val";
	      $result = Db::query(Database::SELECT, $query)
			        ->execute()
			        ->as_array();

	      return $result;
	}
    	public function count_user_list_history()
	{
	     $rs = DB::select()->from(PEOPLE)
	     			->where('status','=','D') //ACTIVE and status!='D'
				    ->execute()
				    ->as_array();

	     return count($rs);
	}

	/** passenger list **/
	public function all_passenger_list_history($search,$offset, $val)
	{
		$limitcond = '';
		$condition = '';
		if(isset($val) && $val!=''){
			$limitcond = " LIMIT $val";
		}

		if(isset($offset) && $offset!=''){
			$limitcond = " LIMIT $offset,$val";
		}
        if(isset($search['keyword']) && $search['keyword']!=''){
        	$keyword = trim(Html::chars($_REQUEST['keyword']));
        	$keyword = str_replace("%","!%",$keyword);
			$keyword = str_replace("_","!_",$keyword);
			if($keyword){
				$condition  .= " AND(name LIKE  '%$keyword%' ";
				$condition  .= " or phone LIKE  '%$keyword%' ";
				$condition .= " or email LIKE  '%$keyword%' escape '!' ) ";
			}
        }
        if(isset($search['status']) && $search['status']!=''){
        	$status = trim(Html::chars($_REQUEST['status']));
        	$condition .= ($status) ? " AND user_status = '$status'" : "";
        }
        if(isset($search['filter_company']) && $search['filter_company']!=''){
        	$filter_company = trim(Html::chars($_REQUEST['filter_company']));
        	$condition .= ($filter_company) ? " AND passenger_cid = '$filter_company'" : "";
        }
        if(isset($search['user_type']) && $search['user_type']!=''){
        	$user_type = trim(Html::chars($_REQUEST['user_type']));
			if($user_type != '') {
			if($user_type == 0) {
					$condition .= " AND loyality_level = '$user_type'";
				} else {
					$condition .= " AND loyality_level != 0";
				}
			}
        }


		$query = "select a.*,b.loyality_name,(SELECT name from passengers where id =c.referred_by) AS referrer_name,(SELECT phone from passengers where id =c.referred_by) AS referrer_phone from ". PASSENGERS . " as a left join ".LOYALITY_TYPE." as b on(a.loyality_level = b.id) left join passenger_referral as c on a.id = c.passenger_id where 1=1 $condition order by created_date desc $limitcond";
			$result = Db::query(Database::SELECT, $query)
						->execute()
						->as_array();
					//	echo Database::instance()->last_query;exit();

				return $result;
	}
    	public function count_passenger_list_history()
	{
		$rs = DB::select()->from(PASSENGERS)
				->order_by('created_date','desc')
				->execute()
				->as_array();
		return $rs;
	}

	public function passenger_list()
	{
		$rs = DB::select()->from(PASSENGERS)
				->order_by('created_date','desc')
				->execute()
				->as_array();
			return $rs;
	}

	/** for getting passenger listing search count **/
	public function count_passengersearch_list($keyword = "", $status = "",$company = "",$user_type = "")
	{
		$keyword = str_replace("%","!%",$keyword);
		$keyword = str_replace("_","!_",$keyword);

		//condition for status
		//======================
		$staus_where= ($status) ? " AND user_status = '$status'" : "";

		$user_type_where = '';
		if($user_type != '') {
			if($user_type == 0) {
				$user_type_where = " AND loyality_level = '$user_type'";
			} else {
				$user_type_where = " AND loyality_level != 0";
			}
		}

		//search result export
		//=====================
		$name_where="";

		if($keyword){
			$name_where  = " AND(name LIKE  '%$keyword%' ";
			$name_where .= " or email LIKE  '%$keyword%' escape '!' ) ";
		}

			$company_where= ($company) ? " AND passenger_cid = '$company'" : "";
			$query = " select a.*,b.loyality_name from ". PASSENGERS . " as a left join ".LOYALITY_TYPE." as b on(a.loyality_level = b.id) where 1=1 $staus_where $name_where $company_where $user_type_where order by created_date DESC";

	 		$results = Db::query(Database::SELECT, $query)
			   			 ->execute()
						 ->as_array();

				return $results;

	}



//===============================================================================================================

	/*
	public function select_all_peoplefavoritelist($id)
	{
		 $query = "SELECT ".PEOPLE_FAVORITES.".id,
				".PEOPLE_FAVORITES.".people_favorites_id,
				".PEOPLE_FAVORITES.".user_id,
				".PEOPLE_FAVORITES.".created_date,
				".PEOPLE.".name,".PEOPLE.".username,
				".PEOPLE.".location,".PEOPLE.".email,
				".PEOPLE.".industry,
				".PEOPLE.".smart_tags,
				".PEOPLE.".login_type,
				".PEOPLE.".photo
				FROM ".PEOPLE_FAVORITES." LEFT JOIN ".PEOPLE." ON ".PEOPLE.".id= ".PEOPLE_FAVORITES.".people_favorites_id
			    WHERE ".PEOPLE_FAVORITES.".user_id = '$id'
			    ORDER BY ".PEOPLE_FAVORITES.".created_date DESC ";

			$result=Db::query(Database::SELECT, $query)
				->execute()
				->as_array();
	  	return $result;
	}

	//select all places favorites list
	public function select_all_placefavoritelist($id)
	{
		 $query = "SELECT ".PLACE_FAVORITES.".id,
				".PLACE_FAVORITES.".user_id,
				".PLACE_FAVORITES.".created_date,
				".PLACES.".name,".PLACES.".address,
				".PLACES.".crossStreet,".PLACES.".latitude,
				".PLACES.".langitude,".PLACES.".distance,
				".PLACES.".postalCode,".PLACES.".phone,
				".PLACES.".city,".PLACES.".state,
				".PLACES.".country,".PLACES.".category_name,
				".PLACES.".icon,".PLACES.".user_count
				FROM ".PLACE_FAVORITES." LEFT JOIN ".PLACES." ON ".PLACES.".place_unique_id = ".PLACE_FAVORITES.".place_unique_id
			    WHERE ".PLACE_FAVORITES.".user_id ='$id' AND favourite_added = '".FAV_ADDED."' GROUP BY ".PLACE_FAVORITES.".id
			    ORDER BY ".PLACE_FAVORITES.".created_date DESC ";

			$result=Db::query(Database::SELECT, $query)
				->execute()
				->as_array();
			return $result;
	}

	public function get_store_admins()
	{
		$query=DB::select()->from(PEOPLE)
							->where('user_type','=',STOREADMIN)
							->and_where('status','=',ACTIVE)->execute()->as_array();
		return $query;
	}

	public function count_user_chat_list()
	{

		 $rs = DB::select()->from(PEOPLE_MESSAGES)
					->execute()
					->as_array();

		 return count($rs);
	}

	public function all_user_chat_list($offset, $val)
	{

		  $query = "select P1.name as sendername, P1.username as senderusername,P2.name as receivername, P2.username as receiverusername,pm.message,pm.sent_date,pm.id from ". PEOPLE_MESSAGES. " as pm left join ".PEOPLE."
		  as P1 on ( P1.id = pm.sender_id ) left join ".PEOPLE. " as P2 on ( P2.id = pm.receiver_id ) order by sent_date desc limit $offset,$val";


		  $result = Db::query(Database::SELECT, $query)
					->execute()
					->as_array();
		  return $result;
	}


	//remove people like
 	public function remove_favorite_people($usrid, $people_fav_id)
 	{
		$rs   = DB::delete(PEOPLE_FAVORITES)
				->where("user_id","=",$usrid)
				->where("people_favorites_id","=",$people_fav_id)
				->execute();

		return $rs;
	}

	//remove place like
 	public function remove_favorite_place($usrid, $place_fav_id)
 	{
		$rs   = DB::delete(PLACE_FAVORITES)
				->where("user_id","=",$usrid)
				->where("place_unique_id","=",$place_fav_id)
				->execute();

		return $rs;
	}
	public function delete_usermsg_action($id){

			//get username and email for sending mail to users
			$rs = DB::delete(PEOPLE_MESSAGES)
						 ->where('id', '=', $id)
						 ->execute();
			return $rs;
	}
	public function check_peoplefav_exist($id){

			$id = DB::select()->from(PEOPLE_FAVORITES)
				           ->where('user_id', '=', $id)
						    ->execute()
			               ->as_array();
			return count($id);
	}
	public function check_places_exist($id){

			$id = DB::select()->from(PLACES)
				           ->where('user_id', '=', $id)
						    ->execute()
			               ->as_array();

			return count($id);
	}
	public function check_placesfav_exist($id){

			$id = DB::select()->from(PLACE_FAVORITES)
				           ->where('user_id', '=', $id)
						    ->execute()
			               ->as_array();

			return count($id);
	}
	public function delete_fav_people($id){

			//get username and email for sending mail to users
			$rs = DB::delete(PEOPLE_FAVORITES)
						 ->where('id', '=', $id)
						 ->execute();
			return $rs;
	}

	public function check_sameplaces_added_user_details($place_id,$usrid)
	{
		 $query = "SELECT ".PLACES_CHECKINS.".id,
					".PLACES_CHECKINS.".place_unique_id,
					".PLACES_CHECKINS.".user_id,
					".PLACES_CHECKINS.".created_date,
					".PLACES_CHECKINS.".place_name,
					".PEOPLE.".id as pplId,
					".PEOPLE.".name,".PEOPLE.".username,
					".PEOPLE.".location,".PEOPLE.".email,
					".PEOPLE.".industry,
					".PEOPLE.".smart_tags,
					".PEOPLE.".login_type,
					".PEOPLE.".photo,
					".PEOPLE.".last_login,
					".PEOPLE.".login_type
					FROM ".PLACES_CHECKINS." LEFT JOIN ".PEOPLE." ON ".PEOPLE.".id= ".PLACES_CHECKINS.".user_id
					WHERE ".PLACES_CHECKINS.".place_unique_id = '$place_id' AND ".PLACES_CHECKINS.".user_id != '$usrid' ORDER BY places_checkins.created_date DESC ";

			$result =  Db::query(Database::SELECT, $query)
						->execute()
						->as_array();
			return $result;
	}

	public function all_favorites_people_list($offset,$rec,$id){


		 $query1 = "SELECT ".PEOPLE.".name FROM ".PEOPLE."
		 			 WHERE ".PEOPLE.".id = ".PEOPLE_FAVORITES.".user_id ";


		 $query2 = "SELECT ".PEOPLE.".username FROM ".PEOPLE."
		 			 WHERE ".PEOPLE.".id = ".PEOPLE_FAVORITES.".user_id ";


		 $query = "SELECT ".PEOPLE_FAVORITES.".id,
		 		 ($query1) as fav_added_by_name, ($query2) as fav_added_by_uname,
				".PEOPLE_FAVORITES.".people_favorites_id,
				".PEOPLE_FAVORITES.".user_id,
				".PEOPLE_FAVORITES.".created_date,
				".PEOPLE.".name,".PEOPLE.".username,
				".PEOPLE.".location,".PEOPLE.".email,
				".PEOPLE.".industry,
				".PEOPLE.".user_type,
				".PEOPLE.".login_type,
				".PEOPLE.".status,
				".PEOPLE.".smart_tags,
				".PEOPLE.".photo
				FROM ".PEOPLE_FAVORITES." LEFT JOIN ".PEOPLE." ON ".PEOPLE.".id= ".PEOPLE_FAVORITES.".people_favorites_id

			    ORDER BY ".PEOPLE_FAVORITES.".created_date DESC LIMIT $offset,$rec";

			$result=Db::query(Database::SELECT, $query)
				->execute()
				->as_array();

	  	return $result;

	}

	public function count_favorites_people_list(){


		 $query = "SELECT ".PEOPLE_FAVORITES.".id,
				".PEOPLE_FAVORITES.".people_favorites_id,
				".PEOPLE_FAVORITES.".user_id,
				".PEOPLE_FAVORITES.".created_date,
				".PEOPLE.".name,".PEOPLE.".username,
				".PEOPLE.".location,".PEOPLE.".email,
				".PEOPLE.".industry,
				".PEOPLE.".user_type,
				".PEOPLE.".login_type,
				".PEOPLE.".status,
				".PEOPLE.".smart_tags,
				".PEOPLE.".photo
				FROM ".PEOPLE_FAVORITES." LEFT JOIN ".PEOPLE." ON ".PEOPLE.".id= ".PEOPLE_FAVORITES.".people_favorites_id

			    ORDER BY ".PEOPLE_FAVORITES.".created_date DESC ";

			$result=Db::query(Database::SELECT, $query)
				->execute()
				->as_array();

	  	return count($result);
	}

	public function check_filter_existforuser($id=""){

		$result = DB::select()->from(PEOPLE_FILTERS)
			->where('user_id', '=', $id)
			->execute()
			->as_array();

		return count($result);
	}

	//GET ppl inbox msg
	//==================
	public function select_inboxmsg($rcv_id){

		$sql = "SELECT * FROM ".PEOPLE_MESSAGES." WHERE receiver_id='$rcv_id' order by id DESC";

		$result=Db::query(Database::SELECT, $sql)
			->execute()
			->as_array();

		return $result;

	}
	//check receiver id exist in database
	//======================================

	public function check_receiverid_exist($rcv_id){

		$sql = "SELECT * FROM ".PEOPLE_MESSAGES." WHERE receiver_id='$rcv_id' order by id DESC";

		$result=Db::query(Database::SELECT, $sql)
			->execute()
			->as_array();

		if(count($result) > 0){

			return 1;

		}else{

			return 0;
		}


	}

	//check sender id exist in database
	//======================================

	public function check_senderid_exist($sdr_id){

		$sql = "SELECT * FROM ".PEOPLE_MESSAGES." WHERE sender_id='$sdr_id' order by id DESC";

		$result=Db::query(Database::SELECT, $sql)
			->execute()
			->as_array();

		if(count($result) > 0){

			return 1;
		}else{

			return 0;
		}
	}

	//GET ppl conversation chat
	public function select_inboxconversation($sdr_id,$rcv_id){

		$sql = "SELECT * FROM ".PEOPLE_MESSAGES." WHERE sender_id in ($sdr_id,$rcv_id) and receiver_id in ($sdr_id,$rcv_id) order by id DESC";

		$result=Db::query(Database::SELECT, $sql)
			->execute()
			->as_array();
		return $result;

	}
   public function people_connect($usrid,$id){

		$rs   = DB::insert(PEOPLE_CONNECTION)
				->columns(array('user_id', 'people_connected_id','connection_status','connected_date'))
				->values(array($usrid,$id,PENDING_CONNECTION,$this->mdate))
				->execute();

		return $rs;
   }

	public function check_ppl_connected($user_id,$ppl_conid){

		$sql = "SELECT * FROM ".PEOPLE_CONNECTION." WHERE user_id in ($user_id,$ppl_conid) and people_connected_id in ($user_id,$ppl_conid) order by id DESC";

		$result=Db::query(Database::SELECT, $sql)
			->execute()
			->as_array();

		return $result;
	}

   public function confirm_ppl_connection($usrid,$id,$status=""){

   		if($status == PENDING_CONNECTION){
			$query = array("connection_status" => ACCEPTED_CONNECTION,"connected_date" => $this->mdate);

			$result =  DB::update(PEOPLE_CONNECTION)->set($query)
					->where('user_id','=',$usrid)
					->where('people_connected_id','=',$id)
					->execute();

		}
		if($status == DENIED_CONNECTION){

			//get username and email for sending mail to users
			$result = DB::delete(PEOPLE_CONNECTION)
						->where('user_id','=',$usrid)
						->where('people_connected_id','=',$id)
						 ->execute();

		}
		return $result;
   }

	public function get_allconnection_requestlist($id=""){

		 $query = "SELECT ".PEOPLE_CONNECTION.".id,
				".PEOPLE_CONNECTION.".people_connected_id,
				".PEOPLE_CONNECTION.".user_id,
				".PEOPLE_CONNECTION.".connected_date,
				".PEOPLE.".name,".PEOPLE.".username,
				".PEOPLE.".location,".PEOPLE.".email,
				".PEOPLE.".industry,
				".PEOPLE.".smart_tags,
				".PEOPLE.".login_type,
				".PEOPLE.".photo
				FROM ".PEOPLE_CONNECTION." LEFT JOIN ".PEOPLE." ON ".PEOPLE.".id= ".PEOPLE_CONNECTION.".user_id
			    WHERE ".PEOPLE_CONNECTION.".people_connected_id = '$id' AND ".PEOPLE_CONNECTION.".connection_status = '".PENDING_CONNECTION."'
			    ORDER BY ".PEOPLE_CONNECTION.".connected_date DESC ";

		$result =  Db::query(Database::SELECT, $query)
					->execute()
					->as_array();
		return $result;

	}

	public function get_smart_tags($userid,$index,$text)
	{
			  $rs = DB::select('smart_tags')->from(PEOPLE)->where('id','=',$userid)
				->order_by('name','ASC')
				->execute()
				->as_array();
				$smart_tags=$rs[0]['smart_tags'];


				$tags=explode(",",$smart_tags);
				$loop_count=count($tags);
				for($i=0;$i<$loop_count;$i++)
				{
						if($i==$index && $text==$tags[$i])
						{
							unset($tags[$i]);
						}
				}
				$update_smart_tags=implode(',',$tags);

					$rs=DB::update(PEOPLE)->set(array("smart_tags"=>$update_smart_tags))
					->where('id','=',$userid)
					->execute();
				if($rs)
				$update=1;
				else
				$update=0;
			return $update;
	}
    */


    public function userlogin_details($email,$password,$need_count=FALSE,$status=ACTIVE)
	{
		$loginIp = $_SERVER['REMOTE_ADDR'];
		$lastLogin = date("Y-m-d H:i:s");
		$update=DB::update(PEOPLE)->set(array("last_login"=>$lastLogin,"login_ip"=>$loginIp))->where('email','=',$email)->and_where('password','=',$password)->execute();
		//echo $password;exit;
		$query=DB::select()->from(PEOPLE)->where('email','=',$email)
					->and_where('password','=',$password)
					->where_open()
					->where('user_type','=','U')
					->or_where('user_type','=','E')
					->where_close()
					->and_where('status','=',ACTIVE)->limit(1)->execute()->as_array();
				if($need_count)
				{
					$result= count($query);
				}
				else
				{
					$result= $query;
				}

		return $result;
	}
}

