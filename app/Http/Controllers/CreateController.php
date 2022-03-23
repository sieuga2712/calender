<?php

namespace App\Http\Controllers;

use App\Models\detailEvents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
class CreateController extends Controller
{
    //
    public function index(){
        return view('create');
    }
    public function createPersonalEvent(Request $request){
        $name= $request->Eventname;
        $start= $request->startname;
        $end=$request->endname;
        $day=$request->Eventdate;
        $group=$request->group;
        $note=$request->note;
        $email=LoginController::userlogin();
        
        $event =new detailEvents;
        $event->email=$email;
        $event->nameEvent=$name;
        $event->timeStart=$start;
        $event->timeEnd=$end;
        $event->dateOfEvent=$day;
        $event->group=$group;
        $event->Note=$note;
        $event->save();
       
        //echo $event.$start.$end.$day;
        return redirect("home");

    }  
}