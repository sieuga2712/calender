<div id="calendar-event" style="margin-top: 20px;margin-left: 20px;">
@php
$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
@endphp
@if($che==1)
    @php
    $use=\App\Http\Controllers\Auth\loginController::userlogin();
    $mess=\App\Http\Controllers\messengeController::messPerson($use);
    $id=\App\Http\Controllers\Auth\loginController::userid();
    
    @endphp
    <div>
    <h2>sự kiện 3 ngày tới:</h2><br><br>
    @php
        \App\Http\Controllers\CreateController::Sukiengan();
        @endphp
        <hr>
        <h2> thông báo:</h2><br>
    @if(count($mess)>0)
    
    
    
        
       
    @foreach($mess as $me)
       <div>-<span style="color:blue;">{{$me->subjectA}}</span>
       <?php echo " của nhóm ";?> <span style="color:blue;">{{$me->ingroup}}</span> 
           
       <?php echo " đã ";?> {{$me->Action}}<?php echo " ";?><span style="color:blue;"> {{$me->subjectB}}</span> </div>
        <br>
    @endforeach 
    @else
    không có sự kiện
     @endif
    </div>
    
@else
   

    <!-- end calendar-->

    <!--event right-->

    bạn chưa đăng nhập
    <!-- end event right-->

    <!--end calendar right-->




    @endif 
</div>