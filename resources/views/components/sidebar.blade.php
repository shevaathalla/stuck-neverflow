<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>    

    <!-- Nav Item - Dashboard -->
    @auth
    <!-- Divider -->    
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
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
    <li class="nav-item">
        <a class="nav-link {{ Route::is('tag.index') ? 'active' : '' }}" href="{{ route('tag.index') }}">
            <i class="fas fa-fw fa-hashtag"></i>
            <span>Tag List</span></a>
    </li>     

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>