<div class="left-side-bar">
    <div class="brand-logo" style="padding-top: 30px; padding-bottom: 30px; padding-left: 15px;">
        <a href="">
            <img src="{{asset('vendors/images/logo-inventory-3b.png')}}" alt="" style="height: 65px" class="dark-logo">
            <img src="{{asset('vendors/images/logo-inventory-3b.png')}}" alt="" style="height: 65px" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="garis-sidebar"></div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                @if(Auth::user()->role != 'Client')
                <li>
                    <a href="{{ url('/dashboard') }}" class="dropdown-toggle no-arrow @yield('menu_home')">
                        <span class="micon dw dw-monitor"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/history') }}" class="dropdown-toggle no-arrow @yield('menu_history')">
                        <span class="micon dw dw-library"></span><span class="mtext">History Dashboard</span>
                    </a>
                </li>
                <li hidden>
                    <a href="{{ url('/controlling') }}" class="dropdown-toggle no-arrow @yield('menu_controlling')">
                        <span class="micon dw dw-thermometer"></span><span class="mtext">Controlling</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/threshold-suhu') }}" class="dropdown-toggle no-arrow @yield('menu_controlling')">
                        <span class="micon dw dw-thermometer"></span><span class="mtext">Set Threshold Temp</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class=""></span><span class="mtext">Master</span>
                    </a>
                    <ul class="submenu" style="display: block;">
                        @if(Auth::user()->role == 'Administrator')
                        <li><a href="{{ route('masterContainer.index') }}" class="dropdown-toggle no-arrow @yield('menu_master_container')">Container Master</a></li>
                        <li><a href="{{ route('masterKapal.index') }}" class="dropdown-toggle no-arrow @yield('menu_master_kapal')">Vessel Master</a></li>
                        <li><a href="{{ route('pelabuhan.index') }}" class="dropdown-toggle no-arrow @yield('menu_pelabuhan')">Port Master</a></li>
                        @endif
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class=""></span><span class="mtext">Product</span>
                            </a>
                            <ul class="submenu child">
                                <li><a href="{{ route('JenisBarang.index')}}" class="dropdown-toggle no-arrow @yield('menu_jenis_barang')">Types of Products</a></li>
                                <li><a href="{{ route('barang.index')}}" class="dropdown-toggle no-arrow @yield('menu_barang')">Product Master</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endif
                @can('manage-booking')
                <li>
                    <a href="{{url('/booking/create')}}" class="dropdown-toggle no-arrow @yield('menu_booking')">
                        <span class="micon dw dw-invoice-1"></span><span class="mtext">Booking Form</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/booking') }}" class="dropdown-toggle no-arrow @yield('status_booking')">
                        <span class="micon dw dw-edit"></span><span class="mtext">Status Booking</span>
                    </a>
                </li>
                @endcan
                @can('manage-MasterData')
                <li>
                    <a href="{{ route('container.index') }}" class="dropdown-toggle no-arrow @yield('menu_container')">
                        <span class="micon dw dw-box"></span><span class="mtext">Container</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class=""></span><span class="mtext">Vessel Schedule</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('trip.index')}}" class="dropdown-toggle no-arrow @yield('menu_trip')">Vessel Trip</a></li>
                        <li><a href="{{ route('JadwalKapal.index') }}" class="dropdown-toggle no-arrow @yield('menu_jadwal_kapal')">Vessel Schedule</a></li>
                    </ul>
                </li>
                {{-- @if(Auth::user()->role == 'Administrator') --}}
                <li>
                    <a href="{{ url('/booking') }}" class="dropdown-toggle no-arrow @yield('menu_booking')">
                        <span class="micon dw dw-edit"></span><span class="mtext">Booking</span>
                    </a>
                </li>
                {{-- @endif --}}
                @endcan
                @if(Auth::user()->role != 'Client')
                <li>
                    <a href="{{ route('transaksi.index') }}" class="dropdown-toggle no-arrow @yield('menu_transaksi')">
                        <span class="micon dw dw-invoice"></span><span class="mtext">Transaksi</span>
                    </a>
                </li>
                @endif
                @can('manage-MasterData')
                <li>
                    <a href="{{ route('user.index') }}" class="dropdown-toggle no-arrow @yield('menu_user')">
                        <span class="micon fa fa-users"></span><span class="mtext">Data User</span>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
