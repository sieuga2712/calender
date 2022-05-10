<div class="List-event" id="listevent">
    @php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $today = date("Y/m/d");
    $t=new DateTime($today);
    @endphp

    @foreach($events as $event)



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
            $name=\App\Http\Controllers\GroupController::getNameGroup($event->group);
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
        @if($limit>$load)
        <button type="button" class="buttonload" onclick="loadmore()" style="background-color:#318ab7;">Tai them</button>
        @else
        <div>
            ---------------------------------------het su kien---------------------------------------------
        </div>
        @endif
    </div>
</div>