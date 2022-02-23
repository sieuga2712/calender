@include('layouts.app')

<body>
    <!--menu left-->
    <div class="main-menu-cal">
        <div id="menu">

            <ul>

                <li>

                    <a href=""> <img src="{{ asset('images/calendar.jpg') }}">
                        <p>trang chu</p>
                    </a>
                </li>
                <li>
                    <a href=""><img src="{{ asset('images/calendar.jpg') }}">
                        <p>danh sach su kien</p>
                    </a>
                </li>
                <li>
                    <a href=""><img src="{{ asset('images/calendar.jpg') }}">
                        <p>quan ly nhom</p>
                    </a>
                </li>
                <li>
                    <a href=""><img src="{{ asset('images/calendar.jpg') }}">
                        <p>thong tin ca nhan</p>
                    </a>
                </li>
                <li>
                    <a href=""><img src="{{ asset('images/calendar.jpg') }}">
                        <p>dang xuat</p>
                    </a>
                </li>

            </ul>


        </div>
        <!-- end menu left-->

        <div id="calendar-event">

            <!--calendar right-->
            <!-- calendar-->

            @include('index')

            <!-- end calendar-->

            <!--event right-->


            <!-- end event right-->

            <!--end calendar right-->




            <div class="right-area" style="background-color: red;">
                
                <input  id="wrap" class="tough" type="checkbox" />
                
                <div class="event-menu">

                <label for="wrap" class="wrap-menuin">a</label>





                </div>
            </div>
        </div>
    </div>
</body>