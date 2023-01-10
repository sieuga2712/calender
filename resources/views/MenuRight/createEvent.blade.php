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
<form action="/createPersonalEvent" id="FormCreate" method="POST" style="margin-left:300px;margin-top:20px;" onsubmit="return validateForm()">
    {{csrf_field()}}
    <h2>nhập thông tin sự kiện</h2>

    <div>
        <label for="Eventname">tên sự kiện(*): </label>
        <input type="text" class="text" id="Eventname" name="Eventname">
        <br><br>
        <select name="typeEvent" id="typeEvent" onchange="checkck()">
            <option value="trong ngay"  selected >trong Ngay</option>
            <option value="Chu Ky"  >co chu ky</option>
            <option value="khong Chu Ky"  >khong chu ky</option>
            
        </select>
       <br>
       <br>



        <div id="daingay" style="visibility: hidden; display:none;">
         
            <!-- sự kiện co chu ky-->


            <div id="cochuky">
                <label for="datestart">ngày bắt đầu(*) </label>
                <input type="date" class="text" id="datestart" name="datestart" onchange="StartDayCheck(this.id)">
                <br><br>

                <label for="dateend">ngày kết thúc(*) </label>
                <input type="date" class="text" id="dateend" name="dateend" onchange="EndDayCantBePast(this.id)">
                <br>
                chọn thứ:<select name="weekday" id="weekday" style="width: 100px;">
                    <option value="mon" selected>thứ 2</option>
                    <option value="tue">thứ 3</option>
                    <option value="wed">thứ 4</option>
                    <option value="thứ">thứ 5</option>
                    <option value="fri">thứ 6</option>
                    <option value="sat">thứ 7</option>
                    <option value="sun">chu nhat</option>
                </select>
                <br>
                <label for="ck_starttime">thời gian bắt đầu: </label>
                <input type="time" class="text" id="ck_starttime" name="ck_starttime" onchange="checktimeck(this.id)">
                <br><br>
                <label for="ck_endtime">thời gian kết thúc:</label>
                <input type="time" class="text" id="ck_endtime" name="ck_endtime" onchange="checktimeck(this.id)">

                <br>
                <input type="button" onclick="writecodeck()" value="nhap" id="nhap_codeck">
                <input type="button" value="clear" onclick="clearlistck()">
                <br>danh sách:<br>

                <ul id="write-codeck" name="listevck" class="write-codeck">

                </ul>
            </div>
            <!--END  sự kiện co chu ky-->


            <!-- sự kiện khong chu ky-->
            <div id="khongchuky" style="display: none;">
                <label for="kck_starttime">thời gian bắt đầu: </label>
                <input type="time" class="text" id="kck_starttime" name="kck_starttime" onchange="checktimekck(this.id)">
                <br><br>
                <label for="kck_endtime">thời gian kết thúc:</label>
                <input type="time" class="text" id="kck_endtime" name="kck_endtime" onchange="checktimekck(this.id)">
                <br>
                <label for="kck_date">ngày(*) </label>
                <input type="date" class="text" id="kck_date" name="kck_date" onchange="EndDayCantBePast(this.id)">
                <input type="button" onclick="writecodekck()" value="nhap" id="nhap_codekck">
                <input type="button" value="clear" onclick="clearlistkck()">
                <br>danh sách:<br>

                <ul id="write-codekck" class="write-codekck">

                </ul>
            </div>


            <!--END sự kiện khong  chu ky-->
        </div>

        <div id="trongngay" style="visibility: visible;">
            <label for="startname">thời gian bắt đầu: </label>
            <input type="time" class="text" id="startname" name="startname" onchange="checktimeinday(this.id)">
            <br><br>
            <label for="endname">thoi gian kết thúc:</label>
            <input type="time" class="text" id="endname" name="endname" onchange="checktimeinday(this.id)">
            <br>
            <label for="Eventdate">ngày(*) </label>
            <input type="date" class="text" id="Eventdate" name="Eventdate" onchange="EndDayCantBePast(this.id)">

        </div>
        <br>


        <br><br>
        <label>ghi chú: <textarea id="note" class="text" name="note" rows="4" cols="38">

                                    </textarea>
        </label>
        <br>
        @if ($che==1)
        <input type="submit" id="sudmit">
        @else


        @endif

        <input type="button" onclick="lammoi()" value="lam moi">
        @if ($che!=1)
        <div>bạn chưa đăng nhập</div>

        @endif
    </div>





</form>
<script>
    var idlist = 0;

    function validateForm() {
        var name = document.getElementById("Eventname");

        if (name.value == "") {
            alert("chua dien ten");
            return false;
        }
        if (document.getElementById("Eventdate").value == "" && document.getElementById("cycle").checked == false) {
            alert("chua chon ngay");
            return false;
        }
        if (document.getElementById("datestart").value == "" && document.getElementById("cycle").checked == true && document.getElementById("radio_chuky").checked == true) {

            alert("chua chon ngay bat dau chu ky");
            return false;
        }
        if (document.getElementById("dateend").value == "" && document.getElementById("cycle").checked == true && document.getElementById("radio_chuky").checked == true) {
            alert("chua chon ngay ket thuc chu ky");
            return false;
        }

        return true;
    }
</script>