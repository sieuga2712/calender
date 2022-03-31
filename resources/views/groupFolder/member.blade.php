<div class="main-group">
<div class="table-details">

<div class="wrap-table100">
    <div class="table100 ver1 m-b-110">
        <div class="table100-head">
            <table>
                <thead>
                    <tr class="row100 head">
                        <th class="cell100 column1">ten</th>
                        <th class="cell100 column2">chuc vu</th>
                        
                        <th class="cell100 column4">nickname</th>
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
                        $listgroup=\App\Models\Group::getGroup();
                    @endphp
                    @foreach($listgroup as $group)
                    @php
                        $numbermember=\App\Models\Group::numberMember($group->id);
                        $level1=\App\Models\Group::level1Group($group->id);
                        $ismem=\App\Models\Group::isMember($group->id);
                    @endphp         
                    <tr class="row100 body"  onclick="clickMe({{$group->id}})">
                        <td class="cell100 column1">{{$group->name}}</td>
                        <td class="cell100 column2">{{$level1}} </td>
                        
                        <td class="cell100 column4">{{$numbermember}}</td>
                        <td class="cell100 column5">ghi chu</td>
                        @if($ismem==0)
                        <td class="cell100 column6"><button>chua tham gia</button></td>
                        @else
                        <td class="cell100 column6"><button>da tham gia</button></td>
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