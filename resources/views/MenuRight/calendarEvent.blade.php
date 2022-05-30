<div id="calendar-event" style="margin-top: 20px;margin-left: 20px;">
@php
$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
@endphp
@if($che==1)
    @php
    $use=\App\Http\Controllers\Auth\loginController::userlogin();
    $mess=\App\Http\Controllers\messengeController::messPerson($use);
     
    @endphp
    @if(count($mess)>0)
    <div>
    @foreach($mess as $me)
       <div>-{{$me->subjectA}}
       <?php echo " cua nhom ";?>{{$me->ingroup}}
           
       <?php echo " da ";?> {{$me->Action}}<?php echo " ";?> {{$me->subjectB}}</div>
        <br>
    @endforeach 
    @else
     khong co su kien
     @endif
    </div>
@else
   

    <!-- end calendar-->

    <!--event right-->

    ban chua dang nhap
    <!-- end event right-->

    <!--end calendar right-->




    @endif 
</div>