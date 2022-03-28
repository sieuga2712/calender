<?php

namespace App\Http\Controllers;

use App\Models\detailEvents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Group;
use App\Models\memberGroup;

class CreateController extends Controller
{
    //
    public function indexPersonal(){
        return view('create');
    }
    public function indexGroup(){
        return view('createGroup');
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
    public function createGroup(Request $request){
            $group=new Group;
            $group->name=$request->namegroup;
            $group->save();
            $member=new memberGroup;
            $member->email=LoginController::userlogin();
            $member->idGroup=$group->id;
            $member->level=1;
            $member->save();
            return redirect("group");
    }
}