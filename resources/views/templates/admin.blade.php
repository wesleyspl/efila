<html>

<head>
    <meta charset="UTF-8">
    <title>{{config('admin.title')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="">
    <meta name="keywords" content="coco bootstrap template, coco admin, bootstrap,admin template, bootstrap admin,">
    <meta name="author" content="Huban Creative">

    <!-- Base Css Files -->
    <style>
        .file-input-wrapper {
            overflow: hidden;
            position: relative;
            cursor: pointer;
            z-index: 1;
        }

        .file-input-wrapper input[type=file],
        .file-input-wrapper input[type=file]:focus,
        .file-input-wrapper input[type=file]:hover {
            position: absolute;
            top: 0;
            left: 0;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
            z-index: 99;
            outline: 0;
        }

        .file-input-name {
            margin-left: 8px;
        }
    </style>
   <!-- Base Css Files -->
   <link href="{{ asset('assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css')}}" rel="stylesheet" />
   <link href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
   <link href="{{ asset('assets/libs/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
   <link href="{{ asset('assets/libs/fontello/css/fontello.css')}}" rel="stylesheet" />
   <link href="{{ asset('assets/libs/animate-css/animate.min.css')}}" rel="stylesheet" />
   <link href="{{ asset('assets/libs/nifty-modal/css/component.css')}}" rel="stylesheet" />
   <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" />
   <link href="{{ asset('assets/libs/ios7-switch/ios7-switch.css')}}" rel="stylesheet" />
   <link href="{{ asset('assets/libs/pace/pace.css')}}" rel="stylesheet" />
   <link href="{{ asset('assets/libs/sortable/sortable-theme-bootstrap.css')}}" rel="stylesheet" />
   <link href="{{ asset('assets/libs/bootstrap-datepicker/css/datepicker.css')}}" rel="stylesheet" />
   <link href="{{ asset('assets/libs/jquery-icheck/skins/all.css')}}" rel="stylesheet" />
   <!-- Code Highlighter for Demo -->
   <link href="{{ asset('assets/libs/prettify/github.css')}}" rel="stylesheet" />

           <!-- Extra CSS Libraries Start -->
           <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
           <!-- Extra CSS Libraries End -->
   <link href="{{ asset('assets/css/style-responsive.css')}}" rel="stylesheet" />

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js')}}"></script>
   <![endif]-->

   <link rel="shortcut icon" href="assets/img/favicon.ico">
   <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png" />
   <link rel="apple-touch-icon" sizes="57x57" href="assets/img/apple-touch-icon-57x57.png" />
   <link rel="apple-touch-icon" sizes="72x72" href="assets/img/apple-touch-icon-72x72.png" />
   <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-touch-icon-76x76.png" />
   <link rel="apple-touch-icon" sizes="114x114" href="assets/img/apple-touch-icon-114x114.png" />
   <link rel="apple-touch-icon" sizes="120x120" href="assets/img/apple-touch-icon-120x120.png" />
   <link rel="apple-touch-icon" sizes="144x144" href="assets/img/apple-touch-icon-144x144.png" />
   <link rel="apple-touch-icon" sizes="152x152" href="assets/img/apple-touch-icon-152x152.png />

</head>

<body class="fixed-left  widescreen pace-done">
    <div class="pace  pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>
    <!-- Modal Start -->
    <!-- Modal Task Progress -->
    <div class="md-modal md-3d-flip-vertical" id="task-progress">
        <div class="md-content">
            <h3><strong>Task Progress</strong> Information</h3>
            <div>
                <p>CLEANING BUGS</p>
                <div class="progress progress-xs for-modal">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                        <span class="sr-only">80% Complete</span>
                    </div>
                </div>
                <p>POSTING SOME STUFF</p>
                <div class="progress progress-xs for-modal">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                        <span class="sr-only">65% Complete</span>
                    </div>
                </div>
                <p>BACKUP DATA FROM SERVER</p>
                <div class="progress progress-xs for-modal">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                        <span class="sr-only">95% Complete</span>
                    </div>
                </div>
                <p>RE-DESIGNING WEB APPLICATION</p>
                <div class="progress progress-xs for-modal">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        <span class="sr-only">100% Complete</span>
                    </div>
                </div>
                <p class="text-center">
                    <button class="btn btn-danger btn-sm md-close">Close</button>
                </p>
            </div>
        </div>
    </div>

    <!-- Modal Logout -->
    <div class="md-modal md-just-me" id="logout-modal">
        <div class="md-content">
            <h3><strong>Logout</strong> Confirmation</h3>
            <div>
                <p class="text-center">Are you sure want to logout from this awesome system?</p>
                <p class="text-center">
                    <button class="btn btn-danger md-close">Nope!</button>
                    <a href="login.html" class="btn btn-success md-close">Yeah, I'm sure</a>
                </p>
            </div>
        </div>
    </div> <!-- Modal End -->
    <!-- Begin page -->
    <div id="wrapper" class="">

        <!-- Top Bar Start -->
        <div class="topbar">
            <div class="topbar-left">
                <div class="logo">
                    <h1>
                <a href="#"><img  class="logo" src="assets/img/logo.png" style="width: 123px; height: 50px;" alt="Logo"></a>
                    </h1>     
            </div>
                <button class="button-menu-mobile open-left">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-collapse2">

                        <ul class="nav navbar-nav navbar-right top-navbar">
                           
                            <li class="dropdown iconify hide-phone">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="label label-danger absolute">3</span></a>
                                <ul class="dropdown-menu dropdown-message">
                                    <li class="dropdown-header notif-header"><i class="icon-mail-2"></i> Avisos</li>
                                    <li class="unread">
                                        <a href="#" class="clearfix">
                                            <img src="images/users/chat/2.jpg" class="xs-avatar ava-dropdown" alt="Avatar">
                                            <strong>John Doe</strong><i class="pull-right msg-time">5 minutes ago</i><br>
                                            <p>Duis autem vel eum iriure dolor in hendrerit ...</p>
                                        </a>
                                    </li>
                                    <li class="unread">
                                        <a href="#" class="clearfix">
                                            <img src="images/users/chat/1.jpg" class="xs-avatar ava-dropdown" alt="Avatar">
                                            <strong>Sandra Kraken</strong><i class="pull-right msg-time">22 minutes ago</i><br>
                                            <p>Duis autem vel eum iriure dolor in hendrerit ...</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="clearfix">
                                            <img src="images/users/chat/3.jpg" class="xs-avatar ava-dropdown" alt="Avatar">
                                            <strong>Zoey Lombardo</strong><i class="pull-right msg-time">41 minutes ago</i><br>
                                            <p>Duis autem vel eum iriure dolor in hendrerit ...</p>
                                        </a>
                                    </li>
                                    <li class="dropdown-footer">
                                        <div class=""><a href="#" class="btn btn-sm btn-block btn-primary"><i class="fa fa-share"></i> See all messages</a></div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown iconify hide-phone"><a href="#" onclick="javascript:toggle_fullscreen()"><i class="icon-resize-full-2"></i></a></li>
                            <li class="dropdown topbar-profile">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="rounded-image topbar-profile-image"><img src="assets/img/users/user-35.jpg"></span> Jane <strong>Doe</strong> <i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Meus dados</a></li>
                                    <li><a href="#">Mudar Senha</a></li>
                                    <li><a href="#">Configurar</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-help-2"></i> Help</a></li>

                                    <li><a class="md-trigger" href="{{route('logout')}}"><i class="icon-logout-1"></i> Sair</a></li>
                                </ul>
                            </li>
                            <li class="right-opener">

                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- Top Bar End -->
        <!-- Left Sidebar Start -->
        <div class="left side-menu">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 732px;">
                <div class="sidebar-inner slimscrollleft" style="overflow: hidden; width: auto; height: 732px;">
                   
                  
                    <div class="clearfix"></div>
                    <!--- Profile -->

                    <!--- Divider -->
                    <div class="clearfix"></div>
                    <hr class="divider">
                    <div class="clearfix"></div>
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul class="active">
                            <!-- eliminado departamento dessa versao
                            <li class=" active has_sub"><a href="javascript:void(0);"><i class="icon-home-3"></i><span>Departamentos</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                                <ul style="">
                                    <li ><a href="{{route('departamento')}}"><span>Listar</span></a></li>
                                    <li><a href="{{route('departamento.create')}}"><span>Novo</span></a></li>
                                </ul>
                            </li>
                        -->
                        <!--
                            <li class=" active has_sub"><a href="javascript:void(0);"><i class="icon-home-3"></i><span>Prioridades *não funcional</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                                <ul style="">
                                    <li ><a href="{{route('prioridade')}}"><span>Listar</span></a></li>
                                    <li><a href="{{route('prioridade.create')}}"><span>Novo</span></a></li>
                                </ul>
                            </li>  -->
                            <li class=" active has_sub"><a href="javascript:void(0);"><i class="icon-home-3"></i><span>Paineis</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                                <ul style="">
                                    <li ><a href="{{route('painel')}}"><span>Painel de Senha</span></a></li>
                                    <li><a href="{{route('touch')}}"><span>Painel Touch</span></a></li>
                                </ul>
                            </li>
                            <li class=" active has_sub"><a href="javascript:void(0);"><i class="icon-home-3"></i><span>Triagem</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                                <ul style="">
                                    <li ><a href="{{route('triagem')}}"><span>Configurar</span></a></li>
                                    <li ><a href="{{route('senha')}}"><span>Tirar Senha</span></a></li>

                                </ul>
                            </li>

                            <li class=" active has_sub"><a href="javascript:void(0);"><i class="icon-home-3"></i><span>Locais</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                                <ul style="">
                                    <li ><a href="{{route('local')}}"><span>Listar</span></a></li>
                                    <li><a href="{{route('local.create')}}"><span>Novo</span></a></li>
                                </ul>
                            </li>
                            <li class=" active has_sub"><a href="javascript:void(0);"><i class="icon-home-3"></i><span>Atendentes</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                                <ul style="">
                                    <li ><a href="{{route('atendente')}}"><span>Listar</span></a></li>
                                    <li><a href="{{route('atendente.create')}}"><span>Novo</span></a></li>
                                </ul>
                            </li>
                            <li class=" active has_sub"><a href="javascript:void(0);"><i class="icon-home-3"></i><span>Serviços</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                                <ul style="">
                                    <li ><a href="{{route('servicos')}}"><span>Listar</span></a></li>
                                    <li><a href="{{route('servicos.create')}}"><span>Novo</span></a></li>
                                </ul>
                            </li>

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
        <!-- Left Sidebar End --> <!-- Right Sidebar Start -->

        <!-- Right Sidebar End -->
        <!-- Start right content -->







 <div class="content-page">
    <!-- ============================================================== -->
    <!-- Start Content here -->
    <!-- ============================================================== -->
    <div class="content">
                        <!-- Page Heading Start -->
        <div class="page-heading">
            <h1><i class='fa fa-file'></i>{{$titulo}}</h1>
            <h3>{{$subtitulo}}</h3>            	</div>
        <!-- Page Heading End-->				<div class="row">
            <div class="col-md-12 portlets">

                    @yield('content')

            </div>
        </div>

                    <!-- Footer Start -->
    <footer>
        Huban Creative &copy; 2014
        <div class="footer-links pull-right">
            <a href="#">About</a><a href="#">Support</a><a href="#">Terms of Service</a><a href="#">Legal</a><a href="#">Help</a><a href="#">Contact Us</a>
        </div>
    </footer>
    <!-- Footer End -->
    </div>
    <!-- ============================================================== -->
    <!-- End content here -->
    <!-- ============================================================== -->

 </div>
 <!-- End right content -->

 <!-- End of page -->
  <!-- the overlay modal e




 ///


            <!-- ============================================================== -->
            <!-- End content here -->
            <!-- ============================================================== -->


        <!-- End right content -->


    <!-- End of page -->
    <!-- the overlay modal element -->
    <div class="md-overlay"></div>
    <!-- End of eoverlay modal -->
    <script>
        var resizefunc = [];
    </script>
    	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="{{ asset('assets/libs/jquery/jquery-1.11.1.min.js')}}"></script>
	<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js')}}"></script>
	<script src="{{ asset('assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js')}}"></script>
	<script src="{{ asset('assets/libs/jquery-detectmobile/detect.js')}}"></script>
	<script src="{{ asset('assets/libs/jquery-animate-numbers/jquery.animateNumbers.js')}}"></script>
	<script src="{{ asset('assets/libs/ios7-switch/ios7.switch.js')}}"></script>
	<script src="{{ asset('assets/libs/fastclick/fastclick.js')}}"></script>
	<script src="{{ asset('assets/libs/jquery-blockui/jquery.blockUI.js')}}"></script>
	<script src="{{ asset('assets/libs/bootstrap-bootbox/bootbox.min.js')}}"></script>
	<script src="{{ asset('assets/libs/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
	<script src="{{ asset('assets/libs/jquery-sparkline/jquery-sparkline.js')}}"></script>
	<script src="{{ asset('assets/libs/nifty-modal/js/classie.js')}}"></script>
	<script src="{{ asset('assets/libs/nifty-modal/js/modalEffects.js')}}"></script>
	<script src="{{ asset('assets/libs/sortable/sortable.min.js')}}"></script>
	<script src="{{ asset('assets/libs/bootstrap-fileinput/bootstrap.file-input.js')}}"></script>
	<script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
	<script src="{{ asset('assets/libs/bootstrap-select2/select2.min.js')}}"></script>
	<script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{ asset('assets/libs/pace/pace.min.js')}}"></script>
	<script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
	<script src="{{ asset('assets/libs/jquery-icheck/icheck.min.js')}}"></script>

	<!-- Demo Specific JS Libraries -->
	<script src="{{ asset('assets/libs/prettify/prettify.js')}}"></script>

	<script src="{{ asset('assets/js/init.js')}}"></script>

</body>

</html>
