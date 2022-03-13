<div class="detail-event">

    <div class="filter-tool" style="background-color: red;">
        <button type="button" ><a href="/create">tao su kien</a> </button>
    </div>


    <div class="table-details">

        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">ten su kien</th>
                                <th class="cell100 column2">loai</th>
                                <th class="cell100 column3">thoi gian</th>
                                <th class="cell100 column4">date</th>
                                <th class="cell100 column5">group</th>
                                <th class="cell100 column6">ghi chu</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            <tr class="row100 body" id="123" onclick="clickMe(this)">
                                <td class="cell100 column1">Like a butterfly</td>
                                
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">13/02/2000</td>
                                <td class="cell100 column5">none</td>
                                <td class="cell100 column6">none</td>
                            </tr>
                            <tr class="row100 body" id="321"onclick="clickMe(this)">
                                <td class="cell100 column1">Like a butterfly</td>
                                
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">13/02/2000</td>
                                <td class="cell100 column5">none</td>
                                <td class="cell100 column6">none</td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>






</div>
<div class="right-area" style="background-color: red;">

<input id="wrap" class="tough" type="checkbox" />

<div class="event-menu">

    <label for="wrap" class="wrap-menuin">a</label>





</div>
</div>

<script>
    function clickMe(elm){
       
   var check=document.querySelector('#wrap');
   if(check.checked==false)
   check.checked=true;

   else
        check.checked=false;
   
   
}
    
</script>
<style>
    button {
  border: 2px solid;
  color: black;
  padding: 5px 3px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 2px 2px;
  cursor: pointer;
}
</style>