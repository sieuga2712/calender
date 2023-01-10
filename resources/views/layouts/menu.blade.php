@php
$use="";

$che=\App\Http\Controllers\Auth\loginController::checklogin();
if($che==1)
$use=\App\Http\Controllers\Auth\loginController::userlogin();


@endphp

<div id="menu">

<ul>

    <li>

        <a href="/home"> <img src="{{ asset('images/home.png') }}">
            <p>trang chủ</p>
        </a>
    </li>
    <li>
        <a href="/detail"><img src="{{ asset('images/calendar.png') }}">
            <p>lịch cá nhân</p>
        </a>
    </li>
    <li>
        <a href="/group"><img src="{{ asset('images/group.png') }}">
            <p>danh sách nhóm</p>
        </a>
    </li>
    <li>
        <a href="/information"><img src="{{ asset('images/infomation.png') }}">
            <p>thông tin cá nhân</p>
        </a>
    </li>
    @if ($che==1)
    <li>
        
            
            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <img src="{{ asset('images/exit.png') }}"><br>
                                        {{ __('đăng xuất') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    </form>
        </a>
    </li>
    @endif

</ul>


</div>