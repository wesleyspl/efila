<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            @foreach(config('admin.menu') as $menu)
                @php
                    $isActive = request()->is(trim($menu['url'], '/')) || collect($menu['sub_menu'] ?? [])->contains(function ($subMenu) {
                        return request()->is(trim($subMenu['url'], '/'));
                    });
                @endphp
                <li class="nav-item {{ isset($menu['sub_menu']) ? 'has-treeview' : '' }} {{ $isActive ? 'menu-open' : '' }}">
                    <a href="{{ url($menu['url']) }}" class="nav-link {{ $isActive ? 'active' : '' }}">
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
                                    <a href="{{ url($subMenu['url']) }}" class="nav-link {{ request()->is(trim($subMenu['url'], '/')) ? 'active' : '' }}">
                                        <i class="{{ $subMenu['icon'] }}"></i>
                                        <p> {{ $subMenu['title'] }}</p>
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