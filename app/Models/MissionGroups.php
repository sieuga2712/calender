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
        'TypeOfMission',
        'StartTime',
        'EndTime',
        'dateMission',
        'dateStart',
        'dateEnd',
        'limit',
        'listCalen',
        'Note'
    ];
    
}
