<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Patient;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Hash;


class ApiController extends Controller
{
    
public function register(Request $request) {
        
        $validator = Validator::make($request->all(), [
            
            
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required','numeric'],
          
         ]);
        
        if ($validator->fails()) {

             return response()->json(['response' =>"error",'message'=>$validator->errors()], 200);
        }


		$user = User::create([

                            'name'          =>  $request->name,
                            'email'         =>  $request->email,
                            'phone'          =>  $request->phone,
                            'password'      =>  Hash::make($request->password)

                			]);

     return response()->json(['response'=>'success',"error"=>0,'message'=>'Registered successfully!!'], 200);
    }
    
    

        public function login(Request $request)
        {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];
           

            if (Auth::attempt($credentials)) {
                          
                return response()->json(['response'=>'success',"error"=>0,'message'=>'Logged in successfully!!',"user"=>auth()->user()], 200);
            } 

            else{

                	return response()->json(['response'=>'error','message'=>'UnAuthorised'], 200);
            	}


        }


        public function userList() {

        $user= User::all();
        return response()->json(['response'=>'success','message'=>'data list',$user], 200);

		}


        public function updateUser(Request $request, $id) {
    
        $validator = Validator::make($request->all(), [
            
            
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required','numeric'],
          
         ]);
        
        if ($validator->fails()) {

             return response()->json(['response' =>"error",'message'=>$validator->errors()], 200);
        }
        
        $user=User::findOrFail($id);
 
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => ' with user id ' . $id . ' not found'
            ], 400);
        }
 
        
         $updated = User::where('id',$id)
        ->update([
                    'name' =>  $request->name,
                    'email'  =>  $request->email,
                    'phone'    =>  $request->phone,
                    'password'  =>  Hash::make($request->password)
            ]);


         if ($updated)
            return response()->json([
                'response' => 'successfully updated'
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'user could not be updated'
            ], 500);
        
    }


    public function destroyUser($id) {
    
            $user=User::findOrFail($id);

     
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'user with id ' . $id . ' not found'
                ], 400);
            }
     
            if ($user->delete()) {
                return response()->json([
                    'response' => 'successfully deleted'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'user could not be deleted'
                ], 500);
            }
        }


        

        // patient functionaliy

        public function registerPatient(Request $request) {
            
            $validator = Validator::make($request->all(), [
                
                
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:patients'],
                'password' => ['required', 'string', 'min:8'],
                'phone' => ['required','numeric'],
              
             ]);
            
            if ($validator->fails()) {

                 return response()->json(['response'=>"error",'message'=>$validator->errors()], 200);
            }


    		$Patient = Patient::create([

                                'name'          =>  $request->name,
                                'email'         =>  $request->email,
                                'phone'          =>  $request->phone,
                                'password'      =>  Hash::make($request->password)

                    			]);

         return response()->json(['response'=>'success','message'=>'Registered successfully!!','data'=>$Patient], 200);

        }


        public function loginPantient(Request $request) {
        
        $credentials = $request->only('email', 'password');
         
        if (Auth::guard('patient')->attempt($credentials)) {

        return response()->json(['response'=>"success",'message'=>'Logged in successfully!!','data'=>Auth::guard('patient')->user()], 200);
        } 

        else {

             return response()->json(['response'=>"error",'message'=>'UnAuthorised'], 200);
        }


    }

   
}
          

           







