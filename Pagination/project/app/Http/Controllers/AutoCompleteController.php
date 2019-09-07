<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\User;
use App\Shop;
class AutoCompleteController extends Controller
{
 
    public function index()
    {
        return view('search');
    }
 
    public function search(Request $request)
    {
          $search = $request->get('term');
      
          $result = Shop::where('name', 'LIKE', '%'. $search. '%')->get();
 
          return response()->json($result);
            
    } 
}