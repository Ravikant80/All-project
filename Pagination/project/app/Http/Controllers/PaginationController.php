<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pagination;

class PaginationController extends Controller
{
 	

 	public function getData(){

    $data = Pagination::paginate (10);

  
      // 	print_r($data);
    	 // die;
    
   
    return view('paginate', compact('data'));
   
	}
}