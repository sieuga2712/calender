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

        <br><br>
        <label for="startname">thoi gian bat dau: </label>
        <input type="time" class="text" id="startname" name="startname" onchange="checktime()">
        <br><br>
        <label for="endname">thoi gian ket thuc:</label>
        <input type="time" class="text" id="endname" name="endname" onchange="checktime()">
        <br>
        <label for="cycle" style="margin-left:20px;" disabled>su kien co chu ky</label>
        <input type="checkbox" style="margin-left:20px;" id="cycle" onchange="checkck()" disabled><br>

        <div id="chuky" style="visibility: hidden; display:none;">
            <label for="datestart">ngay bat dau(*) </label>
            <input type="date" class="text" id="datestart">
            <br><br>
            <label for="dateend">ngay ket thuc(*) </label>
            <input type="date" class="text" id="dateend">
        </div>

        <div id="trongngay" style="visibility: visible;">
            <label for="Eventdate">ngay(*) </label>
            <input type="date" class="text" id="Eventdate" name="Eventdate">

        </div>
        <br><br>
        <label for="group">group: </label>
        <select id="group" class="text" name="group" disabled>
            <option value="0" style="color: red;">none</option>
            <option value="hanoi">cntt02-k59</option>

        </select>
        <label for="checkgroup" style="margin-left:20px;">su kien nhom</label>
        <input type="checkbox" style="margin-left:20px;" id="checkgroup" onchange="checkg()">
        <br><br>
        <label>ghi chu: <textarea id="note" class="text" name="note" rows="4" cols="38">

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
<script>
    function checkg() {
        var g = document.getElementById("group");

        g.disabled = !g.disabled;

    }

    function checkck() {
        var ck = document.getElementById("chuky");
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
    function checktime(){
        var start=document.getElementById("startname");
        var end=document.getElementById("endname");
        
    }
</script>