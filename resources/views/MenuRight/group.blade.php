<div class="group">
    <div class="menu-for-group">
        <ul>
            <li class="menugroup" onclick="changeMenuGuild('member')">thanh vien</li>
            <li class="menugroup" onclick="changeMenuGuild('mission')">nhiem vu</li>
            @php
            $informem=\App\Models\memberGroup::checkMember();

            @endphp
            @if($informem[0]->level<=2)
            <li class="menugroup" onclick="changeMenuGuild('createMission')">tao nhiem vu</li>
            @else
            <li class="menugroup" disabled>tao nhiem vu</li>
            @endif
            <li class="menugroup" onclick="changeMenuGuild('application')">don xin</li>
            <li class="menugroup" onclick="changeMenuGuild('setting')">thiet lap</li>

        </ul>





    </div>

    <div class="main-group">

        <div id="member" style="visibility: visible;">
            @include('groupFolder.member')
        </div>
        <div id="application" style="visibility: hidden;">
            @include('groupFolder.application')
        </div>
        <div id="createMission" style="visibility: hidden;">
            @include('groupFolder.createMission')
        </div>
        <div id="mission" style="visibility: hidden;">
            @include('groupFolder.mission')
        </div>
        <div id="setting" style="visibility: hidden;">
            @include('groupFolder.setting')


        </div>
    </div>
    <script>
        function allHidden() {
            const listmenu = ["member", "application", "createMission", "mission", "setting"];
            for (let i = 0; i < 5; i++) {
                var a = document.getElementById(listmenu[i]);
                if (a.style.visibility != "hidden")
                    a.style.visibility = "hidden";
                a.style.display = "none";
            }


        }

        function changeMenuGuild(e) {
            allHidden();
            var a = document.getElementById(e);
            a.style.visibility = "visible";
            a.style.display="inline-block";


        }
    </script>