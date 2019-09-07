<?php

namespace App\Http\Controllers;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ApiController extends Controller
{
 	public function create(Request $request){
 	$students= new Student;
 	$students->firstName=$request->firstName;
 	$students->lastName=$request->lastName;
 	$students->email=$request->email;
 	$students->password=$request->password;
 	$students->save();

    $response = [
            'success' => true,
            'data' => $students,
            'message' => 'student  add  successfully.'
        ];

    return response()->json($response, 200);

	}


	 public function allStudent()
   		 {
        $students = Student::all();
        //$data = $students->toArray();

        $response = [
            'success' => true,
            'data' => $students,
            'message' => 'students retrieved successfully.'
        ];

        return response()->json($response, 200);
    

}

 		public function show($id)
   		 {

        $students = Student::find($id);
       // $data = $students->toArray();

        if (empty($students)) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'student not found.'
            ];
            return response()->json($response, 200);
        }else{
        	$response = [
            'success' => true,
            'data' => $students,
            'message' => 'students retrieved successfully.'
        ];

        return response()->json($response, 200);
        }


        
   	 }


   	public function updateStudent(Request $request,$id)
    {
            $students = Student::find($id);
            $students->firstName=$request->firstName;
            $students->lastName=$request->lastName;
            $students->email=$request->email;
            $students->password=$request->password;
            $students->save();

             $response = [
            'success' => true,
            'data' => $students,
            'message' => 'student  update  successfully.'
        ];

        return response()->json($response, 200);

    }

    


    

    public function destroyStudent($id)
     {
    
        $student= Student::find($id);
         
        $student->delete();
    

        $response = [
            'success' => true,
            'data' => $student,
            'message' => 'student deleted successfully.'
        ];

        return response()->json($response, 200);
     }



    }