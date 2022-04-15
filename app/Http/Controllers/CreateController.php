<?php

namespace App\Http\Controllers;

use App\Models\detailEvents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Group;
use App\Models\memberGroup;
use App\Models\MissionGroups;
use App\Models\MissionMembers;
use Illuminate\Support\Facades\DB;

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
        $event->ChainOfid=1;
        $event->save();
        $event->ChainOfid='P'.$event->id;
        $event->save();
        //echo $event.$start.$end.$day;
        return redirect("home");

    }  
    public function createGroup(Request $request){
            $group=new Group;
            $group->name=$request->namegroup;
            $group->limitMember=$request->maxmember;
            $group->save();
            $member=new memberGroup;
            $member->email=LoginController::userlogin();
            $member->idGroup=$group->id;
            $member->level=1;
            $member->save();
            return redirect("group");
    }
    public function createGroupMission(Request $request){
        $name= $request->MissionName;
        $start= $request->startTime;
        $end=$request->endTime;
        $checklimit=$request->limitMember;
        $limit=$request->quanityMember;
        $day=$request->MissionDate;
        $group=$request->GroupMission;
        $note=$request->noteMission;
        
        $mission =new MissionGroups;
        $mission->idgroup=$group;
        $mission->NameMission=$name;
        $mission->StartTime=$start;
        $mission->EndTime=$end;
        $mission->dateMission=$day;
        $mission->ChainOfId=1;
        $mission->Note=$note;
        if($checklimit==true)
            $mission->limit=$limit;
        else
            $mission->limit=null;
        $mission->save();
        $mission->ChainOfId='G-'.$mission->id;
        $mission->save();
       
       
        return redirect("/gogroup?id=".$group);
    } 
    public function joinMission(){
        
        $mission=$_GET['idMission'];
        $missionDetail=DB::table('mission_groups')->where('id',$mission)->first();
        $count=DB::table('mission_members')->where('idMission',$mission)->where('email',LoginController::userlogin())->count();
        if($count==0){
        $mm=new MissionMembers;
        $mm->idMission=$mission;
        $mm->email=LoginController::userlogin();
        $mm->save();
        $event=new detailEvents;
        $email=LoginController::userlogin();
        
        
        $event->email=$email;
        $event->nameEvent=$missionDetail->NameMission;
        $event->timeStart=$missionDetail->StartTime;
        $event->timeEnd=$missionDetail->EndTime;
        $event->dateOfEvent=$missionDetail->dateMission;
        $event->group=$missionDetail->idgroup;
        $event->Note=$missionDetail->Note;
        $event->ChainOfid=1;
        $event->save();
        $event->ChainOfid='P-'.$mm->idMission;
        $event->save();
        }

        return redirect()->back();
    }
    public function quitMission(){
        $mission=$_GET['idMission'];
   
        
        DB::update('delete from Mission_Members where idMission ='.$mission.' && email = "'.LoginController::userlogin().'"');
      
        DB::update('delete from detail_events where ChainOfId ="P-'.$mission.'" && email = "'.LoginController::userlogin().'"');
        return redirect()->back();
    }
    public function deletePersonalEvent(){
        $list=$_GET['list'];
        foreach($list as $idevent){
            DB::update('delete from detail_events where id ='.$idevent );
        }
        return redirect("/detail");
    }
    public function deleteGroupMission(){
        $list=$_GET['list'];
        foreach($list as $idevent){
            DB::update('delete from mission_groups where id ='.$idevent );
            DB::update('delete from mission_members where idMission ='.$idevent );
            DB::update('delete from detail_events where id ='.$idevent );
        }
        return redirect()->back();
    }
    
}