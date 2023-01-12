@php
$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
if($che==1)
$use=\App\Http\Controllers\Auth\loginController::userlogin();


@endphp

<div class="detail-event">

    <div class="filter-tool" style="background-color: #bcc1df; padding-left: 5px;padding-top: 4px;">
        <button type="button" class="my-btn-steel-blue" style="border:solid 1px;"><a href="/create" style="color:white;">tạo sự kiện</a> </button>
        <button type="button" id="chon" style="background-color:#C20000;color:#D9D9D9;" onclick="chonev()">chọn</button>
        <button type="button" id="xoa" style="background-color:#C20000;color:#D9D9D9; display:none;" onclick="deleteEvent()" disabled>xóa</button>
        <button type="button" id="selectall" style="background-color:#C20000;color:#D9D9D9;display:none;" onclick="selectall()">chọn hết</button>
        <input type="date" class="text" id="searchDate" onchange="searchevent()">
        <input id="search_event" type="text" onchange="searchevent()">
        <button type="button"><i class="fa fa-search" onclick="searchevent()"></i></button>
    </div>

    @if ($che==1)
    @php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $today = date("Y/m/d");
    $t=new DateTime($today);
    $totalEvent=\App\Http\Controllers\EventController::CountEvent();
    @endphp

    @if($totalEvent!=0)
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
                    <input type="checkbox" onchange="addList('{{$event->id}}')" name="evet"id='{{$event->id}}'>
                </div>
                @endif
                @php
                $date = new DateTime($event->dateOfEvent);
                $g= $t->diff($date)->format('%R%a days');
                $e= $t->diff($date)->format('%d');
                @endphp


                @if($g>0)

                sự kiện còn <?php echo $e ?> ngày nữa bắt đầu"

                @elseif($g==0)
                sự kiện đang diễn ra
                @else


                sự kiện đã qua
                @endif


            </div>
            <div class=" a2 calen">
                <div class="top-calen">
                    {{$event->nameEvent}}
                </div>
                <div class="mid-calen">
                    @if($event->timeEnd==NULL && $event->timeStart!=NULL)
                    bắt đầu:{{$event->timeStart}}
                    @elseif($event->timeEnd!=NULL && $event->timeStart==NULL)
                    kết thúc:{{$event->timeStart}}
                    @elseif($event->timeEnd==NULL && $event->timeStart==NULL)
                    thời gian: cả ngày
                    @else
                    thời gian:{{$event->timeStart}}-{{$event->timeEnd}}
                    @endif
                    <div style="float:right">
                        ngày:{{$event->dateOfEvent}}
                    </div>
                </div>

                @if($event->group!=NULL)
                @php
                $gname=\App\Http\Controllers\GroupController::getNameGroup($event->group);
                @endphp
                <div class="under-calen">
                    nhóm:{{$gname}}
                </div>
                @endif

            </div>
            <div class=" a2">
                <span class="right-calen">
                    ghi chú:
                </span>
                <br>
                {{$event->Note}}
            </div>
        </div>

        @endforeach


        <div class="loadmore">
            <button type="button" class="buttonload" onclick="loadmore()" style="background-color:#318ab7;">tải thêm</button>
        </div>
    </div>
    @else
    bạn chưa có sự kiện nào
    @endif

    @else
    <div>bạn chưa đăng nhập</div>

    @endif



</div>
<div class="right-area" style="background-color: red;">

    <input id="wrap" class="tough" type="checkbox" />

    <div class="event-menu">

        <label for="wrap" class="wrap-menuin">a</label>
        <div style="padding-left:20px ; padding-top:20px">
            <form action="/UpdatePersonalEvent" id="FormPUpdate" method="POST" onsubmit="return checkid()">
                {{csrf_field()}}
                <h2>chỉnh sửa sự kiện</h2>
                <input type="text" class="text" id="Id_Update" name="Id_Update" style="display:none;">
                <label for="Update_Event_Name">tên sự kiện(*): </label>
                <input type="text" class="text" id="Update_Event_Name" name="Update_Event_Name">
                <br><br>

                <br><br>
                <label for="Update_Start_Time">thời gian bắt đầu: </label>
                <input type="time" class="text" id="Update_Start_Time" name="Update_Start_Time" onchange="checktime()">
                <br><br>
                <label for="Update_End_Time">thời gian kết thúc:</label>
                <input type="time" class="text" id="Update_End_Time" name="Update_End_Time" onchange="checktime()">
                <br>


                <label for="Update_Event_Date">ngày(*) </label>
                <input type="date" class="text" id="Update_Event_Date" name="Update_Event_Date">


                <br>

                <label>ghi chú: <textarea id="Update_Note" class="text" name="Update_Note" rows="4" cols="38">

                                    </textarea>
                </label>
                <br>
                <button type="submit" class="btn btn-primary"> update</button>
            </form>
        </div>




    </div>
</div>

<script>
    var idcheck = null;

    function checktime(e) {

        var timestart = document.getElementById("Update_Start_Time");
        var timeend = document.getElementById("Update_End_Time");



        if (timeend.value < timestart.value && timestart.value != "" && timeend.value != "") {
            alert("gio ket thuc phai hon gio bat dau");
            timeend.value = timestart.value;

        }

    }

    function clickevent(elm, na, da, st, et, no) {

        var check = document.querySelector('#wrap');


        if (check.checked == false) {
            check.checked = true;
            ChangeInfoRightArea(elm, na, da, st, et, no);

        } else {
            if (idcheck == elm)
                check.checked = false;
            else {
                ChangeInfoRightArea(elm, na, da, st, et, no);
            }
        }

        idcheck = elm;


    }

    function ChangeInfoRightArea(elm, na, da, st, et, no) {
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
        var n = document.getElementById("Update_Event_Name").value;
        if (idcheck == null)
            return false;
        if (d == null) {
            alert("ngay su kien khong duoc de trong");
            return false;
        }
        if (n == '') {
            alert("ten su kien khong duoc de trong");
            return false;
        }


        let text = "cập nhật sự kiện!\nchọn OK hoặc Hủy.";
        if (confirm(text) == true) {
            return true;
        } else {
            return false;
        }


        return true;
    }


    var listevent = [];

    function addList(id) {
        var C2 = "rgb(" + hexToRgb("#C20000") + ")";
        var D9 = "rgb(" + hexToRgb("#D9D9D9") + ")";
        xoa = document.getElementById("xoa");
        for (let i = 0; i < listevent.length; i++)
            if (listevent[i] == id) {
                listevent.splice(i - 1, 1);
                if (listevent.count != 0) {
                    xoa.disabled = false;

                } else {

                    xoa.disabled = true;
                }
                return;
            }

        listevent.push(id);

        if (listevent.count != 0) {

            xoa.disabled = false;
        } else {


            xoa.disabled = true;

        }
        console.log(id);
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

    function searchevent() {
        var e = document.getElementById("search_event").value;
        var date = document.getElementById("searchDate").value;
        
        $.ajax({
            url: '/searchevent?event=' + e + '&date=' + date,
            type: 'GET',
        }).done(function(response) {
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

    function selectall() {
        checkboxes = document.getElementsByName('evet');
        var choiced = 0;
        for (var i = 0, n = checkboxes.length; i < n; i++)
            if (checkboxes[i].checked == true)
            choiced++;
        
        if (choiced < checkboxes.length) {
            listevent.splice(0,listevent.count);
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = true;
                listevent.push(checkboxes[i].id);
            }

        } else {
            listevent.splice(0,listevent.count);
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = false;
            }

        }
        console.log(choiced);
    }
</script>