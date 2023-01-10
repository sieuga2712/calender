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
<form action="/createGroup" method="POST" style="margin-left:300px;margin-top:20px;">
{{csrf_field()}}
    <h2>nhập thông tin sự kiện</h2>

    <div>
        <label for="namegroup">tên nhóm(*): </label>
        <input type="text" class="text" id="namegroup" name="namegroup">
        <br><br>
        <label for="maxmember">số thành viên tối đa: </label>
        <input type="number" class="text" id="maxmember" name="maxmenber">
        <br><br>
        <label for="password">mật khẩu nhóm: </label>
        <input type="number" class="text" id="password" name="password">
        <br><br>

        
        
        
        
        <br>
        @if ($che==1)
        <input type="submit" id="sudmit">
        @else
        <input type="submit" id="sudmit"  disabled>
        
        @endif
        
        <input type="button" onclick="lammoi()" value="lam moi">
        @if ($che!=1)
       <div>bạn chưa đăng nhập</div>
        
        @endif
    </div>





</form>