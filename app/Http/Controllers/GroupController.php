<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    //
    public function Listindex(){
        return view('menuGroup');
    }
    public function index(){
        return view('detailGroup');
    }
   public function goGroup(){
       return view('detailGroup');
   }
}
