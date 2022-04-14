<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;
class MissionMembers extends Model
{
    //
    protected $member_Mission=[
        'idMission',
        'Email'
    ];
    public static function showLimit($id){
        $limit=DB::table('mission_members')->where('idMission',$id)->count();
        return $limit;
    }
    public static function joined($id){
        $member=DB::table('mission_members')->where('idMission',$id)->where('email',LoginController::userlogin())->count();
        return $member;
    }
}
