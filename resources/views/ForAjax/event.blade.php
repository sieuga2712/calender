<div class="List-event" id="listevent">
    @php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $today = date("Y/m/d");
    $t=new DateTime($today);
    @endphp

    @foreach($events as $event)
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


    <div class="a1"onclick="clickevent(this.id,'{{$na}}','{{$dat}}','{{$st}}','{{$et}}','{{$no}}')" id='{{$event->id}}'>
        <div class=" a2 left-calen">

            @if($event->group==NULL)
            <div class="chon hidden">
                <input type="checkbox" onchange="addList({{$event->id}})" name="evet" id='{{$event->id}}'>
            </div>
            @endif
            @php
            $date = new DateTime($event->dateOfEvent);
            $g= $t->diff($date)->format('%R%a days');
            $e= $t->diff($date)->format('%d');
            @endphp
           
           
            @if($g>0)
           
            còn <?php echo $e ?>  ngày nữa bắt đầu"
            
            @elseif($g==0)
            sự kiện đang diễn ra
            @else
           
           
             sự kiện đã kết thúc
            @endif

        </div>
        <div class=" a2 calen">
            <div class="top-calen">
                {{$event->nameEvent}}
            </div>
            <div class="mid-calen">
                @if($event->timeEnd==NULL && $event->timeStart!=NULL)
                thời gian: bắt đầu lúc {{$event->timeStart}}
                @elseif($event->timeEnd!=NULL && $event->timeStart==NULL)
                thời gian: kết thúc lúc {{$event->timeStart}}
                @elseif($event->timeEnd==NULL && $event->timeStart==NULL)
                cả ngày
                @else
                thời gian:{{$event->timeStart}}-{{$event->timeEnd}}
                @endif
                <div style="float:right">
                    ngày:{{$event->dateOfEvent}}
                </div>
            </div>

            @if($event->group!=NULL)
            @php
            $name=\App\Http\Controllers\GroupController::getNameGroup($event->group);
            @endphp
            <div class="under-calen">
               nhóm:{{$name}}
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
        @if($limit>$load)
        <button type="button" class="buttonload" onclick="loadmore()" style="background-color:#318ab7;">tải thêm</button>
        @else
        <div>
            ---------------------------------------hết sự kiện---------------------------------------------
        </div>
        @endif
    </div>
</div>