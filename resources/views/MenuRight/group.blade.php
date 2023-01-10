@php
$checkmem=\App\Http\Controllers\GroupController::isMember($_GET["id"]);


@endphp
@if($checkmem!=0)
<div class="group">
    <div class="menu-for-group">
        <ul>
            <li class="menugroup" onclick="changeMenuGuild('member')">thành viên</li>
            <li class="menugroup" onclick="changeMenuGuild('mission')">sự kiện nhóm</li>
            @php
            $informem=\App\Http\Controllers\GroupController::checkMembers();

            @endphp
            @if($informem->level<=2)
            <li class="menugroup" onclick="changeMenuGuild('createMission')">tạo sự kiện nhóm</li>
            @else
          
            @endif
            <li class="menugroup" onclick="changeMenuGuild('application')">đơn xin</li>
            <li class="menugroup" onclick="changeMenuGuild('messenge')">thông báo</li>
            <li class="menugroup" onclick="changeMenuGuild('setting')">thiết lập</li>

        </ul>





    </div>

    <div class="main-group">

        <div id="member" >
            @include('groupFolder.member')
        </div>
        <div id="application" style="display:none;">
            @include('groupFolder.application')
        </div>
        @if($informem->level<=2)
        <div id="createMission" style="display:none;">
            @include('groupFolder.createMission')
        </div>
        @endif
        <div id="mission" style="display:none;">
            @include('groupFolder.mission')
        </div>
        <div id="messenge" style="display:none;">
            @include('groupFolder.messenge')
        </div>
        <div id="setting" style="display:none;">
            @include('groupFolder.setting')


        </div>
    </div>
    <script>
        function allHidden() {
            const listmenu = ["member", "application", "createMission", "mission","messenge", "setting"];
            for (let i = 0; i < 6; i++) {
                var a = document.getElementById(listmenu[i]);
                if (a.style.display != "none")
                    a.style.display = "none";
                a.style.display = "none";
            }


        }

        function changeMenuGuild(e) {
            allHidden();
            var a = document.getElementById(e);
            
            a.style.display="block";


        }
    </script>
</div>
@else
        bạn không phải thành viên nhóm
@endif