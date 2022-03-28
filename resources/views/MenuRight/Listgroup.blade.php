@php
$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
if($che==1)
$use=\App\Http\Controllers\Auth\loginController::userlogin();


@endphp

@if($che==1)
<div class="detail-event">

    <div class="filter-tool" style="background-color: red;">
        <button type="button" style="background-color: green;" ><a href="/createGroup">tao nhom</a> </button>
    </div>

    @if ($che==1)
        
       
    <div class="table-details">

        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">ten nhom</th>
                                <th class="cell100 column2">nhom truong</th>
                                
                                <th class="cell100 column4">thanh vien</th>
                                <th class="cell100 column5">ghi chu</th>
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


    @else
        <div>ban chua dang nhap</div>
        
    @endif



</div>

@else
<div>ban chua dang nhap</div>

@endif

<script>
    function clickMe(e){
       
   
   alert(e);
   
}
    
</script>

<style>
    .column1 {
  width: 30%;
  padding-left: 40px;
}

.column2 {
  width: 20%;
}



.column4 {
  width: 10%;
}

.column5 {
  width: 20%;
}
.column6{
  width: 20%;
}
</style>