<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Coupon;
use Maatwebsite\Excel\Facades\Excel;

class CouponController extends Controller
{
      public function index()
    {
       $data['items']=Coupon::all();
        return view('coupon',$data);
    }

    public function import(Request $request)
    {
      if($request->file('imported-file'))
      {
                $path = $request->file('imported-file')->getRealPath();
                $data = Excel::load($path, function($reader) {
            })->get();

            if(!empty($data) && $data->count())
      {
        $data = $data->toArray();
        for($i=0;$i<count($data);$i++)
        {
          $dataImported[] = $data[$i];
        }
            }
      Coupon::insert($dataImported);
        }
        return back();
  }





  public function export(){
      $items = Coupon::all();
      Excel::create('coupon', function($excel) use($items) {
          $excel->sheet('ExportFile', function($sheet) use($items) {
              $sheet->fromArray($items);
          });
      })->export('xls');

    }
}
