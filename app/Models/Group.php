<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;


class Group extends Model
{
    //
    protected $group=[
        'name'
    ];
    public static function getGroup(){
        $group=DB::table('groups')->get();
        return $group;
    }
    public static function numberMember($idgroup){
        $member=DB::table('groups')->where('id',$idgroup)->count();
        return $member;
    }
    public static function level1Group($idgroup){
        $member=DB::table('member_Groups')->where('idGroup',$idgroup)->first();
        return $member->email;
    }
    public static function isMember($idgroup){
        $ismem=DB::table('member_Groups')->where('idGroup',$idgroup)->where('email',LoginController::userlogin())->count();
        return $ismem;
    }
}
