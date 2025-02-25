<div class="left side-menu">
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 732px;">
        <div class="sidebar-inner slimscrollleft" style="overflow: hidden; width: auto; height: 732px;">
            <div class="clearfix"></div>
            <!--- Profile -->
            <div class="clearfix"></div>
            <hr class="divider">
            <div class="clearfix"></div>
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul class="active">
                    @foreach(config('admin.menu') as $menu)
                        <li class="active has_sub">
                            <a href="{{$menu['url']}}">
                                <i class="fa {{ $menu['icon'] }}"></i>
                                <span>{{ $menu['title'] }}</span>
                                @if(isset($menu['sub_menu']))
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                @endif
                            </a>
                            @if(isset($menu['sub_menu']))
                                <ul style="">
                                    @foreach($menu['sub_menu'] as $subMenu)
                                        <li>
                                            <a href="{{ url($subMenu['url']) }}">
                                                <span>{{ $subMenu['title'] }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="clearfix"></div><br><br><br>
        </div>
        <div class="slimScrollBar" style="background: rgb(122, 134, 143); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; left: 1px; height: 732px; visibility: visible;"></div>
        <div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; left: 1px;"></div>
    </div>
</div>
