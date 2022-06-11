<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applications;
use App\Models\memberGroup;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CreateController;
use Exception;

class GroupController extends Controller
{
    //
    public function Listindex()
    {
        return view('menuGroup');
    }
    public function index()
    {
        return view('detailGroup');
    }
    public function goGroup()
    {
        return view('detailGroup');
    }
    public function appGroup()
    {
        $id = $_GET["id"];
        $email = $_GET["email"];
        $app = new Applications;
        $app->idgroup = $id;
        $app->email = $email;
        $app->save();

        return view('MenuRight.Listgroup');
    }
    public function checkApplication()
    {
        $id = $_GET["id"];
        $check = $_GET["check"];
        $group = DB::table("applications")->where("id", $id)->first();
        $name = DB::table('groups')->where("id", $group->idgroup)->first()->name;
        if ($check == 1) {
           
            $member = $group->email;
            $membergroup = new memberGroup;
            $membergroup->email = $member;
            $membergroup->idGroup = $group->idgroup;
            $membergroup->level = 3;
            $membergroup->save();
            $email = $member;

           
            $idgroupmess = CreateController::CreateMess($email, "tham gia nhom", $name);
            CreateController::CreateGroupMess($group->idgroup, $idgroupmess);
        }
        else{
        $idgroupmess = CreateController::CreateMess($group->email, "bi tu choi tham gia nhom", $name);
        CreateController::CreatePerMess($group->email, $idgroupmess,-1);
        }
        DB::table("applications")->where("id", $id)->delete();;
    }
    public function changelevel()
    {
        $id = $_GET["idgroup"];
        $email = $_GET["email"];
        $lv = $_GET["level"];
        if ($lv != 1)
            DB::update('update member_groups set level =' . $lv . ' where email = "' . $email . '" and idGroup=' . $id);
        else
            return "false";
    }
    public function searchgroup()
    {
        $name = $_GET["group"];
        if ($name != '')
            $groups = DB::table('groups')->where('name', 'LIKE', "%$name%")->get();
        else
            $groups = DB::table('groups')->limit(30)->get();

        return view('ForAjax.listgroup', compact('groups'));
    }
    public static function getGroup()
    {
        $group = DB::table('groups')->get();
        return $group;
    }
    public static function getNameGroup($idgroup)
    {
        $name = DB::table('groups')->where('id', $idgroup)->first();
        try{
        return $name->name;
        }catch(Exception $e){
            //return redirect("home");
        }
    }
    public static function numberMember($idgroup)
    {
        $member = DB::table('member_Groups')->where('idGroup', $idgroup)->count();
        return $member;
    }
    public static function level1Group($idgroup)
    {
        $member = DB::table('member_Groups')->where('idGroup', $idgroup)->first();
        return $member->email;
    }
    public static function isMember($idgroup)
    {
        $ismem = DB::table('member_Groups')->where('idGroup', $idgroup)->where('email', LoginController::userlogin())->count();
        return $ismem;
    }
    public static function ListMember()
    {
        $id = $_GET["id"];
        $list = DB::table('member_Groups')->where("idGroup", $id)->get();
        return $list;
    }
    public static function checkMember()
    {
        $id = $_GET["id"];
        $list = DB::table('applications')->where("idgroup", $id)->get();
        return $list;
    }
    public static function limitMember($idgroup)
    {
        $limit = DB::table('groups')->where('id', $idgroup)->first();
        return $limit->limitMember;
    }
    public static function checked($idgroup)
    {
        $ismem = DB::table('Applications')->where('idGroup', $idgroup)->where('email', LoginController::userlogin())->count();
        return $ismem;
    }
    public static function checkMembers()
    {
        $idGroup = $_GET['id'];
        $mem = DB::table('member_Groups')->where('idGroup', $idGroup)->where('email', LoginController::userlogin())->first();
        return $mem;
    }
    public static function showMission()
    {
        $idgroup = $_GET['id'];
        $mem = DB::table('mission_groups')->where('idgroup', $idgroup)->orderBy('id', 'desc')->get();
        return $mem;
    }
    public static function showLimitMission($id)
    {
        $limit = DB::table('mission_members')->where('idMission', $id)->count();
        return $limit;
    }
    public static function Missionjoined($id)
    {
        $member = DB::table('mission_members')->where('idMission', $id)->where('email', LoginController::userlogin())->count();
        return $member;
    }
    public static function deletegroup(Request $request)
    {
        $id = $request->id;
        $pass = $request->pass;
        $g = DB::table('groups')->where('id', $id)->first();

        if ($pass == $g->passwordGroup) {
            DB::table('groups')->where('id', $id)->delete();
            DB::table('member_groups')->where('idGroup', $id)->delete();
            $mem = DB::table('mission_groups')->where('idgroup', $id)->get();
            foreach ($mem as $m) {
                DB::table('mission_members')->where('idMission', $m->id)->delete();
            }
            DB::table('mission_groups')->where('idgroup', $id)->delete();
            return redirect("home");
        }
        return "false";
    }
    public static function searchmission()
    {
        $name = $_GET["mission"];
        $idgroup = $_GET["idgroup"];
        if ($name != '')
            $mission = DB::table('mission_groups')->where('NameMission', 'LIKE', "%$name%")->where('idgroup', $idgroup)->orderBy('id', 'desc');
        else
            $mission = DB::table('mission_groups')->where('idgroup', $idgroup)->orderBy('id', 'desc');
        $listMission = $mission->get();

        return view('ForAjax.mission', compact('listMission', 'idgroup'));
    }
    public static function changeadmin(Request $request)
    {
        $id = $request->id;
        $member = $request->member;
        $mem = DB::table('member_Groups')->where('idGroup', $id)->where('email', $member);
        if ($mem->exists() == false) {
            return "false";
        } else {
            DB::table('member_groups')->where('idGroup', $id)->where("level", 1)->update(['level' => 2]);
          
            $mem->update(['level' => 1]);
            
            $email = $mem->first(  )->email;

            $name = DB::table('groups')->where("id", $id)->first()->name;
            $idgroupmess = CreateController::CreateMess($email,"", "thanh truong nhom", $name);
            CreateController::CreateGroupMess($id, $idgroupmess);
            return redirect("home");
        }
    }
    public static function changepass(Request $request)
    {
        $id = $request->id;
        $oldpass = $request->oldpass;
        $newpass = $request->newpass;
        $newpassre = $request->newpassre;
        $group = DB::table('groups')->where('id', $id)->first();
        if ($oldpass != $group->passwordGroup)
            return "oldpass";
        else {
            if ($newpass != $newpassre)
                return "newpass";
            else {
                $group->passwordGroup = $newpass;
                $group->save();
                return redirect("home");
            }
        }
    }
    public static function outgroup(Request $request)
    {
        $id = $request->id;

        $mem = DB::table('member_Groups')->where('idGroup', $id)->where('email', LoginController::userlogin())->first();
        if ($mem->level == 1) {
            echo '<script type ="text/JavaScript">';
            echo 'alert("admin khong duoc roi nhom")';
            echo '</script>';
            return redirect("home");
        } else {
            DB::table('member_groups')->where('idGroup', $id)->where('email', LoginController::userlogin())->delete();
            $listmission = DB::table('mission_groups')->where('idGroup', $id)->get();

            $email = LoginController::userlogin();

            $name = DB::table('groups')->where("id", $id)->first()->name;
            $idgroupmess = CreateController::CreateMess($email,"", "roi khoi nhom", $name);
            CreateController::CreateGroupMess($id, $idgroupmess);


            foreach ($listmission as $m)
                DB::table('mission_members')->where('idMission', $m->id)->where('email', LoginController::userlogin())->delete();
            return redirect("home");
        }
    }
    public static function kickmem(Request $request){
        $id = $request->mem;
        $group=$request->ig;
        $mem = DB::table('member_Groups')->where('idGroup', $id)->where('email', LoginController::userlogin())->first();
        if ($mem->level != 1) {
           
            return "false";
        } else {
            $email=DB::table('detail_users')->where('id',$id)->first()->email;
            DB::table('member_groups')->where('idGroup', $group)->where('email', $email)->delete();
            $listmission = DB::table('mission_groups')->where('idGroup', $id)->get();

           
            $name = DB::table('groups')->where("id", $id)->first()->name;
            $idgroupmess = CreateController::CreateMess($email,"", "roi khoi nhom", $name);
            CreateController::CreateGroupMess($id, $idgroupmess);


            foreach ($listmission as $m)
                DB::table('mission_members')->where('idMission', $m->id)->where('email', $email)->delete();
            return redirect("home");
        }
    }
}
