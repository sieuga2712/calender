<div class="main-group" style="margin-left:20px;">
    @php
    $use=$_GET["id"];
    $mess=\App\Http\Controllers\messengeController::messGroup($use);
  
    @endphp
    
    @foreach($mess as $me)  
       <div>-{{$me->subjectA}}<?php echo " đã ";?> {{$me->Action}}<?php echo " ";?> {{$me->subjectB}}<?php echo " vào lúc ";?>{{$me->created_at}}</div>
        <br>
    @endforeach 
</div>