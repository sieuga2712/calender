<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;

class memberGroup extends Model
{
    //
    protected $member=[
        'email',
        'idGroup',
        'level'
    ];
    public static function checkMember(){
        $idGroup=$_GET['id'];
        $mem=DB::table('member_Groups')->where('idGroup',$idGroup)->where('email',LoginController::userlogin())->get();
        return $mem;
    }
}
