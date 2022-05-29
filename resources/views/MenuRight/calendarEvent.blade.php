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
    @foreach($mess as $me)
       <div>-{{$me->subjectA}}<?php echo " da ";?> {{$me->Action}}<?php echo " ";?> {{$me->subjectB}}</div>
        <br>
    @endforeach 
@else
   

    <!-- end calendar-->

    <!--event right-->

    ban chua dang nhap
    <!-- end event right-->

    <!--end calendar right-->




    @endif 
</div>