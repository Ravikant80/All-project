<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminController extends Controller {

    public function __construct() {

        $this->middleware('auth:admin');
    }

    public function index() {
        $data['page_title'] = 'Admin Dashboard';
        return view('admin_dashboard.index', $data);
    }

 

    

}
