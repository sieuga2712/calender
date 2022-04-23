@php
$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
if($che==1)
$use=\App\Http\Controllers\Auth\loginController::userlogin();


@endphp

<div class="detail-event">

    <div class="filter-tool" style="background-color: grey;">
        <button type="button" style="background-color: green;"><a href="/create">tao su kien</a> </button>
        <button type="button" id="chon" style="background-color:#C20000;color:#D9D9D9;" onclick="chonev()">chon</button>
        <button type="button" id="xoa" style="background-color:#C20000;color:#D9D9D9;" onclick="deleteEvent()">xoa</button>
    </div>

    @if ($che==1)
    @php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $today = date("Y/m/d");
    $t=new DateTime($today);
    @endphp

    <div class="List-event" id="listevent">





        @php
        $listEvent=\App\Models\detailEvents::getEvent();
        @endphp
        @foreach($listEvent as $event)



        <div class="a1">
            <div class=" a2 left-calen">

                @if($event->group==NULL)
                <div class="chon hidden">
                    <input type="checkbox" onchange="addList({{$event->id}})">
                </div>
                @endif
                @php
            $date = new DateTime($event->dateOfEvent);
            $g= $t->diff($date)->format('%R%a days');
            $e= $t->diff($date)->format('%d');
            @endphp
           
           
            @if($g>0)
           
            su kien con <?php echo $e ?>  ngay nua bat dau"
            
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
                $name=\App\Models\Group::getNameGroup($event->group);
                @endphp
                <div class="under-calen">
                    group:{{$name}}
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
            <button type="button" class="buttonload"onclick="loadmore()" style="background-color:#318ab7;">Tai them</button>
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





    </div>
</div>

<script>
    function clickMe(elm) {

        var check = document.querySelector('#wrap');
        if (check.checked == false)
            check.checked = true;

        else
            check.checked = false;


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
    var load=10;
    function loadmore(){
        load+=10;
       
        $.ajax({
            url: '/loadMoreEvent?load='+load ,
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