@php

$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
if($che==1)
$use=\App\Http\Controllers\Auth\loginController::userlogin();



@endphp
<div id="listmission">
   
    @foreach($listMission as $mission)
    @php

    $limit=\App\Http\Controllers\GroupController::showLimitMission($mission->id);
    $isjoin=\App\Http\Controllers\GroupController::Missionjoined($mission->id);
    @endphp



    @if($mission->TypeOfMission==0)
    <!--nhiem vu loai 0-->
    <div class="a1-group">
        <div class="a2">
            <div class="chon hidden">
                <input type="checkbox" onchange="addList({{$mission->id}})">
            </div>

        </div>
        <div class=" a2 calen">
            <div class="top-calen">
                {{$mission->NameMission}}
            </div>
            <div class="mid-calen">
                <div style="float:right">
                    loại: sự kiện trong ngay
                </div>
                bắt đầu: {{$mission->StartTime}}
                <br>
                kết thúc: {{$mission->EndTime}}
                <br>
                ngay: {{$mission->dateMission}}
                <br>
                so nguoi tham gia:
                @if($mission->limit!=NULL)
                {{$limit}}/{{$mission->limit}}
                @else
                khong gioi han
                @endif
            </div>

        </div>
        <div class=" a2">
            <span class="right-calen">
                NOTE:
            </span>
            <br>
            {{$mission->Note}}
        </div>
        <div class=" a2 submit-calen">
            @php
            if($limit>=$mission->limit)
            $s="disabled";
            else
            $s=NUll;
            if($limit==NUll)
            $s=NUll;
            @endphp
            <div id="checkMember">
                @if($isjoin==0)
                <input type="submit" class="button-joinmission" id="join_{{$mission->id}}" onclick="joinMission('{{$idgroup}}','{{$mission->id}}')" value="tham gia" {{$s}}>
                <input type="submit" class="button-joinmission" id="out_{{$mission->id}}" style="display: none;" onclick="quitMission('{{$idgroup}}','{{$mission->id}}')" value="roi khoi">
                @else
                <input type="submit" class="button-joinmission" id="join_{{$mission->id}}" style="display: none;" onclick="joinMission('{{$idgroup}}','{{$mission->id}}')" value="tham gia" {{$s}}>
                <input type="submit" class="button-joinmission" id="out_{{$mission->id}}" onclick="quitMission('{{$idgroup}}','{{$mission->id}}')" value="roi khoi">
                @endif
            </div>
        </div>
    </div>
    @endif
    @if($mission->TypeOfMission==1)
    <!--nhiem vu loai 1-->
    <div class="a1-group">
        <div class="a2">
            <div class="chon hidden">
                <input type="checkbox" onchange="addList({{$mission->id}})">
            </div>

        </div>
        <div class=" a2 calen">
            <div class="top-calen">
                {{$mission->NameMission}}
            </div>
            <div class="mid-calen">
                <div style="float:right">
                    loại: sự kiện dài co chu kỳ
                </div>
                ngày bắt đầu: {{$mission->dateStart}}
                <br>
                ngày kết thúc: {{$mission->dateEnd}}
                <br>
                so nguoi tham gia:
                @if($mission->limit!=NULL)
                {{$limit}}/{{$mission->limit}}
                @else
                khong gioi han
                @endif
                <br>
                danh sách:
                <!--input type="button" value="xem them" onclick="showListCalen()"-->
                <br>
                @php
                $levent = array();
                $g="";
                $e=$mission->listCalen;

                for($i=0;$i< strlen($e);$i++){ if($e[$i]=="@" ) {$levent[]=$g; $g="" ; } else $g=$g.$e[$i]; } @endphp <div>
                    @foreach($levent as $eve)
                    <li>{{$eve}}</li>
                    @endforeach
                    </div>
            </div>
        </div>





        <div class=" a2">
            <span class="right-calen">
                NOTE:
            </span>
            <br>
            {{$mission->Note}}
        </div>
        <div class=" a2 submit-calen">


            @php
            if($limit>=$mission->limit)
            $s="disabled";
            else
            $s=NUll;
            if($limit==NUll)
            $s=NUll;
            @endphp
            <div id="checkMember">
                @if($isjoin==0)
                <input type="submit" class="button-joinmission" id="join_{{$mission->id}}" onclick="joinMission('{{$idgroup}}','{{$mission->id}}')" value="tham gia" {{$s}}>
                <input type="submit" class="button-joinmission" id="out_{{$mission->id}}" style="display: none;" onclick="quitMission('{{$idgroup}}','{{$mission->id}}')" value="roi khoi">
                @else
                <input type="submit" class="button-joinmission" id="join_{{$mission->id}}" style="display: none;" onclick="joinMission('{{$idgroup}}','{{$mission->id}}')" value="tham gia" {{$s}}>
                <input type="submit" class="button-joinmission" id="out_{{$mission->id}}" onclick="quitMission('{{$idgroup}}','{{$mission->id}}')" value="roi khoi">
                @endif
            </div>


        </div>

    </div>
    @endif
    @if($mission->TypeOfMission==2)
    <!--nhiem vu loai 2-->
    <div class="a1-group">
        <div class="a2 left-calen">
            <div class="chon hidden">
                <input type="checkbox" onchange="addList({{$mission->id}})">
            </div>

        </div>
        <div class=" a2 calen">
            <div class="top-calen">
                {{$mission->NameMission}}
            </div>
            <div class="mid-calen">
                <div style="float:right">
                    loại: sự kiện dài không chu kỳ
                </div>
                <br>
                so nguoi tham gia: @if($mission->limit!=NULL)
                {{$limit}}/{{$mission->limit}}
                @else
                khong gioi han
                @endif
                <br>
                danh sách:
                <!--input type="button" value="xem them" onclick="showListCalen()"-->
                <br>
                @php
                $levent = array();
                $e=$mission->listCalen;

                $g="";
                for($i=0;$i< strlen($e);$i++) { if($e[$i]=="@" ) { $levent[]=$g; $g="" ; } else $g=$g.$e[$i]; } @endphp <div>


                    @foreach($levent as $eve)
                    <li>{{$eve}}</li>
                    @endforeach
                    </div>
            </div>

        </div>
        <div class=" a2">
            <span class="right-calen">
                NOTE:
            </span>
            <br>
            {{$mission->Note}}
        </div>
        <div class=" a2 submit-calen">


            @php
            if($limit>=$mission->limit)
            $s="disabled";
            else
            $s=NUll;
            if($limit==NUll)
            $s=NUll;
            @endphp
            <div id="checkMember">
                @if($isjoin==0)
                <input type="submit" class="button-joinmission" id="join_{{$mission->id}}" onclick="joinMission('{{$idgroup}}','{{$mission->id}}')" value="tham gia">
                <input type="submit" class="button-joinmission" id="out_{{$mission->id}}" style="display: none;" onclick="quitMission('{{$idgroup}}','{{$mission->id}}')" value="roi khoi">
                @else
                <input type="submit" class="button-joinmission" id="join_{{$mission->id}}" style="display: none;" onclick="joinMission('{{$idgroup}}','{{$mission->id}}')" value="tham gia">
                <input type="submit" class="button-joinmission" id="out_{{$mission->id}}" onclick="quitMission('{{$idgroup}}','{{$mission->id}}')" value="roi khoi">
                @endif
            </div>


        </div>
    </div>
    @endif



    @endforeach

</div>