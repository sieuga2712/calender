<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;


class detailEvents extends Model
{
    //
    protected $event=[
        'id',
        'email',
        'nameEvent',
        'timeStart',
        'timeEnd',
        'dateOfEvent',
        'ChainOfId',
        'group',
        'Note'
    ];
    public static function getEvent(){
        $event=DB::table('detail_events')->where('email',LoginController::userlogin())->limit(10)->get();
        return $event;
    }
}
