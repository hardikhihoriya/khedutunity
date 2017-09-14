<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class blanklandController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmininstrator');
    }
    
    public function index(){
        return view('admin.addblankland');
    }
}
