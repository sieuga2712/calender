<div class="main-group">
    <div class="table-details">

        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">email</th>
                                <th class="cell100 column2">name</th>

                                <th class="cell100 column4">level</th>
                                <th class="cell100 column5">so nhiem vu</th>
                                <th class="cell100 column6">tinh trang</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            @php
                            $listmember=\App\Http\Controllers\GroupController::ListMember();
                            @endphp
                            @foreach($listmember as $group)
                            @php
                            $informem=\App\Http\Controllers\DetailController::inforMember($group->email);
                            @endphp
                            <tr class="row100 body" onclick="clickMe('{{$group->id}}')">
                                <td class="cell100 column1">{{$group->email}}</td>
                                <td class="cell100 column2">{{$informem->name}} </td>

                                <td class="cell100 column4">
                                    <input id="level_Member_{{$group->email}}" onchange="changelv('{{$group->email}}','{{$group->idGroup}}')" type="number" min="2" max="3" step="1" value="{{$group->level}}">

                                </td>
                                <td class="cell100 column5">so nhiem vu</td>

                                <td class="cell100 column6"><button>chua tham gia</button></td>

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
    function changelv(e,id) {
        var a = document.getElementById("level_Member_"+e);
        
        if (a.value > 3)
            a.value = 3;
        if (a.value < 2)
            a.value = 2;



        $.ajax({
            url: '/changelv?email=' + e+'&idgroup='+id+'&level='+a.value,
            type: 'GET',

        }).done(function(Response) {
            
           if(Response=="false")
                alert("level khong kha dung");

        });

    }
</script>