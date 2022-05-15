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


@endphp
<form action="/createPersonalEvent" id="FormCreate" method="POST" style="margin-left:300px;margin-top:20px;">
    {{csrf_field()}}
    <h2>nhap thong tin su kien</h2>

    <div>
        <label for="Eventname">ten su kien(*): </label>
        <input type="text" class="text" id="Eventname" name="Eventname">
        <br><br>
        <label for="cycle" style="margin-left:20px;" disabled>su kien dai ngay</label>
        <input type="checkbox" style="margin-left:20px;" id="cycle" onchange="checkck()"><br>

        <br><br>


        <div id="daingay" style="visibility: hidden; display:none;">
            <label for="radio_chuky" style="margin-left:20px;" >su kien co chu ky</label>
            <input type="radio" name="radio_chuky" style="margin-left:20px;" id="radio_chuky" onchange="check_chuky()" checked>
            <br>
            <label for="radio_khongchuky" style="margin-left:20px;" >su kien khong chu ky</label>
            <input type="radio" name="radio_chuky" style="margin-left:20px;" id="radio_khongchuky" onchange="check_chuky()">
            <br>
            <div id="cochuky">
                <label for="datestart">ngay bat dau(*) </label>
                <input type="date" class="text" id="datestart" onchange="StartDayCheck(this.id)">
                <br><br>

                <label for="dateend">ngay ket thuc(*) </label>
                <input type="date" class="text" id="dateend" onchange="EndDayCantBePast(this.id)">
            </div>
            <div id="khongchuky" style="display: none;">
                <label for="kck_starttime">thoi gian bat dau: </label>
                <input type="time" class="text" id="kck_starttime" name="kck_starttime" onchange="checktimekck(this.id)">
                <br><br>
                <label for="kck_endtime">thoi gian ket thuc:</label>
                <input type="time" class="text" id="kck_endtime" name="kck_endtime"onchange="checktimekck(this.id)">
                <br>
                <label for="kck_date">ngay(*) </label>
                <input type="date" class="text" id="kck_date" name="kck_date" onchange="EndDayCantBePast(this.id)">
            </div>
            <br>
            <input type="button" onclick="writecode()" value="nhap">
            <div id="write-code">

            </div>
        </div>

        <div id="trongngay" style="visibility: visible;">
            <label for="startname">thoi gian bat dau: </label>
            <input type="time" class="text" id="startname" name="startname" onchange="checktimeinday(this.id)">
            <br><br>
            <label for="endname">thoi gian ket thuc:</label>
            <input type="time" class="text" id="endname" name="endname" onchange="checktimeinday(this.id)">
            <br>
            <label for="Eventdate">ngay(*) </label>
            <input type="date" class="text" id="Eventdate" name="Eventdate" onchange="EndDayCantBePast(this.id)">

        </div>
        <br>


        <br><br>
        <label>ghi chu: <textarea id="note" class="text" name="note" rows="4" cols="38">

                                    </textarea>
        </label>
        <br>
        @if ($che==1)
        <input type="submit" id="sudmit">
        @else
        <input type="submit" id="sudmit" disabled>

        @endif

        <input type="button" onclick="lammoi()" value="lam moi">
        @if ($che!=1)
        <div>ban chua dang nhap</div>

        @endif
    </div>





</form>
<script>
    function checkck() {
        var ck = document.getElementById("daingay");
        var n = document.getElementById("trongngay");

        if (ck.style.visibility.toString() == "hidden") {
            ck.style.visibility = "visible";
            n.style.visibility = "hidden";
            ck.style.display = "inline-block";
            n.style.display = "none";
        } else {
            ck.style.visibility = "hidden";
            n.style.visibility = "visible";
            ck.style.display = "none";
            n.style.display = "inline-block";
        }


    }

    function lammoi() {
        document.getElementById("FormCreate").reset();

    }
    function check_chuky(){
        var ck = document.getElementById("cochuky");
        var n = document.getElementById("khongchuky");

        if (ck.style.visibility.toString() == "hidden") {
            ck.style.visibility = "visible";
            n.style.visibility = "hidden";
            ck.style.display = "inline-block";
            n.style.display = "none";
        } else {
            ck.style.visibility = "hidden";
            n.style.visibility = "visible";
            ck.style.display = "none";
            n.style.display = "inline-block";
        }
    }
   

    function writecode() {

        var i = document.getElementById("Eventname");
        var node = document.getElementById('write-code');
        var newNode = document.createElement('p');
        var start=document.getElementById("startname").value;
        var end=document.getElementById("endname").value;
        var date=document.getElementById("Eventdate").value;
        newNode.appendChild(document.createTextNode(start+"-"+end+" "+date));
        node.appendChild(newNode);
    }
</script>