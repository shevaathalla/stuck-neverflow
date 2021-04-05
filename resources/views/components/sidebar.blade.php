@auth
<ul class="navbar-nav {{ Auth::user()->role->name == 'admin' ? 'bg-gradient-dark' : 'bg-gradient-primary' }} sidebar sidebar-dark accordion" id="accordionSidebar">    
@endauth
@guest
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
@endguest
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Stuck Neverflow</div>
    </a>    

    <!-- Nav Item - Dashboard -->
    @auth
    <!-- Heading -->
    <div class="sidebar-heading">
        Main
    </div>
    <!-- Divider -->    
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ Route::is('user.show') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.show',['user'=> Auth::user()]) }}">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>User Detail</span></a>
    </li>
    @endauth    

    <!-- Heading -->
    <div class="sidebar-heading">
        Content
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Route::is(['question.create','question.index']) ? 'active' : ''  }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-question"></i>
            <span>Question</span>
        </a>
        <div id="collapseTwo" class="{{ Route::is(['question.create','question.index']) ? 'collapse show' : 'collapse' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">                
                <a class="collapse-item {{ Route::is('question.create') ? 'active' : '' }}" href="{{ route('question.create') }}"> <i class="fas fa-plus"></i>  Create</a>
                <a class="collapse-item {{ Route::is('question.index') ? 'active' : '' }}" href="{{ route('question.index') }}"> <i class="fas fa-list"></i> List</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ Route::is(['tag.index']) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('tag.index') }}">
            <i class="fas fa-fw fa-hashtag"></i>
            <span>Tag List</span></a>
    </li>
    @auth
    @if (Auth::user()->role->name == 'admin')
    <li class="nav-item  {{ Route::is(['user.index']) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-fw fa-user-astronaut"></i>
            <span>User List</span></a>
    </li>     
    @endif        
    @endauth    

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>