<?php

namespace App\Http\Controllers;

use App\Models\detailEvents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Group;
use App\Models\Groupmessenge;
use App\Models\memberGroup;
use App\Models\MissionGroups;
use App\Models\MissionMembers;
use DateTime;
use Hamcrest\Core\HasToString;
use Illuminate\Support\Facades\DB;
use App\Models\longEvent;
use App\Models\Messenge;
use App\Models\Permessenge;

class CreateController extends Controller
{
    //
    public function indexPersonal()
    {
        return view('create');
    }
    public function indexGroup()
    {
        return view('createGroup');
    }
    public function createPersonalEvent(Request $request)
    {   $typeEvent= $request->typeEvent;

        
        if ($typeEvent=="trong ngay") {
            $name = $request->Eventname;
            $start = $request->startname;
            $end = $request->endname;
            $day = $request->Eventdate;
            $group = $request->group;
            $note = $request->note;
            $email = LoginController::userlogin();

            $event = new detailEvents;
            $event->email = $email;
            $event->nameEvent = $name;
            $event->timeStart = $start;
            $event->timeEnd = $end;
            $event->dateOfEvent = $day;
            $event->group = $group;
            $event->Note = $note;
            $event->ChainOfid = 1;
            $event->save();
            $event->ChainOfid = 'P' . $event->id;
            $event->save();
        } else {
            $longevent = new longEvent;
            $longevent->nameEvent = $request->Eventname;
            $longevent->email = LoginController::userlogin();
            $listevent = "";
            $i = 1;
            if ($typeEvent=="Chu Ky") {
                $longevent->TypeEvent = 1;
                $longevent->save();
                if (isset($_POST['listevck']))
                    foreach ($_POST['listevck'] as $le) {
                        $name = $request->Eventname . "(" . $i . ")";
                        $i++;

                        $ev = $this->detachedStringCycle($le);
                        $start = $ev["start"];
                        $end = $ev["end"];
                        $date = new DateTime($request->datestart);
                        $dateend = new DateTime($request->dateend);
                        $listevent = $listevent . $le . "@";
                        for ($date; $date <= $dateend; $date = $date->modify('+1 day')) {

                            if ($this->datetoweek($date) == $ev["weekday"]) {

                                $note = $request->note;
                                $day = $date;
                                $email = LoginController::userlogin();

                                $event = new detailEvents;
                                $event->email = $email;
                                $event->nameEvent = $name;
                                $event->timeStart = $start;
                                $event->timeEnd = $end;
                                $event->dateOfEvent = $day;

                                $event->Note = $note;
                                $event->ChainOfid = 1;
                                $event->save();
                                $event->ChainOfid = $longevent->id;
                                $event->save();
                            }
                        }
                    }
                $longevent->ListEvent = $listevent;
                $longevent->save();
            } else if($typeEvent=="khong Chu Ky"){
                
                $longevent->TypeEvent = 2;
                $longevent->nameEvent = $request->Eventname;
                $longevent->save();
              
                    foreach ($_POST['listevkck'] as $le) {
                        $lisytevent = $this->detachedStringUncycle($le);

                        $start = $lisytevent["start"];
                        $end = $lisytevent["end"];
                        $name = $request->Eventname . "(" . $i . ")";
                        $i++;



                        $note = $request->note;
                        $day = $lisytevent["date"];
                        $email = LoginController::userlogin();

                        $event = new detailEvents;
                        $event->email = $email;
                        $event->nameEvent = $name;
                        $event->timeStart = $start;
                        $event->timeEnd = $end;
                        $event->dateOfEvent = $day;

                        $event->Note = $note;
                        $event->ChainOfid = 1;
                        $event->save();
                        $event->ChainOfid =  $longevent->id;
                        $event->save();
                        $listevent = $listevent . $le . "@";
                    }
                $longevent->ListEvent = $listevent;
                $longevent->save();
            }
        }




        return redirect("detail");
        //return view("detail");
        
    }
    public function createGroup(Request $request)
    {
        $group = new Group;
        $group->name = $request->namegroup;
        $group->limitMember = $request->maxmember;
        $group->passwordGroup = $request->password;
        $group->save();
        $member = new memberGroup;
        $member->email = LoginController::userlogin();
        $member->idGroup = $group->id;
        $member->level = 1;
        $member->save();
        return redirect("group");
    }
    /*public function reateGroupMission(Request $request)
    {
        $name = $request->MissionName;
        $start = $request->startTime;
        $end = $request->endTime;
        $checklimit = $request->limitMember;
        $limit = $request->quanityMember;
        $day = $request->MissionDate;
        $group = $request->GroupMission;
        $note = $request->noteMission;

        $mission = new MissionGroups;
        $mission->idgroup = $group;
        $mission->NameMission = $name;
        $mission->StartTime = $start;
        $mission->EndTime = $end;
        $mission->dateMission = $day;
        $mission->ChainOfId = 1;
        $mission->Note = $note;
        if ($checklimit == true)
            $mission->limit = $limit;
        else
            $mission->limit = null;
        $mission->save();
        $mission->ChainOfId = 'G-' . $mission->id;
        $mission->save();


        return redirect("/gogroup?id=" . $group);
    }*/
    public function createGroupMission(Request $request)
    {
        $typeEvent= $request->typeEvent;

        $name = $request->Group_Mission_Name;
        $group = $request->GroupMission;
        $checklimit = $request->limitMember;
        $note = $request->note;
        $limit = $request->quanityMember;
        $event = new MissionGroups;
        $event->idgroup = $group;
        $event->NameMission = $name;
        $event->Note = $note;
        
        if ($checklimit == true)
            $event->limit = $limit;
        else
            $event->limit = null;
        if ($typeEvent=="trong ngay") {

            $start = $request->startname;
            $end = $request->endname;
            $day = $request->Missiondate;

            $event->StartTime = $start;
            $event->EndTime = $end;
            $event->dateMission = $day;
            $event->TypeOfMission = 0;
            $event->save();
        } else {

            $listmission = "";

            if ($typeEvent=="Chu Ky") {
                
                if (isset($_POST['listevck']))
                    foreach ($_POST['listevck'] as $le) {

                        $listmission = $listmission . $le . "@";
                    }
                $start = $request->datestart;
                $end = $request->dateend;


                $event->dateStart = $start;
                $event->dateEnd = $end;

                $event->TypeOfMission = 1;
                $event->ListCalen = $listmission;
                $event->save();
            } else {
                foreach ($_POST['listevkck'] as $le) {
                   echo $le;
                }
                
                if (isset($_POST['listevkck']))
                    foreach ($_POST['listevkck'] as $le) {
                        $listmission = $listmission . $le . "@";
                    }
               
                $event->TypeOfMission = 2;
                $event->ListCalen = $listmission;
                $event->save();
            }
        }
        
        $email = LoginController::userlogin();
        $namegroup = DB::table('groups')->where('id', $group)->first()->name;
        $idmess = $this->CreateMess($email, $namegroup, "thêm sự kiện", $name);
        $this->CreatePerMess("", $idmess, $group);
        $this->CreateGroupMess($group, $idmess);
        //return redirect("home");
        return redirect()->back();
    }
    public function joinMission()
    {

        $idmission = $_GET['idMission'];


        $mission = DB::table('mission_groups')->where('id', $idmission)->first();
        $count = DB::table('mission_members')->where('idMission', $idmission)->where('email', LoginController::userlogin())->exists();
        $name = $mission->NameMission;

        if ($count == false) {
            if ($mission->TypeOfMission == 0) {

                $name = $mission->NameMission;
                $start = $mission->StartTime;
                $end = $mission->EndTime;
                $day = $mission->dateMission;
                $group = $mission->idgroup;
                $note = $mission->Note;
                $email = LoginController::userlogin();

                $event = new detailEvents;
                $event->email = $email;
                $event->nameEvent = $name;
                $event->timeStart = $start;
                $event->timeEnd = $end;
                $event->dateOfEvent = $day;
                $event->group = $group;
                $event->Note = $note;
                $event->ChainOfid = 1;
                $event->save();
                $event->ChainOfid = 'G-' . $idmission;
                $event->save();
            } else {

                $longevent = new longEvent;
                $longevent->nameEvent = $mission->NameMission;
                $longevent->email = LoginController::userlogin();
                $listevent = "";
                $i = 1;
                if ($mission->TypeOfMission == 1) {

                    $longevent->TypeEvent = 1;
                    $longevent->save();

                    if ($mission->listCalen != "") {
                        foreach ($this->ChangeMissionList($mission->listCalen) as $le) {



                            $ev = $this->detachedStringCycle($le);
                            $start = $ev["start"];
                            $end = $ev["end"];
                            $date = new DateTime($mission->dateStart);
                            $dateend = new DateTime($mission->dateEnd);
                            $listevent = $listevent . $le . "@";
                            for ($date; $date <= $dateend; $date = $date->modify('+1 day')) {

                                if ($this->datetoweek($date) == $ev["weekday"]) {
                                    $name = $mission->NameMission . "(" . $i . ")";
                                    $i++;
                                    $note = $mission->Note;
                                    $day = $date;
                                    $group = $mission->idgroup;
                                    $email = LoginController::userlogin();

                                    $event = new detailEvents;
                                    $event->email = $email;
                                    $event->nameEvent = $name;
                                    $event->timeStart = $start;
                                    $event->timeEnd = $end;
                                    $event->dateOfEvent = $day;
                                    $event->group = $group;
                                    $event->Note = $note;
                                    $event->ChainOfid = 1;
                                    $event->save();
                                    $event->ChainOfid = "G-" . $idmission;
                                    $event->save();
                                }
                            }
                        }
                        $longevent->ListEvent = $listevent;
                        $longevent->save();
                    }
                } else {

                    $longevent->TypeEvent = 2;
                    $longevent->nameEvent = $mission->NameMission;

                    if ($mission->listCalen != "")
                        foreach ($this->ChangeMissionList($mission->listCalen) as $le) {

                            $lisytevent = $this->detachedStringUncycle($le);

                            $start = $lisytevent["start"];
                            $end = $lisytevent["end"];
                            $name = $mission->NameMission . "(" . $i . ")";
                            $i++;
                            $group = $mission->idgroup;


                            $note = $mission->Note;
                            $day = $lisytevent["date"];
                            $email = LoginController::userlogin();

                            $event = new detailEvents;
                            $event->email = $email;
                            $event->nameEvent = $name;
                            $event->timeStart = $start;
                            $event->timeEnd = $end;
                            $event->dateOfEvent = $day;
                            $event->group = $group;
                            $event->Note = $note;
                            $event->ChainOfid = 1;
                            $event->save();
                            $event->ChainOfid =  "G-" . $idmission;
                            $event->save();
                            $listevent = $listevent . $le . "@";
                        }


                    $longevent->ListEvent = $listevent;
                    $longevent->save();
                }
            }
        }
        $mm = new MissionMembers;
        $mm->idMission = $idmission;
        $mm->email = LoginController::userlogin();
        $mm->save();

        $email = LoginController::userlogin();
        $idgroupmess = $this->CreateMess($email, "", "tham gia sự kiện", $name);
        $this->CreateGroupMess($mission->idgroup, $idgroupmess);
        return redirect()->back();
    }
    public function quitMission()
    {
        $mission = $_GET['idMission'];


        DB::update('delete from Mission_Members where idMission =' . $mission . ' && email = "' . LoginController::userlogin() . '"');

        DB::update('delete from detail_events where ChainOfId ="G-' . $mission . '" && email = "' . LoginController::userlogin() . '"');


        $email = LoginController::userlogin();
        $name = DB::table('mission_groups')->where("id", $mission)->first()->NameMission;
        $idgroupmess = CreateController::CreateMess($email, "", "rời khỏi sự kiện", $name);
        CreateController::CreateGroupMess($name->idGroup, $idgroupmess);
        return redirect()->back();
    }
    public function deletePersonalEvent()
    {
        $list = $_GET['list'];
        foreach ($list as $idevent) {
            DB::update('delete from detail_events where id =' . $idevent);
        }
        return redirect("/detail");
    }
    public function deleteGroupMission()
    {
        $list = $_GET['list'];
        $email = LoginController::userlogin();
        foreach ($list as $idevent) {
            $name = DB::table('mission_groups')->where("id", $idevent)->first();




            $namegroup = DB::table('groups')->where('id', $name->idgroup)->first();
            $idmess =  CreateController::CreateMess($email, $namegroup->name, "xóa sự kiện", $name->NameMission);
            CreateController::CreatePerMess("", $idmess, $name->idgroup);
            CreateController::CreateGroupMess($name->idgroup, $idmess);

            DB::update('delete from mission_groups where id =' . $idevent);
            DB::update('delete from mission_members where idMission =' . $idevent);
            DB::update('delete from detail_events where ChainOfId ="G-' . $idevent . '"');
        }




        return redirect()->back();
    }

