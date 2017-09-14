<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class dashboardController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmininstrator');
    }
    
    public function index() {
        $title = 'Batting App';
        return view('admin.dashboard' , compact('title'));
    }
}
