<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applications;
use App\Models\memberGroup;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;
class GroupController extends Controller
{
    //
    public function Listindex(){
        return view('menuGroup');
    }
    public function index(){
        return view('detailGroup');
    }
   public function goGroup(){
       return view('detailGroup');
   }
   public function appGroup(){
        $id=$_GET["id"];
        $email=$_GET["email"];
        $app= new Applications;
        $app->idgroup=$id;
        $app->email=$email;
        $app->save();

        return view('MenuRight.Listgroup');
   }
   public function checkApplication(){
    $id=$_GET["id"];
    $check=$_GET["check"];
    if($check==1){
        $group=DB::table("applications")->where("id",$id)->get();
        $member=$group[0]->email;
        $membergroup=new memberGroup;
        $membergroup->email=$member;
        $membergroup->idGroup=$group[0]->idgroup;
        $membergroup->level=3;
        $membergroup->save();        
    }
    DB::table("applications")->where("id",$id)->delete();;

   }
   public function changelevel(){
    $id=$_GET["idgroup"];
    $email=$_GET["email"];
    $lv=$_GET["level"];
    DB::update('update member_groups set level ='.$lv.' where email = "'.$email.'" and idGroup='.$id);
   }
   public function searchgroup(){
       $name=$_GET["group"];
       if($name!='')
       $groups=DB::table('groups')->where('name','LIKE',"%$name%")->get();
        else
        $groups=DB::table('groups')->limit(30)->get();
       
       return view('ForAjax.listgroup',compact('groups'));
   }
   public static function getGroup(){
    $group=DB::table('groups')->get();
    return $group;
}
public static function getNameGroup($idgroup){
    $name=DB::table('groups')->where('id',$idgroup)->first();
    return $name->name;
}
public static function numberMember($idgroup){
    $member=DB::table('member_Groups')->where('idGroup',$idgroup)->count();
    return $member;
}
public static function level1Group($idgroup){
    $member=DB::table('member_Groups')->where('idGroup',$idgroup)->first();
    return $member->email;
}
public static function isMember($idgroup){
    $ismem=DB::table('member_Groups')->where('idGroup',$idgroup)->where('email',LoginController::userlogin())->count();
    return $ismem;
}
public static function ListMember(){
    $id=$_GET["id"];
    $list=DB::table('member_Groups')->where("idGroup",$id)->get();
    return $list;
}
public static function checkMember(){
    $id=$_GET["id"];
    $list=DB::table('applications')->where("idgroup",$id)->get();
    return $list;
}
public static function limitMember($idgroup){
    $limit=DB::table('groups')->where('id',$idgroup)->first();
    return $limit->limitMember;
}
public static function checked($idgroup){
    $ismem=DB::table('Applications')->where('idGroup',$idgroup)->where('email',LoginController::userlogin())->count();
    return $ismem;
}
public static function checkMembers(){
    $idGroup=$_GET['id'];
    $mem=DB::table('member_Groups')->where('idGroup',$idGroup)->where('email',LoginController::userlogin())->get();
    return $mem;
}
public static function showMission(){
    $idgroup=$_GET['id'];
    $mem=DB::table('mission_groups')->where('idgroup',$idgroup)->get();
    return $mem;
}
public static function showLimitMission($id){
    $limit=DB::table('mission_members')->where('idMission',$id)->count();
    return $limit;
}
public static function Missionjoined($id){
    $member=DB::table('mission_members')->where('idMission',$id)->where('email',LoginController::userlogin())->count();
    return $member;
}
public static function deletegroup(Request $request){
    $id=$request->id;
    DB::table('groups')->where('id',$id)->delete();
    DB::table('member_groups')->where('idGroup',$id)->delete();
    $mem=DB::table('mission_groups')->where('idgroup',$id)->get();
    foreach($mem as $m){
        DB::table('mission_members')->where('idMission',$m->id)->delete();
    }
    DB::table('mission_groups')->where('idgroup',$id)->delete();
    
   
    return redirect("home");
}
}
