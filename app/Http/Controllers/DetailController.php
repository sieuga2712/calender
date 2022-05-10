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

    public static function showmember(){
        $member=DB::table('detail_users')->where('email',LoginController::userlogin())->first();
        return $member;
    }
    public static function inforMember($email){
        $member=DB::table("detail_users")->where("email",$email)->first();
        return $member;
    }
}
