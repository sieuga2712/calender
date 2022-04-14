<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;
class MissionGroups extends Model
{
    //
    protected $MissionGroup=[
        
        'idgroup',
        'NameMission',
        'StartTime',
        'EndTime',
        'dateMission',
        'ChainOfId',
        'limit',
        'Note'
    ];
    public static function showMission(){
        $idgroup=$_GET['id'];
        $mem=DB::table('mission_groups')->where('idgroup',$idgroup)->get();
        return $mem;
    }
}
