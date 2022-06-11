<div>

    <div class="filter-tool" style="background-color: #bcc1df;">

        <button type="button" id="chon" style="background-color:#C20000;color:#D9D9D9;" onclick="chonev()">chon</button>
        <button type="button" id="xoa" style="background-color:#C20000;color:#D9D9D9;" onclick="deleteGroupEvent()" disabled>xoa</button>
        <input id="search_mission" type="text" onchange="searchmission()">
        <button type="button"><i class="fa fa-search" onclick="searchmission()"></i></button>
    </div>

    <div id="listmission">
        @php
        $listMission=\App\Http\Controllers\GroupController::showMission();
        $idgroup=$_GET['id'];
        @endphp
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
</div>

<script>
    function joinMission(idg, idm) {

        $.ajax({
            url: '/joinMission?idMission=' + idm+'&idgroup='+'<?php  echo $idgroup?>',
            type: 'GET',

        }).done(function(Response) {
            var join = document.getElementById("join_" + idm);
            var out = document.getElementById("out_" + idm);
            join.style.display = "none";
            out.style.display = "inline";



        });
    }

    function quitMission(idg, idm) {

        $.ajax({
            url: '/quitMission?idMission=' + idm,
            type: 'GET',

        }).done(function(Response) {
            var join = document.getElementById("join_" + idm);
            var out = document.getElementById("out_" + idm);
            join.style.display = "inline";
            out.style.display = "none";


        });
    }

    const listevent = [];

    function addList(id) {

        for (let i = 0; i < listevent.length; i++)
            if (listevent[i] == id) {
                listevent.splice(i, 1);

                return;
            }
        listevent.push(id);

    }

    function showListCalen() {
        var a = document.getElementById("hidden-listcalen");
        if (a.style.display == "none")
            a.style.display = "inlin-block";
        else
            a.style.display == "none"
    }

    function deleteGroupEvent() {

        var userdata = {
            'list': listevent
        };

        $.ajax({
            url: "/deleteGroupMission",
            type: "GET",
            data: userdata,

        }).done(function(Response) {


        });
        location.reload(true);


    }

    function searchmission() {
        var e = document.getElementById("search_mission").value;
        $.ajax({
            url: '/searchmission?mission=' + e+'&idgroup='+'<?php  echo $idgroup?>',
            type: 'GET',
        }).done(function(response) {
            $("#listmission").empty();
            $("#listmission").html(response);

        });
    }
</script>