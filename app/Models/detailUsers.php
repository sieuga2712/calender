<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;

class detailUsers extends Model
{
    //
    protected $user=[
        'email',
        'name',
        'img',
        'birthday'

    ];

    public static function showmember(){
        $member=DB::table('detail_users')->where('email',LoginController::userlogin())->first();
        return $member;
    }
    public static function inforMember($email){
        $member=DB::table("detail_users")->where("email",$email)->get();
        return $member;
    }
}