    public function detachedStringCycle($e)
    {
        $event = array();
        $event["start"] = "";
        $event["end"] = "";
        $event["weekday"] = "";



        if ($e[0] == '-') //khong co gio bat dau
        {
            if ($e[1] == ' ') { //khong co gio ket thuc
                $event["start"] = NULL;
                $event["end"] = NULL;
                $g = "";
                for ($i = 2; $i <= strlen($e); $i++) {
                    if ($i != strlen($e))
                        $g = $g . $e[$i];
                    else
                        $event['weekday'] = $g;
                }
            } else {
                $event["start"] = NULL;
                $flag = 1;
                $g = "";
                //co gio ket thuc
                for ($i = 1; $i <= strlen($e); $i++) {
                    if ($flag == 1) {
                        if ($e[$i] != ' ')
                            $g = $g . $e[$i];
                        else {
                            $event['end'] = $g;
                            $flag = 0;
                            $g = "";
                        }
                    } else {
                        if ($i != strlen($e)) {
                            if ($i != ' ')
                                $g = $g . $e[$i];
                        } else
                            $event['weekday'] = $g;
                    }
                }
            }
        } else {
            $flag = 2;
            $g = "";
            for ($i = 0; $i <= strlen($e); $i++) {

                if ($flag == 2) {
                    if ($e[$i] != '-')
                        $g = $g . $e[$i];
                    else {
                        $event['start'] = $g;
                        $flag = 1;
                        $g = "";
                    }
                } else if ($flag == 1) {
                    if ($e[$i] != ' ')
                        $g = $g . $e[$i];
                    else {
                        $event['end'] = $g;
                        $flag = 0;
                        $g = "";
                    }
                } else {
                    if ($i != strlen($e)) {
                        if ($e[$i] != ' ')
                            $g = $g . $e[$i];
                    } else
                        $event['weekday'] = $g;
                }
            }
        }



        return  $event;
    }
    public function detachedStringUncycle($e)
    {
        $event = array();
        $event["start"] = "";
        $event["end"] = "";
        $event["date"] = "";



        if ($e[0] == '-') //khong co gio bat dau
        {
            $g = "";
            if ($e[1] == ' ') { //khong co gio ket thuc
                $event["start"] = NULL;
                $event["end"] = NULL;
                for ($i = 2; $i <= strlen($e); $i++) {
                    if ($i != strlen($e))
                        $g = $g . $e[$i];
                    else
                        $event['date'] = $g;
                }
            } else {
                $event["start"] = NULL;
                $flag = 1;
                $g = "";
                //co gio ket thuc
                for ($i = 1; $i <= strlen($e); $i++) {
                    if ($flag == 1) {
                        if ($e[$i] != ' ')
                            $g = $g . $e[$i];
                        else {
                            $event['end'] = $g;
                            $flag = 0;
                            $g = "";
                        }
                    } else {
                        if ($i != strlen($e)) {
                            if ($i != ' ')
                                $g = $g . $e[$i];
                        } else
                            $event['date'] = $g;
                    }
                }
            }
        } else {
            $flag = 2;
            $g = "";
            for ($i = 0; $i <= strlen($e); $i++) {

                if ($flag == 2) {
                    if ($e[$i] != '-')
                        $g = $g . $e[$i];
                    else {
                        $event['start'] = $g;
                        $flag = 1;
                        $g = "";
                    }
                } else if ($flag == 1) {
                    if ($e[$i] != ' ')
                        $g = $g . $e[$i];
                    else {
                        $event['end'] = $g;
                        $flag = 0;
                        $g = "";
                    }
                } else {
                    if ($i != strlen($e)) {
                        if ($e[$i] != ' ')
                            $g = $g . $e[$i];
                    } else
                        $event['date'] = $g;
                }
            }
        }

        return  $event;
    }
    public function datetoweek($date)
    {
        $e = date('w', strtotime($date->format('Y-m-d')));
        $days = array('sun', 'mon', 'tue', 'web', 'thu', 'fri', 'sat');
        return $days[$e];
    }
    public function ChangeMissionList($s)
    {
        $list = array();
        $g = "";
        for ($i = 0; $i < strlen($s); $i++) {
            if ($s[$i] != "@")
                $g = $g . $s[$i];
            else {
                $list[] = $g;
                $g = "";
            }
        }
        return $list;
    }
    public static function CreateMess($suba, $ingroup, $action, $subb)
    {
        $mess = new Messenge;
        $mess->subjectA = $suba;
        $mess->ingroup = $ingroup;
        $mess->action = $action;
        $mess->subjectB = $subb;
        $mess->save();
        return $mess->id;
    }
    public static function CreatePerMess($email, $id, $idgroup)
    {
        if ($idgroup == -1) {
            $mess = new Permessenge;
            $mess->email = $email;
            $mess->idmess = $id;
            $mess->save();
        } else {
            $members = DB::table('member_groups')->where('idGroup', $idgroup)->get();
            foreach ($members as $member) {
                $mess = new Permessenge;
                $mess->email = $member->email;
                $mess->idmess = $id;
                $mess->save();
            }
        }
    }
    public static function CreateGroupMess($idgroup, $id)
    {
        $mess = new Groupmessenge;
        $mess->idgroup = $idgroup;
        $mess->idmess = $id;
        $mess->save();
    }
    public static function Sukiengan()
    {
        $email = LoginController::userlogin();
        $data = DB::table('detail_events')->where('email', $email)->get();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = date("Y/m/d");
        $t = new DateTime($today);
        if($data->count()==0)
        echo "không có sự kiện sắp diễn ra";
        else
        foreach ($data as $event) {

            $date = new DateTime($event->dateOfEvent);
            $g = $t->diff($date)->format('%R%a days');
            $e= $t->diff($date)->format('%d');  
            if ($g >= 0) {
                if ($g =0 && $g<=3) {
                    echo "sự kiện <span style='color:blue;'>" . $event->nameEvent . "</span> còn <span style='color:blue;'>" . $e . "</span> ngày nữa bắt đầu<br>";
                }
                else if($g==0)
                {
                    echo "sự kiện <span style='color:blue;'>" . $event->nameEvent . "</span> đang diễn ra<br> " ;
                }
            }
        }
    }
}
