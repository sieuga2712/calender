<div class="main-group">
    <div class="table-details">

        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">email</th>
                                <th class="cell100 column2">tên thành viên</th>

                                <th class="cell100 column4">cấp độ</th>

                                <th class="cell100 column6">tùy chọn</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            @php
                            $m= \App\Http\Controllers\GroupController::checkMembers();
                            $listmember=\App\Http\Controllers\GroupController::ListMember();

                            @endphp
                            @foreach($listmember as $group)
                            @php
                            $informem=\App\Http\Controllers\DetailController::inforMember($group->email);

                            @endphp
                            <tr class="row100 body" onclick="clickMe('{{$group->id}}')">
                                <td class="cell100 column1">{{$group->email}}</td>
                                <td class="cell100 column2">{{$informem->name}} </td>
                                @if($m->level==1)
                                <td class="cell100 column4">
                                @if($group->level !=1)
                                    <input id="level_Member_{{$group->email}}" onchange="changelv('{{$group->email}}','{{$group->idGroup}}')" type="number" min="2" max="3" step="1" value="{{$group->level}}">
                                @else
                                {{$group->level}}
                                    @endif
                                </td>


                                <td class="cell100 column6">
                                   @if($group->level !=1)
                                    <button class="my-btn-steel-blue" onclick="kickmem({{$informem->id}},'{{$group->idGroup}}')" >xoa</button>
                                    @endif
                                </td>
                                @else

                                <td class="cell100 column4">

                                   {{$group->level}}

                                </td>


                                <td class="cell100 column6">
                                   
                                    
                                </td>
                                @endif

                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>



</div>

<script>
    function changelv(e, id) {
        var a = document.getElementById("level_Member_" + e);

        if (a.value > 3)
            a.value = 3;
        if (a.value < 2)
            a.value = 2;



        $.ajax({
            url: '/changelv?email=' + e + '&idgroup=' + id + '&level=' + a.value,
            type: 'GET',

        }).done(function(Response) {

            if (Response == "false")
                alert("level khong kha dung");

        });

    }

    function kickmem(e, id) {



        $.ajax({
            url: '/kickmember?mem=' + e + '&idgroup=' + id,
            type: 'GET',
            data: {
                mem: e,
                ig: id
            },

        }).done(function(Response) {

            if (Response == "false")
                alert("level khong kha dung");

        });

    }
</script>