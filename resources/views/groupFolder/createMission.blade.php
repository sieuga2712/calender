<div class="main-group">

<style>
    .text input,
    select {
        width: 30%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
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
</style>

@php
$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
if($che==1)
$use=\App\Http\Controllers\Auth\loginController::userlogin();

$idgroup=$_GET['id'];
@endphp
<form action="/createGroupMission" id="FormCreate" method="POST" style="margin-left:300px;margin-top:20px;">
{{csrf_field()}}
    <h2>nhap thong tin nhiem vu</h2>

    <div>
        <label for="MissionName">ten nhiem vu(*): </label>
        <input type="text" class="text" id="MissionName" name="MissionName">
        <br><br>

       
        <label for="startTime">thoi gian bat dau: </label>
        <input type="time" class="text" id="startTime" name="startTime">
        <br><br>
        <label for="endTime">thoi gian ket thuc:</label>
        <input type="time" class="text" id="endTime" name="endTime">
        <br>
        <!--
        <label for="cycle" style="margin-left:20px;" disabled>su kien co chu ky</label>
        <input type="checkbox" style="margin-left:20px;" id="cycle" onchange="checkck()" disabled><br>

        <div id="chuky" style="visibility: hidden; display:none;">
            <label for="datestart">ngay bat dau(*) </label>
            <input type="date" class="text" id="datestart">
            <br><br>
            <label for="dateend">ngay ket thuc(*) </label>
            <input type="date" class="text" id="dateend">
        </div>
         -->
        <div id="trongngay" >
            <label for="MissionDate">ngay(*) </label>
            <input type="date" class="text" id="MissionDate" name="MissionDate">

        </div>
        <label for="limitMember">gioi han thanh vien:</label>
        <input type="checkbox" class="text" id="limitMember" name="limitMember" onchange="checkg()">
        <br>
        <br>
        <label for="quanityMember">so thanh vien toi da:</label>
        <input type="number" class="text" id="quanityMember" name="quanityMember" value='0' disabled>
       
        <input type="text" class="text" style="display: none;" id="GroupMission" name="GroupMission" value='{{$idgroup}}'>

        <br><br>
        <label>ghi chu: <textarea id="note" class="text" name="noteMission" rows="4" cols="38">

                                    </textarea>
        </label>
        <br>
        @if ($che==1)
        <input type="submit" id="sudmit">
        @else
        <input type="submit" id="sudmit"  disabled>
        
        @endif
        
        <input type="button" onclick="lammoi()" value="lam moi">
        @if ($che!=1)
       <div>ban chua dang nhap</div>
        
        @endif
    </div>





</form>

</div>


<script>
    function checkg() {
        var g = document.getElementById("quanityMember");

        g.disabled = !g.disabled;

    }
    function lammoi() {
        document.getElementById("FormCreate").reset();

       
    }
</script>