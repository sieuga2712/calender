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
use DateTime;
use Hamcrest\Core\HasToString;
use Illuminate\Support\Facades\DB;

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
    {
        if ($request->cycle != "on") {
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
            $i = 1;
            if ($request->radio_chuky == "radio_chuky") {
                foreach ($_POST['listevck'] as $le) {
                    $name = $request->Eventname . "(" . $i . ")";
                    $i++;

                    $ev = $this->detachedStringCycle($le);
                    $start = $ev["start"];
                    $end = $ev["end"];
                    $date = new DateTime($request->datestart);
                    $dateend = new DateTime($request->dateend);

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
                            $event->ChainOfid = 'P' . $event->id;
                            $event->save();
                        }
                    }
                }
            } else {
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
                $event->ChainOfid = 'P' . $event->id;
                $event->save();
                }
            }
        }




        //return redirect("home");
        return view("detail");
    }
    public function createGroup(Request $request)
    {
        $group = new Group;
        $group->name = $request->namegroup;
        $group->limitMember = $request->maxmember;
        $group->save();
        $member = new memberGroup;
        $member->email = LoginController::userlogin();
        $member->idGroup = $group->id;
        $member->level = 1;
        $member->save();
        return redirect("group");
    }
    public function createGroupMission(Request $request)
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
    }
    public function joinMission()
    {

        $mission = $_GET['idMission'];
        $missionDetail = DB::table('mission_groups')->where('id', $mission)->first();
        $count = DB::table('mission_members')->where('idMission', $mission)->where('email', LoginController::userlogin())->count();
        if ($count == 0) {
            $mm = new MissionMembers;
            $mm->idMission = $mission;
            $mm->email = LoginController::userlogin();
            $mm->save();
            $event = new detailEvents;
            $email = LoginController::userlogin();


            $event->email = $email;
            $event->nameEvent = $missionDetail->NameMission;
            $event->timeStart = $missionDetail->StartTime;
            $event->timeEnd = $missionDetail->EndTime;
            $event->dateOfEvent = $missionDetail->dateMission;
            $event->group = $missionDetail->idgroup;
            $event->Note = $missionDetail->Note;
            $event->ChainOfid = 1;
            $event->save();
            $event->ChainOfid = 'G-' . $mm->idMission;
            $event->save();
        }

        return redirect()->back();
    }
    public function quitMission()
    {
        $mission = $_GET['idMission'];


        DB::update('delete from Mission_Members where idMission =' . $mission . ' && email = "' . LoginController::userlogin() . '"');

        DB::update('delete from detail_events where ChainOfId ="G-' . $mission . '" && email = "' . LoginController::userlogin() . '"');
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
        foreach ($list as $idevent) {
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
}
