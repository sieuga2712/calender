<div class="main-group">


@php
$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
if($che==1)
$use=\App\Http\Controllers\Auth\loginController::userlogin();

$idgroup=$_GET['id'];
$informem=\App\Http\Controllers\GroupController::checkMembers();

@endphp
<form action="/createGroupMission" id="FormCreate" method="POST" style="margin-left:300px;margin-top:20px;" onsubmit="return validateForm()">
{{csrf_field()}}
    <h2>nhap thong tin nhiem vu</h2>

    

<div>
    <label for="Group_Mission_Name">ten nhiem vu(*): </label>
    <input type="text" class="text" id="Group_Mission_Name" name="Group_Mission_Name">
    <br><br>
    <label for="limitMember">gioi han thanh vien:</label>
        <input type="checkbox" class="text" id="limitMember" name="limitMember" onchange="checkg()">
        <label for="quanityMember">so thanh vien toi da:</label>
        <input type="number" class="text" id="quanityMember" name="quanityMember" value='0' disabled>
        <br>
    <label for="cycle" style="margin-left:20px;" disabled>su kien dai ngay</label>
    <input type="checkbox" style="margin-left:20px;" id="cycle" name="cycle" value="cycle" onchange="checkck(this.id)"><br>
        <br>
        


        <input type="text" class="text" style="display: none;" id="GroupMission" name="GroupMission" value='{{$idgroup}}'>
    <div id="daingay" style="visibility: hidden; display:none;">
        <label for="radio_chuky" style="margin-left:20px;">nhiem vu co chu ky</label>
        <input type="radio" name="radio_chuky" style="margin-left:20px;" id="radio_chuky" name="radio_chuky" onchange="check_chuky()" checked>

        <label for="radio_khongchuky" style="margin-left:20px;">nhiem vu khong chu ky</label>
        <input type="radio" name="radio_chuky" style="margin-left:20px;" id="radio_khongchuky" name="radio_khongchuky" onchange="check_chuky()">
        <br>
        <!-- su kien co chu ky-->


        <div id="cochuky">
            <label for="datestart">ngay bat dau(*) </label>
            <input type="date" class="text" id="datestart" name="datestart" onchange="StartDayCheck(this.id)">
            <br><br>

            <label for="dateend">ngay ket thuc(*) </label>
            <input type="date" class="text" id="dateend" name="dateend" onchange="EndDayCantBePast(this.id)">
            <br>
            chon thu:<select name="weekday" id="weekday">
                <option value="mon" selected>thu 2</option>
                <option value="tue">thu 3</option>
                <option value="wed">thu 4</option>
                <option value="thu">thu 5</option>
                <option value="fri">thu 6</option>
                <option value="sat">thu 7</option>
                <option value="sun">chu nhat</option>
            </select>
            <br>
            <label for="ck_starttime">thoi gian bat dau: </label>
            <input type="time" class="text" id="ck_starttime" name="ck_starttime" onchange="checktimeck(this.id)">
            <br><br>
            <label for="ck_endtime">thoi gian ket thuc:</label>
            <input type="time" class="text" id="ck_endtime" name="ck_endtime" onchange="checktimeck(this.id)">

            <br>
            <input type="button" onclick="writecodeck()" value="nhap" id="nhap_codeck">
            <input type="button" value="clear" onclick="clearlistck()">
            <br>danh sach:<br>

            <ul id="write-codeck" name="listevck" class="write-codeck">
                <li> <input type="text" class="text" id="texttest" name="textt" value="test"></li>
            </ul>
        </div>
        <!--END  su kien co chu ky-->


        <!-- su kien khong chu ky-->
        <div id="khongchuky" style="display: none;">
            <label for="kck_starttime">thoi gian bat dau: </label>
            <input type="time" class="text" id="kck_starttime" name="kck_starttime" onchange="checktimekck(this.id)">
            <br><br>
            <label for="kck_endtime">thoi gian ket thuc:</label>
            <input type="time" class="text" id="kck_endtime" name="kck_endtime" onchange="checktimekck(this.id)">
            <br>
            <label for="kck_date">ngay(*) </label>
            <input type="date" class="text" id="kck_date" name="kck_date" onchange="EndDayCantBePast(this.id)">
            <input type="button" onclick="writecodekck()" value="nhap" id="nhap_codekck">
            <input type="button" value="clear" onclick="clearlistkck()">
            <br>danh sach:<br>

            <ul id="write-codekck" class="write-codekck">

            </ul>
        </div>


        <!--END su kien khong  chu ky-->
    </div>

    <div id="trongngay" >
        <label for="startname">thoi gian bat dau: </label>
        <input type="time" class="text" id="startname" name="startname" onchange="checktimeinday(this.id)">
        <br><br>
        <label for="endname">thoi gian ket thuc:</label>
        <input type="time" class="text" id="endname" name="endname" onchange="checktimeinday(this.id)">
        <br>
        <label for="Missiondate">ngay(*) </label>
        <input type="date" class="text" id="Missiondate" name="Missiondate" onchange="EndDayCantBePast(this.id)">

    </div>
    <br>


    <br><br>
    <label>ghi chu: <textarea id="note" class="text" name="note" rows="4" cols="38">

                                </textarea>
    </label>
    <br>
    @if($informem->level<=2)
    <input type="submit" id="sudmit">
    @else
    ban khong co quyen tao nhiem vu<br>
    <input type="submit" id="sudmit" disabled>

    @endif

    <input type="button" onclick="lammoi()" value="lam moi">
   
</div>




</form>

</div>


<script>
    function checkg() {
        var g = document.getElementById("quanityMember");
        if(g.disabled==true)
            g.disabled = false;
        else
        g.disabled = true;
    }
    function lammoi() {
        document.getElementById("FormCreate").reset();

       
    }
    var idlist=0;
    function validateForm() {
        var name = document.getElementById("Group_Mission_Name");
        if (name.value == "") {
            alert("chua dien ten");
            return false;
        }
        if (document.getElementById("Missiondate").value =="" && document.getElementById("cycle").checked==false) {
            alert("chua chon ngay");
            return false;
        }
        if (document.getElementById("datestart").value ==""&& document.getElementById("cycle").checked==true &&document.getElementById("radio_chuky").checked==true) {
            alert("chua chon ngay bat dau chu ky");
            return false;
        }
        if (document.getElementById("dateend").value ==""&& document.getElementById("cycle").checked==true &&document.getElementById("radio_chuky").checked==true) {
            alert("chua chon ngay ket thuc chu ky");
            return false;
        }
        if (document.getElementById("kck_starttime").value ==""&& document.getElementById("cycle").checked==true &&document.getElementById("radio_khongchuky").checked==true) {
            alert("chua chon ngay bat dau");
            return false;
        }
        if (document.getElementById("kck_endtime").value ==""&& document.getElementById("cycle").checked==true &&document.getElementById("radio_khongchuky").checked==true) {
            alert("chua chon ngay ket thuc");
            return false;
        }
        return true;
    }
</script>