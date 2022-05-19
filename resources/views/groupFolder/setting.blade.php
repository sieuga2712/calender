<div class="main-group">
    <li onclick="hiddenSetting('change-lv1')" style="width: 300px;">
        <div style="border:solid 1px">nhom truong</div>

        <div class="hidden" style="padding-left:50px ;" id="change-lv1">
            nhom truong moi:
            <input type="text" id="newlv1">
            <input type="button" value="xac nhan">
            <br>
        </div>


    <li onclick="hiddenSetting('delete')" style="width: 300px;">
        <div style="border:solid 1px">delete group</div>
    </li>
    <div class="hidden" id="delete">
        bac xac nhap xoa group:
        <input type="button" value="xac nhan" onclick="deletegroup()">
            <br>
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
    function deletegroup(){
        var id=<?php echo $_GET['id'] ?>;
     

        $.ajax({
            url: "/deleteGroup",
            type:"GET",
            data: {id:id},

        }).done(function(Response) {
            window.location.href = "/";

        });
      
      
    }
</script>