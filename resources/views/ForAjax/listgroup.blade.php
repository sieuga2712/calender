@php

$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
if($che==1)
$use=\App\Http\Controllers\Auth\loginController::userlogin();



@endphp
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
                 
                    @foreach($groups as $group)
                    @php
                    
                    $numbermember=\App\Http\Controllers\GroupController::numberMember($group->id);
                    $limitMember=\App\Http\Controllers\GroupController::limitMember($group->id);
                    $level1=\App\Http\Controllers\GroupController::level1Group($group->id);
                    $ismem=\App\Http\Controllers\GroupController::isMember($group->id);
                    $application="/ApplicationGroup?id=".$group->id."&email=".$use;
                    @endphp
                    <tr class="row100 body" id="listgroup">
                        <td class="cell100 column1" onclick="clickMe({{$group->id}})">{{$group->name}}</td>
                        <td class="cell100 column2" onclick="clickMe({{$group->id}})">{{$level1}} </td>

                        <td class="cell100 column4" onclick="clickMe({{$group->id}})">{{$numbermember}}</td>
                        @if($limitMember==null)
                        <td class="cell100 column5" onclick="clickMe({{$group->id}})">khong gioi han</td>
                        @else
                        <td class="cell100 column5" onclick="clickMe({{$group->id}})">{{$limitMember}}</td>
                        @endif
                        @if($ismem==0)
                        @php
                        $ischeck=\App\Http\Controllers\GroupControlller::checked($group->id);
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
