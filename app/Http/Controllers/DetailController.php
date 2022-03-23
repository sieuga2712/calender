<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;


class DetailController extends Controller
{
    //

    public function index(){
        return view('detail');
    }

    public function showEvent(){
       
        
    }
}
