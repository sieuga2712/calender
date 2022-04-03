<?php

namespace App\Http\Controllers;

use App\Models\detailUsers;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index(){
        return view('detailsUser');
    }
   public function changeInformation(Request $request){
        
        $name = $request->name;
        $birthday = $request->birthday;

        DB::update('update detail_users set name ="'.$name.'" where email = ?' ,[LoginController::userlogin()]);
        DB::update('update detail_users set birthday ="'  .$birthday. '" where email = ?' ,[LoginController::userlogin()]);
        
        return view('detailsUser');
   }
   
}
