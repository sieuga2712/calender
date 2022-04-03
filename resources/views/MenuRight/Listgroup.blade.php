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
    </div>

    @if ($che==1)


    <div class="table-details">

        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">ten nhom</th>
                                <th class="cell100 column2">nhom truong</th>

                                <th class="cell100 column4">thanh vien</th>
                                <th class="cell100 column5">ghi chu</th>
                                <th class="cell100 column6">tinh trang</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            @php
                            $listgroup=\App\Models\Group::getGroup();
                            @endphp
                            @foreach($listgroup as $group)
                            @php
                            $numbermember=\App\Models\Group::numberMember($group->id);
                            $level1=\App\Models\Group::level1Group($group->id);
                            $ismem=\App\Models\Group::isMember($group->id);
                            $application="/ApplicationGroup?id=".$group->id."&email=".$use;
                            @endphp
                            <tr class="row100 body" id="listgroup">
                                <td class="cell100 column1" onclick="clickMe({{$group->id}})">{{$group->name}}</td>
                                <td class="cell100 column2" onclick="clickMe({{$group->id}})">{{$level1}} </td>

                                <td class="cell100 column4" onclick="clickMe({{$group->id}})">{{$numbermember}}</td>
                                <td class="cell100 column5" onclick="clickMe({{$group->id}})">ghi chu</td>
                                @if($ismem==0)
                                @php
                                $ischeck=\App\Models\Applications::checked($group->id);
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
                                
                                        da gia nhap

                                    

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