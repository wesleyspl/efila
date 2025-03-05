<div class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-collapse2">

            <ul class="nav navbar-nav navbar-right top-navbar">
                <li class="dropdown iconify hide-phone"><a href="#" onclick="javascript:toggle_fullscreen()"><i class="icon-resize-full-2"></i></a></li>
                <li class="dropdown topbar-profile">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><strong> {{ session('pessoa.nome') }} </strong> <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Meus dados</a></li>
                        <li><a href="#">Mudar Senha</a></li>
                        <li><a href="#">Configurar</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-help-2"></i> Help</a></li>
                        <li><a class="md-trigger" href="{{ route('logout') }}"><i class="icon-logout-1"></i> Sair</a></li>
                    </ul>
                </li>
                <li class="right-opener"></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>