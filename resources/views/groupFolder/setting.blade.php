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
    <h3>doi nhom truong</h3>

    
    <div style="padding-left:50px ;" id="change-lv1">
        nhom truong moi:
        <input type="text" id="newlv1">
        <input type="button" onclick="changeadmin()" value="xac nhan" {{$s}}>
        <br>
    </div>



    <h3>xoa group</h3>
    <div style="padding-left:50px ;">
        bac xac nhap xoa group:
        <input type="password" id="passlv1">
        <input type="button" value="xac nhan" onclick="deletegroup()" {{$s}}>
    </div>

    <br>
    <h3>doi mat khau nhom</h3>
    <div style="padding-left:50px ;">
        mat khau cu:
        <input type="password" id="oldpass"><br>
        mat khau moi:
        <input type="password" id="newpass"><br>
        xac nhan mat khau moi:
        <input type="password" id="newpassre"><br>
        <input type="button" value="xac nhan" onclick="changepass()" {{$s}}>
    </div>

    <br>
@endif
    <h3>thoat group</h3>
    <div style="padding-left:50px ;">
    <form action="/outgroup" id="FormCreate" method="POST"  onsubmit="return validateForm()">
    {{csrf_field()}}
        <input type="text" name="id" value={{$id}}  style="display: none;">
        
        <input type="submit" value="xac nhan" {{$out}}>
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
</script>