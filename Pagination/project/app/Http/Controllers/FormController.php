<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Validation;
use validator;

class FormController extends Controller
{
    public function create()
{
    return view('create');
}
              
    public function store(Request $request)
{
        $validatedData = $request->validate([
            'item_name' => 'required|max:255',
            'sku_no' => 'required|alpha_num',
            'price' => 'required|numeric',
        ]);
        \App\Form::create($validatedData);

        return response()->json('Form is successfully validated and data has been saved');
}
public function validation()
{
    return view('validation');
}
  
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function formvaliStore(Request $request)
{
    $validation=new Validation;
     $validation->fname=$request->fname;
     $validation->email=$request->email;
     $validation->phone=$request->phone;
     $validation->textarea=$request->textarea;
     $validation->save();
    return response()->json(' data has been saved');

}


public function formValid()
{
    return view('formvlid');
}






}
