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
}
