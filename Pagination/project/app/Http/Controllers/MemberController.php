<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class MemberController extends Controller
{
    public function index(Request $request){        
        $members = \DB::table("members")->paginate(5);
        return view('members',compact('members'))
                ->with('i', ($request->input('page', 1) - 1) * 5);        
    }
    public function destroy($id){
        \DB::table("members")->delete($id);
        return redirect()->back()->with('success','Member deleted');
    }
}