<style>
    .text input,
    select {
        width: 40%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    input[type=text]{
        width: 30%;
        
    }

    input[type=submit] {
        width: 30%;
        background-color: #58DF24;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #58DF24;
    }

    input[type=button] {
        background-color: #58DF24;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    input[type=button]:hover {
        background-color: #3CA314;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    button {
        background-color: #58DF24;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    button:hover {
        background-color: #3CA314;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
    img{
        width: 350px;
        height: 350px;
    }
</style>

@php
$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
if($che==1)
$use=\App\Http\Controllers\Auth\loginController::userlogin();

$member=\App\Http\Controllers\DetailController::showmember();

@endphp
@if ($che==1)
<form action="/changInformation" method="POST" style="margin-left:300px;margin-top:20px;">
{{csrf_field()}}
    <h2>nhập thông tin </h2>

    <div>
     
        <label >email: </label>
        <input type="text" class="text" value='{{$member->email}}' id="email" name ="email" disabled>
        <br><br>

        
        <label >tên: </label>
        <input type="text" class="text"id="name" name="name" value='{{$member->name}}' >



        <!--
        <br><br>
      
            <label for="birthday">birthday(*) </label>
            <input type="date" class="text" id="birthday" name="birthday" value='{{$member->birthday}}'>
-->
        <input type="submit" id="sudmit">
      
        
        <input type="button" onclick="lammoi()" value="lam moi">
       
    </div>





</form>
@else
        bạn chưa đăng nhập
        
        @endif
        