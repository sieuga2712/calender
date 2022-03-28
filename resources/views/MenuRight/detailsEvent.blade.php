@php
$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
if($che==1)
$use=\App\Http\Controllers\Auth\loginController::userlogin();


@endphp

<div class="detail-event">

    <div class="filter-tool" style="background-color: red;">
        <button type="button" style="background-color: green;" ><a href="/create">tao su kien</a> </button>
    </div>

    @if ($che==1)
        
       
    <div class="table-details">

        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
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
                            <tr class="row100 body" id="{{$event->id}}" onclick="clickMe(this)">
                                <td class="cell100 column1">{{$event->nameEvent}}</td>
                                <td class="cell100 column2">{{$event->timeStart}} </td>
                                <td class="cell100 column3">{{$event->timeEnd}}</td>
                                <td class="cell100 column4">{{$event->dateOfEvent}}</td>
                                <td class="cell100 column5">{{$event->group}}</td>
                                <td class="cell100 column6">{{$event->Note}}</td>
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
    function clickMe(elm){
       
   var check=document.querySelector('#wrap');
   if(check.checked==false)
   check.checked=true;

   else
        check.checked=false;
   
   
}
    
</script>
