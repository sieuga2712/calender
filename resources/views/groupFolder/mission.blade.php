<div class="main-group">
    <div class="table-details">
    <div class="filter-tool" style="background-color: grey;">
        
        <button type="button" id="chon" style="background-color:#C20000;color:#D9D9D9;" onclick="chonev()">chon</button>
        <button type="button" id="xoa" style="background-color:#C20000;color:#D9D9D9;" onclick="deleteGroupEvent()">xoa</button>
    </div>
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column0 chon hidden"></th>
                                <th class="cell100 column1" style="width: 25%;">ten nhiem vu</th>
                                <th class="cell100 column2"style="width: 20%;">ngay</th>

                                <th class="cell100 column4"style="width: 10%;">thoi gian</th>
                                <th class="cell100 column5"style="width: 15%;">so nguoi</th>
                                <th class="cell100 column6"style="width: 25%;">tuy chon</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            @php
                            $listMission=\App\Http\Controllers\GroupController::showMission();
                            @endphp
                            @foreach($listMission as $mission)
                            @php
                            $idgroup=$_GET['id'];
                            $limit=\App\Http\Controllers\GroupController::showLimitMission($mission->id);
                            $isjoin=\App\Http\Controllers\GroupController::Missionjoined($mission->id);
                            @endphp
                            <tr class="row100 body" >
                                <td class="cell100 column0 chon hidden"  style="width: 5%;">
                                 
                                    <input type="checkbox"onchange="addList({{$mission->id}})">
                                  

                                </td>
                                <td class="cell100 column1"style="width: 25%;">{{$mission->NameMission}}</td>
                                <td class="cell100 column2"style="width:20%;">{{$mission->dateMission}} </td>

                                <td class="cell100 column4"style=" width:10%;">{{$mission->StartTime}} - {{$mission->EndTime}}</td>
                                @if($mission->limit!=NULL)
                                <td class="cell100 column5"style="width: 15%;">{{$limit}}/{{$mission->limit}}</td>
                                @else
                                <td class="cell100 column5"style="width: 15%;">khong gioi han</td>
                                @endif
                                <td class="cell100 column6"style="width: 25%;">
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
                                        <input type="submit" id="join_{{$mission->id}}"  onclick="joinMission('{{$idgroup}}','{{$mission->id}}')" value="tham gia" {{$s}}>
                                        <input type="submit" id="out_{{$mission->id}}" style="display: none;" onclick="quitMission('{{$idgroup}}','{{$mission->id}}')" value="roi khoi">
                                        @else
                                        <input type="submit" id="join_{{$mission->id}}" style="display: none;"  onclick="joinMission('{{$idgroup}}','{{$mission->id}}')" value="tham gia" {{$s}}>
                                        <input type="submit" id="out_{{$mission->id}}" onclick="quitMission('{{$idgroup}}','{{$mission->id}}')" value="roi khoi">
                                        @endif
                                    </div>

                                </td>

                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>


</div>

<script>
    function joinMission(idg, idm) {

        $.ajax({
            url: '/joinMission?idMission=' + idm,
            type: 'GET',

        }).done(function(Response) {
            var join=document.getElementById("join_"+idm);
            var out=document.getElementById("out_"+idm);
            join.style.display="none";
            out.style.display="inline";
            console.log(Response);
            $("#main-group").empty();
            $("#main-group").html(Response);

        });
    }

    function quitMission(idg, idm) {

        $.ajax({
            url: '/quitMission?idMission=' + idm,
            type: 'GET',

        }).done(function(Response) {
            var join=document.getElementById("join_"+idm);
            var out=document.getElementById("out_"+idm);
            join.style.display="inline";
            out.style.display="none";
            console.log(Response);
            $("#main-group").empty();
            $("#main-group").html(Response);

        });
    }

    const listevent = [];

    function addList(id) {

        for (let i = 0; i < listevent.length; i++)
            if (listevent[i] == id) {
                listevent.splice(i,1);
                
                return;
            }
            listevent.push(id);
          
    }

    function deleteGroupEvent() {
        
        var userdata = {
            'list':listevent
        };
        
        $.ajax({
            url: "/deleteGroupMission",
            type: "GET",
            data:userdata,
           
        }).done(function(Response) {
           
            
        }
        );
        location.reload(true);
          
    
        }
</script>
