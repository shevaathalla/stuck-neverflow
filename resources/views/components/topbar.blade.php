<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
        @auth
            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    @if (Auth::user()->notifications->where('read_status','0')->count() > 0)
                    <span class="badge badge-danger badge-counter">{{ Auth::user()->notifications->where('read_status','0')->count()}}</span>
                    @endif                    
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Notifications
                    </h6>
                    @foreach (Auth::user()->notifications->reverse()->take(4) as $notification)
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('notification.show',['user' => Auth::user(),'notification' => $notification]) }}">
                        <div class="mr-3">
                            @if ($notification->type == 'question')
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                            @endif
                            @if ($notification->type == 'answer')
                            <div class="icon-circle bg-success">
                                <i class="fas fa-thumbs-up text-white"></i>
                            </div>
                            @endif                            
                        </div>
                        <div>
                            <div class="small text-gray-500">{{ $notification->created_at }}</div>
                            <span class="{{ $notification->read_status == 0 ? 'font-weight-bold'  : ''}}">{{ $notification->message }}</span>
                        </div>
                    </a>                                        
                    @endforeach
                    <a class="dropdown-item text-center small text-gray-800" href="{{ route('user.notification',['user'=> Auth::user()]) }}">Show All Notifications</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span
                        class="mr-2 d-none d-lg-inline text-gray-600 small text-uppercase">{{ Auth::user()->name }}</span>
                    <img class="img-profile rounded-circle"
                        src="{{ asset('storage/images/avatar/' . Auth::user()->avatar) }}">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        {{ __('Logout') }}
                    </a>
                </div>
            </li>
        @endauth

        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link text-gray-700" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-gray-700" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @endguest

    </ul>

</nav>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">{{ 'Press the Red Button to logout' }}</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
