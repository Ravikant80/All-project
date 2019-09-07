<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class AjaxAutocompleteController extends Controller
{
    public function index(){        
        return view('autocomplete');
    }
    public function searchResponse(Request $request){
        $query = $request->get('term','');
        $countries=\DB::table('countries');
        if($request->type=='countryname'){
            $countries->where('name','LIKE','%'.$query.'%');
        }
        if($request->type=='country_code'){
            $countries->where('sortname','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();        
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('name'=>$country->name,'sortname'=>$country->sortname);
        }
        if(count($data))
             return $data;
        else
            return ['name'=>'','sortname'=>''];
    }
}