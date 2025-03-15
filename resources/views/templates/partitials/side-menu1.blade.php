<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            @foreach(config('admin.menu') as $menu)
                <li class="nav-item {{ isset($menu['sub_menu']) ? 'has-treeview' : '' }} {{ request()->is($menu['url']) ? 'menu-open' : '' }}">
                    <a href="{{ url($menu['url']) }}" class="nav-link {{ request()->is($menu['url']) ? 'active' : '' }}">
                        <i class="nav-icon {{ $menu['icon'] }}"></i>
                        <p>
                            {{ $menu['title'] }}
                            @if(isset($menu['sub_menu']))
                                <i class="right fas fa-angle-left"></i>
                            @endif
                        </p>
                    </a>
                    @if(isset($menu['sub_menu']))
                        <ul class="nav nav-treeview">
                            @foreach($menu['sub_menu'] as $subMenu)
                                <li class="nav-item">
                                    <a href="{{ url($subMenu['url']) }}" class="nav-link {{ request()->is($subMenu['url']) ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $subMenu['title'] }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->



