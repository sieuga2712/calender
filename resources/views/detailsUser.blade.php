@include('layouts.app')

<body>
    <!--menu left-->
    <div class="main-menu-cal">
        @include('layouts.menu')
        <!-- end menu left-->

        <div id="right-menu">
            
            @include('MenuRight.information')


        </div>
    </div>

@include('layouts.footer')
</body>