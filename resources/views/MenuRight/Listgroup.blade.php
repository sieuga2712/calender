@php
$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
if($che==1)
$use=\App\Http\Controllers\Auth\loginController::userlogin();


@endphp

@if($che==1)
<div class="detail-event">

    <div class="filter-tool" style="background-color: red;">
        <button type="button" style="background-color: green;"><a href="/createGroup">tao nhom</a> </button>
        <input id="search_group" type="text" onchange="searchgroup()">
        <button type="button"><i class="fa fa-search" onclick="searchgroup()"></i></button>
    </div>

    @if ($che==1)


    <div class="table-details" id="listgroup">

        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">ten nhom</th>
                                <th class="cell100 column2">nhom truong</th>

                                <th class="cell100 column4">thanh vien</th>
                                <th class="cell100 column5">gioi han</th>
                                <th class="cell100 column6">tinh trang</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            @php
                            $listgroup=\App\Http\Controllers\GroupController::getGroup();
                            @endphp
                            @foreach($listgroup as $group)
                            @php
                            $numbermember=\App\Http\Controllers\GroupController::numberMember($group->id);
                            $limitMember=\App\Http\Controllers\GroupController::limitMember($group->id);
                            $level1=\App\Http\Controllers\GroupController::level1Group($group->id);
                            $ismem=\App\Http\Controllers\GroupController::isMember($group->id);
                            $application="/ApplicationGroup?id=".$group->id."&email=".$use;
                            @endphp
                            <tr class="row100 body" id="listgroup">
                                <td class="cell100 column1">{{$group->name}}</td>
                                <td class="cell100 column2">{{$level1}} </td>

                                <td class="cell100 column4">{{$numbermember}}</td>
                                @if($limitMember==null)
                                <td class="cell100 column5">khong gioi han</td>
                                @else
                                <td class="cell100 column5">{{$limitMember}}</td>
                                @endif
                                @if($ismem==0)
                                @php
                                $ischeck=\App\Http\Controllers\GroupController::checked($group->id);
                                @endphp
                                <td class="cell100 column6">
                                    @if($ischeck==0)
                                    <div claas="apped">
                                    <input id='{{$group->id}}'  type="submit" onclick="appliGroup('{{$group->id}}','{{$use}}')" value="xin gia nhap">
                                    </div>@else
                                    <input id='{{$group->id}}' type="submit" onclick="appliGroup('{{$group->id}}','{{$use}}')" value="dang xin" disabled>
                                    @endif
                                </td>
                                @else
                                <td class="cell100 column6" ">
                                
                                <input  type="button" onclick="clickMe('{{$group->id}}')" value="vao" >

                                    

                                </td>
                                @endif
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>


    @else
    <div>ban chua dang nhap</div>

    @endif



</div>

@else
<div>ban chua dang nhap</div>

@endif

<script>
    function clickMe(e) {

        window.location.href = "/gogroup?id=" + e;

    }
   

    function appliGroup(id, email) {
        var input= document.getElementById(id);
        input.disabled=true;
        input.value="dang xin"
        var userdata = {
            'id': id,
            'email': email
        };

        $.ajax({
            url: "/ApplicationGroup",
            type: "GET",
            data:userdata,
           
        }).done(function(Response) {
           
           // $("#detail-event").empty();
           // $("#detail-event").html(Response);
        }
        );
          
    
        }
    function searchgroup(){
        var e=document.getElementById("search_group").value;
        $.ajax({
            url: '/searchgroup?group='+e ,
            type: 'GET',
        }).done(function(response){
            $("#listgroup").empty();
            $("#listgroup").html(response);
            
        });
    }


</script>

<style>
    button:hover .join {
        background-color: green;
        border: solid;
    }

    .column1 {
        width: 30%;
        padding-left: 40px;
    }

    .column2 {
        width: 20%;
    }



    .column4 {
        width: 10%;
    }

    .column5 {
        width: 20%;
    }

    .column6 {
        width: 20%;
    }
</style>