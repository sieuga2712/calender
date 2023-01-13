<div class="main-group">
    @php

    $member= \App\Http\Controllers\GroupController::checkMembers();
    $s="";
    $out="disabled";
    if($member->level>1)
    {
    $out="";
    }
    $id=$_GET['id'];
    @endphp
    <div style="padding-left:100px ;">
        @if($member->level==1)
        <h3>đổi nhóm trưởng</h3>


        <div style="padding-left:50px ;" id="change-lv1">
            email nhóm trưởng mới:
            <input type="text" id="newlv1">
            <input type="button" onclick="changeadmin()" value="xác nhận" {{$s}}>
            <br><br>
        </div>



        <h3>xóa nhóm</h3>

        <div style="padding-left:50px ;">
            xác nhận xóa nhóm:

            <input type="password" id="passlv1">
            <input type="button" value="xác nhận" onclick="deletegroup()" {{$s}}>
        </div>

        <br>
        <h3>đổi mật khẩu nhóm</h3>

        <div style="padding-left:50px ;">
            mật khẩu cũ:
            <input type="password" id="oldpass"><br>
            mật khẩu mới:
            <input type="password" id="newpass"><br>
            xác nhận mật khẩu mới:
            <input type="password" id="newpassre"><br>
            <input type="button" value="xác nhận" onclick="changepass()" {{$s}}>
        </div>


        @endif
        <br>
        <h3>rời nhóm</h3>

        <div style="padding-left:50px ;">
            <form action="/outgroup" id="FormCreate" method="POST">
                {{csrf_field()}}
                <input type="text" name="id" value={{$id}} style="display: none;">

                <input type="submit" value="xác nhận" {{$out}}>
            </form>
        </div>
    </div>

</div>
<script>
    function hiddenSetting(e) {
        var a = document.getElementById(e);
        if (a.style.display == "none")
            a.style.display = "inline-block";
        else
            a.style.display = "none";

    }

    function changeadmin() {
        var id = <?php echo $_GET['id'] ?>;
        $.ajax({
            url: "/changeadmin",
            type: "GET",
            data: {
                id: id,
                member: document.getElementById("newlv1").value
            },

        }).done(function(Response) {
            if (Response == "false")
                alert("nhap khong ton tai nguoi dung");
            else
                window.location.href = "/";

        });
    }

    function deletegroup() {
        var id = <?php echo $_GET['id'] ?>;


        $.ajax({
            url: "/deleteGroup",
            type: "GET",
            data: {
                id: id,
                pass: document.getElementById("passlv1").value
            },

        }).done(function(Response) {
            if (Response == "false")
                alert("nhap sai mat khau");
            else
                window.location.href = "/";

        });


    }

    function changepass() {
        var id = <?php echo $_GET['id'] ?>;


        $.ajax({
            url: "/changepass",
            type: "GET",
            data: {
                id: id,
                oldpass: document.getElementById("oldpass").value,
                newpass: document.getElementById("newpass").value,
                newpassre: document.getElementById("newpassre").value
            },

        }).done(function(Response) {
            if (Response == "oldpass")
                alert("nhap sai mat khau");
            else if (Response == "newpass")
                alert("nhap lai mat khau moi khong dung");
            else
                window.location.href = "/";


        });
    }

    function confimdelegroup() {


        let text = "xác nhận xóa nhóm này" + name + "!\nmọi sự kiện liên quan đến nhóm cũng sẽ bị xóa.";
        if (confirm(text) == true) {
            deletegroup();
        }
    }
</script>