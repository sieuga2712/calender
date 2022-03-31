<div id="menu">

<ul>

    <li>

        <a href="/home"> <img src="{{ asset('images/calendar.jpg') }}">
            <p>trang chu</p>
        </a>
    </li>
    <li>
        <a href="/detail"><img src="{{ asset('images/calendar.jpg') }}">
            <p>danh sach su kien</p>
        </a>
    </li>
    <li>
        <a href="/group"><img src="{{ asset('images/calendar.jpg') }}">
            <p>quan ly nhom</p>
        </a>
    </li>
    <li>
        <a href="/information"><img src="{{ asset('images/calendar.jpg') }}">
            <p>thong tin ca nhan</p>
        </a>
    </li>
    <li>
        
            
            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <img src="{{ asset('images/calendar.jpg') }}"><br>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    </form>
        </a>
    </li>

</ul>


</div>