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
                        $listgroup=\App\Models\Group::ListMember();
                    @endphp
                    @foreach($listgroup as $group)
                     @php
                        $informem=\App\Models\detailUsers::inforMember($group->email);
                     @endphp    
                    <tr class="row100 body"  onclick="clickMe({{$group->id}})">
                        <td class="cell100 column1">{{$group->email}}</td>
                        <td class="cell100 column2">{{$informem[0]->name}} </td>
                        
                        <td class="cell100 column4">{{$group->level}}</td>
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