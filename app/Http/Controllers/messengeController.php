<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class messengeController extends Controller
{
    //
    public static function messPerson($email){
        $mess=DB::table('permessenges')->join('messenges', 'permessenges.idmess', '=', 'messenges.id')->where('email',$email)->orderBy('messenges.created_at', 'desc')->limit(50)->get();
        
        return $mess;
    }
    public static function messGroup($group){
        $mess=DB::table('groupmessenges')->join('messenges', 'groupmessenges.idmess', '=', 'messenges.id')->where('idGroup',$group)->orderBy('messenges.created_at', 'desc')->limit(50)->get();
        return $mess;
    }
}
