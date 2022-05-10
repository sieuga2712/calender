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
  
}
