<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;

class Applications extends Model
{
    //
    protected $application=[
        'idgroup',
        'email'
    ];
    public static function checked($idgroup){
        $ismem=DB::table('Applications')->where('idGroup',$idgroup)->where('email',LoginController::userlogin())->count();
        return $ismem;
    }
}
