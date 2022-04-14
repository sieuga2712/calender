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
        'name',
        'limitMember'
    ];
    public static function getGroup(){
        $group=DB::table('groups')->get();
        return $group;
    }
    public static function numberMember($idgroup){
        $member=DB::table('member_Groups')->where('idGroup',$idgroup)->count();
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
    public static function ListMember(){
        $id=$_GET["id"];
        $list=DB::table('member_Groups')->where("idGroup",$id)->get();
        return $list;
    }
    public static function checkMember(){
        $id=$_GET["id"];
        $list=DB::table('applications')->where("idgroup",$id)->get();
        return $list;
    }
    public static function limitMember($idgroup){
        $limit=DB::table('groups')->where('id',$idgroup)->first();
        return $limit->limitMember;
    }
}
