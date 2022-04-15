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


    <div class="table-details">

        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column0 hidden"></th>
                                <th class="cell100 column1">ten su kien</th>
                                <th class="cell100 column2">bat dau</th>
                                <th class="cell100 column3">ket thuc</th>
                                <th class="cell100 column4">date</th>
                                <th class="cell100 column5">group</th>
                                <th class="cell100 column6">ghi chu</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            @php
                            $listEvent=\App\Models\detailEvents::getEvent();
                            @endphp
                            @foreach($listEvent as $event)
                            <tr class="row100 body" id="{{$event->id}}">
                                <td class="cell100 column0 hidden" >
                                    @if($event->group==NULL)
                                    <input type="checkbox"onchange="addList({{$event->id}})">
                                    @endif

                                </td>
                                <td class="cell100 column1" onclick="clickMe(this)">{{$event->nameEvent}}</td>
                                <td class="cell100 column2" onclick="clickMe(this)">{{$event->timeStart}} </td>
                                <td class="cell100 column3" onclick="clickMe(this)">{{$event->timeEnd}}</td>
                                <td class="cell100 column4" onclick="clickMe(this)">{{$event->dateOfEvent}}</td>
                                <td class="cell100 column5" onclick="clickMe(this)">{{$event->group}}</td>
                                <td class="cell100 column6" onclick="clickMe(this)">{{$event->Note}}</td>
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
                listevent.splice(i,1);
                
                return;
            }
            listevent.push(id);
           
    }

   

    

   
    function deleteEvent() {
        
        var userdata = {
            'list':listevent
        };
        
        $.ajax({
            url: "/deletePersonalEvent",
            type: "GET",
            data:userdata,
           
        }).done(function(Response) {
           
            
        }
        );
        location.reload(true);
          
    
        }
</script>
<style>
    .column0 {
        width: 5%;

    }

    


    .column1 {
        width: 25%;
        padding-left: 40px;
    }

    .column2 {
        width: 8%;
    }

    .column3 {
        width: 8%;
    }

    .column4 {
        width: 18%;
    }

    .column5 {
        width: 18%;
    }

    .column6 {
        width: 18%;
    }
</style>