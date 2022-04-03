<div class="main-group">

@php
$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
if($che==1)
$use=\App\Http\Controllers\Auth\loginController::userlogin();


@endphp

@if($che==1)
<div class="detail-event">

   

    @if ($che==1)


    <div class="table-details">

        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">email </th>
                                <th class="cell100 column2">name</th>

                                <th class="cell100 column4">xac nhan</th>
                                
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            @php
                            $listgroup=\App\Models\Group::checkMember();
                            @endphp
                            @foreach($listgroup as $group)
                            @php
                            $informem=\App\Models\detailUsers::inforMember($group->email);
                            @endphp
                            <tr class="row100 body" id='{{$group->id}}'>
                                <td class="cell100 column1" >{{$group->email}}</td>
                                <td class="cell100 column2">{{$informem[0]->name}} </td>

                                <td class="cell100 column4" >
                                 <div id="checkMember">
                                <input id='{{$group->id}}'  type="submit" onclick="checkMember('{{$group->id}}','1')" value="yes">
                                    
                                 <input id='{{$group->id}}' type="submit" onclick="checkMember('{{$group->id}}','2')" value="no">
                                   
                                 </div>
                                
                                
                               
                               
                                </td>
                               
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


</div>
<script>
   function checkMember(id,checked){
      var check= document.getElementById(id);
         check.style.display = "none";
        var userdata = {
            'id': id,
            'check': checked
        };

        $.ajax({
            url: "/checkApplication",
            type: "GET",
            data:userdata,
           
        }).done(function(Response) {
           
            $("#detail-event").empty();
           $("#detail-event").html(Response);
        }
        );
   }
</script>