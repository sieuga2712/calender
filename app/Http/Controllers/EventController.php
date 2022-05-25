<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\detailEvents;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Group;
use App\Models\memberGroup;
use App\Models\MissionGroups;
use App\Models\MissionMembers;


class EventController extends Controller
{
    //
    public function loadmore()
    {
        $load = $_GET["load"];
        $events = DB::table('detail_events')->where('email', LoginController::userlogin())->orderBy('dateOfEvent', 'desc')->limit($load)->get();
        $limit = DB::table('detail_events')->where('email', LoginController::userlogin())->count();
        
        return view('ForAjax.event', compact('events', 'limit', 'load'));
    }
    //ham tao 50 event de test
    public function tao()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = date("Y-n-j");
        $chain = 0;
        for ($i = 0; $i < 50; $i++) {
            $event = new detailEvents;
            $event->email = LoginController::userlogin();
            $event->nameEvent = "event" . $i;
            $event->timeStart = Null;
            $event->timeEnd = Null;
            $event->dateOfEvent = $today;
            $event->group = Null;
            $event->Note = Null;
            $event->ChainOfid = 1;
            $event->save();
            if ($chain == 0)
                $chain = 'P' . $event->id;
            $event->ChainOfid = $chain;
            $event->save();
        }
    }
    public static function getEvent()
    {   
        $event = DB::table('detail_events')->where('email', LoginController::userlogin())->orderBy('dateOfEvent', 'desc')->limit(10)->get();
        return $event;
    }
    public static function UpdatePersonalEvent(Request $request)
    {
        echo $request->Update_Note;
        $event = DB::table('detail_events')->where('id', $request->Id_Update)
            ->update(
                [
                    'nameEvent' => $request->Update_Event_Name,
                    'timeStart' => $request->Update_Start_Time,
                    'timeEnd' => $request->Update_End_Time,
                    'dateOfEvent' => $request->Update_Event_Date,
                    'Note' => $request->Update_Note
                ]
            );



        return redirect("detail");
    }
    public static function searchevent(){
        $name=$_GET["event"];
        if($name!='')
        $event=DB::table('detail_events')->where('email', LoginController::userlogin())->where('nameEvent','LIKE',"%$name%")->orderBy('dateOfEvent', 'desc');
         else
         $event=DB::table('detail_events')->where('email', LoginController::userlogin())->limit(10);
         $events=$event->get();
        $load=$event->count();
        $limit=$event->count();
        return view('ForAjax.event',compact('events', 'limit', 'load'));
    }
}
