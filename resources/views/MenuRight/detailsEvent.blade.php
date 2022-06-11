@php
$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
if($che==1)
$use=\App\Http\Controllers\Auth\loginController::userlogin();


@endphp

<div class="detail-event">

    <div class="filter-tool" style="background-color: #bcc1df; padding-left: 5px;padding-top: 4px;">
        <button type="button" class="my-btn-steel-blue" style="border:solid 1px;"><a href="/create" style="color:white;">tao su kien</a> </button>
        <button type="button" id="chon" style="background-color:#C20000;color:#D9D9D9;" onclick="chonev()">chon</button>
        <button type="button" id="xoa" style="background-color:#C20000;color:#D9D9D9;" onclick="deleteEvent()" disabled>xoa</button>
        <input type="date" class="text" id="searchDate" onchange="searchevent()">
        <input id="search_event"  type="text" onchange="searchevent()">
        <button type="button"><i class="fa fa-search" onclick="searchevent()"></i></button>
    </div>

    @if ($che==1)
    @php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $today = date("Y/m/d");
    $t=new DateTime($today);
    @endphp

    <div class="List-event" id="listevent">





        @php
        $listEvent=\App\Http\Controllers\EventController::getEvent();

        @endphp
        @foreach($listEvent as $event)
        @php
        $na=$event->nameEvent;

        $dat= $event->dateOfEvent;

        $st=$event->timeStart;
        if($st==NULL)
        $st="-1";
        $et=$event->timeEnd;
        if($et==NULL)
        $et="-1";
        $no=$event->Note;
        if($no==NULL)
        $no="-1";
        @endphp


        <div class="a1" onclick="clickevent(this.id,'{{$na}}','{{$dat}}','{{$st}}','{{$et}}','{{$no}}')" id='{{$event->id}}'>
            <div class=" a2 left-calen">

                @if($event->group==NULL)
                <div class="chon hidden">
                    <input type="checkbox" onchange="addList('{{$event->id}}')">
                </div>
                @endif
                @php
                $date = new DateTime($event->dateOfEvent);
                $g= $t->diff($date)->format('%R%a days');
                $e= $t->diff($date)->format('%d');
                @endphp


                @if($g>0)

                su kien con <?php echo $e ?> ngay nua bat dau"

                @elseif($g==0)
                su kien dang dien ra
                @else


                su kien da qua
                @endif


            </div>
            <div class=" a2 calen">
                <div class="top-calen">
                    {{$event->nameEvent}}
                </div>
                <div class="mid-calen">
                    @if($event->timeEnd==NULL && $event->timeStart!=NULL)
                    start time:{{$event->timeStart}}
                    @elseif($event->timeEnd!=NULL && $event->timeStart==NULL)
                    endtime:{{$event->timeStart}}
                    @elseif($event->timeEnd==NULL && $event->timeStart==NULL)
                    time: all day
                    @else
                    time:{{$event->timeStart}}-{{$event->timeEnd}}
                    @endif
                    <div style="float:right">
                        date:{{$event->dateOfEvent}}
                    </div>
                </div>

                @if($event->group!=NULL)
                @php
                $gname=\App\Http\Controllers\GroupController::getNameGroup($event->group);
                @endphp
                <div class="under-calen">
                    group:{{$gname}}
                </div>
                @endif

            </div>
            <div class=" a2">
                <span class="right-calen">
                    NOTE:
                </span>
                <br>
                {{$event->Note}}
            </div>
        </div>

        @endforeach


        <div class="loadmore">
            <button type="button" class="buttonload" onclick="loadmore()" style="background-color:#318ab7;">Tai them</button>
        </div>
    </div>


    @else
    <div>ban chua dang nhap</div>

    @endif



</div>
<div class="right-area" style="background-color: red;">

    <input id="wrap" class="tough" type="checkbox" />

    <div class="event-menu">

        <label for="wrap" class="wrap-menuin">a</label>
        <div style="padding-left:20px ; padding-top:20px">
            <form action="/UpdatePersonalEvent" id="FormPUpdate" method="POST">
                {{csrf_field()}}
                <h2>chinh sua su kien</h2>
                <input type="text" class="text" id="Id_Update" name="Id_Update" style="display:none;">
                <label for="Update_Event_Name">ten su kien(*): </label>
                <input type="text" class="text" id="Update_Event_Name" name="Update_Event_Name">
                <br><br>

                <br><br>
                <label for="Update_Start_Time">thoi gian bat dau: </label>
                <input type="time" class="text" id="Update_Start_Time" name="Update_Start_Time" onchange="checktime()">
                <br><br>
                <label for="Update_End_Time">thoi gian ket thuc:</label>
                <input type="time" class="text" id="Update_End_Time" name="Update_End_Time" onchange="checktime()">
                <br>


                <label for="Update_Event_Date">ngay(*) </label>
                <input type="date" class="text" id="Update_Event_Date" name="Update_Event_Date">


                <br>

                <label>ghi chu: <textarea id="Update_Note" class="text" name="Update_Note" rows="4" cols="38">

                                    </textarea>
                </label>
                <br>
                <button type="submit"  onclick="return checkid()"class="btn btn-primary"> update</button>
            </form>
        </div>




    </div>
</div>

<script>
    var idcheck = null;

    function clickevent(elm, na, da, st, et, no) {

        var check = document.querySelector('#wrap');


        if (check.checked == false) {
            check.checked = true;
            ChangeInfoRightArea(elm,na, da, st, et, no);

        } else {
            if (idcheck == elm)
                check.checked = false;
            else {
                ChangeInfoRightArea(elm,na, da, st, et, no);
            }
        }

        idcheck = elm;


    }

    function ChangeInfoRightArea(elm,na, da, st, et, no) {
        document.getElementById("Id_Update").value = elm;
        document.getElementById("Update_Event_Name").value = na;

        document.getElementById('Update_Event_Date').value = da;
        if (st != "-1")
            document.getElementById("Update_Start_Time").value = st;
        if (et != "-1")
            document.getElementById("Update_End_Time").value = et;

        document.getElementById("Update_Note").value = no;

    }

    function checkid() {
        var d = document.getElementById('Update_Event_Date').value;
        var n=document.getElementById("Update_Event_Name").value = na;
        if (idcheck == null)
            return false;
        if (d == null){
            alert("ngay su kien khong duoc de trong");
            return false;
        }
        if (n == ''){
            alert("ten su kien khong duoc de trong");
            return false;
        }
        return true;
    }


    var listevent = [];

    function addList(id) {

        for (let i = 0; i < listevent.length; i++)
            if (listevent[i] == id) {
                listevent.splice(i, 1);

                return;
            }
        listevent.push(id);

    }
    var load = 10;

    function loadmore() {
        load += 10;

        $.ajax({
            url: '/loadMoreEvent?load=' + load,
            type: 'GET',
        }).done(function(response) {
            $("#listevent").empty();
            $("#listevent").html(response);

        });


    }
    function searchevent(){
        var e=document.getElementById("search_event").value;
        var date=document.getElementById("searchDate").value;
        $.ajax({
            url: '/searchevent?event='+e +'&date='+date,
            type: 'GET',
        }).done(function(response){
            $("#listevent").empty();
            $("#listevent").html(response);
            
        });
    }
    


    function deleteEvent() {

        var userdata = {
            'list': listevent
        };

        $.ajax({
            url: "/deletePersonalEvent",
            type: "GET",
            data: userdata,

        }).done(function(Response) {


        });
        location.reload(true);


    }
</script>