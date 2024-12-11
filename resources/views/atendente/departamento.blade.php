<html><head>
    <meta charset="UTF-8">
    <title>Atendente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="">
    <meta name="keywords" content="coco bootstrap template, coco admin, bootstrap,admin template, bootstrap admin,">
    <meta name="author" content="Huban Creative">

    <!-- Base Css Files -->
    <style>
        .content-page > .content {
            margin-top: 50px;
            padding: 20px;
            position: relative;
          }
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
   <style>.file-input-wrapper { overflow: hidden; position: relative; cursor: pointer; z-index: 1; }.file-input-wrapper input[type=file], .file-input-wrapper input[type=file]:focus, .file-input-wrapper input[type=file]:hover { position: absolute; top: 0; left: 0; cursor: pointer; opacity: 0; filter: alpha(opacity=0); z-index: 99; outline: 0; }.file-input-name { margin-left: 8px; }</style><link href="http://efila.test/assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
   <link href="http://efila.test/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="http://efila.test/assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet">
   <link href="http://efila.test/assets/libs/fontello/css/fontello.css" rel="stylesheet">
   <link href="http://efila.test/assets/libs/animate-css/animate.min.css" rel="stylesheet">
   <link href="http://efila.test/assets/libs/nifty-modal/css/component.css" rel="stylesheet">
   <link href="http://efila.test/assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet">
   <link href="http://efila.test/assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet">
   <link href="http://efila.test/assets/libs/pace/pace.css" rel="stylesheet">
   <link href="http://efila.test/assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet">
   <link href="http://efila.test/assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet">
   <link href="http://efila.test/assets/libs/jquery-icheck/skins/all.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
   <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
   <!-- Code Highlighter for Demo -->
   <link href="http://efila.test/assets/libs/prettify/github.css" rel="stylesheet">

           <!-- Extra CSS Libraries Start -->
           <link href="http://efila.test/assets/css/style-atendente.css" rel="stylesheet" type="text/css">
           <!-- Extra CSS Libraries End -->
   <link href="http://efila.test/assets/css/style-responsive.css" rel="stylesheet">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js')}}"></script>
   <![endif]-->

   <link rel="shortcut icon" href="assets/img/favicon.ico">
   <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
   <link rel="apple-touch-icon" sizes="57x57" href="assets/img/apple-touch-icon-57x57.png">
   <link rel="apple-touch-icon" sizes="72x72" href="assets/img/apple-touch-icon-72x72.png">
   <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-touch-icon-76x76.png">
   <link rel="apple-touch-icon" sizes="114x114" href="assets/img/apple-touch-icon-114x114.png">
   <link rel="apple-touch-icon" sizes="120x120" href="assets/img/apple-touch-icon-120x120.png">
   <link rel="apple-touch-icon" sizes="144x144" href="assets/img/apple-touch-icon-144x144.png">
   <link rel="apple-touch-icon" sizes="152x152" href="assets/img/apple-touch-icon-152x152.png />

</head>

<body class=" fixed-left="" widescreen="" pace-done"="">

    <style type="text/css">

        .jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style></head><body class=" widescreen pace-done"><div class="pace  pace-inactive"><div class="pace-progress" style="width: 100%;" data-progress-text="100%" data-progress="99">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div><div class="pace  pace-inactive">
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


    <!-- Begin page -->
    <div id="wrapper" class="forced">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-collapse2">

                        <ul class="nav navbar-nav navbar-right top-navbar">
                            <li class="dropdown iconify hide-phone">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-globe"></i><span class="label label-danger absolute">4</span></a>
                                <ul class="dropdown-menu dropdown-message">
                                    <li class="dropdown-header notif-header"><i class="icon-bell-2"></i> New Notifications<a class="pull-right" href="#"><i class="fa fa-cog"></i></a></li>
                                    <li class="unread">
                                        <a href="#">
                                            <p><strong>John Doe</strong> Uploaded a photo <strong>"DSC000254.jpg"</strong>
                                                <br><i>2 minutes ago</i>
                                            </p>
                                        </a>
                                    </li>
                                    <li class="unread">
                                        <a href="#">
                                            <p><strong>John Doe</strong> Created an photo album <strong>"Fappening"</strong>
                                                <br><i>8 minutes ago</i>
                                            </p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p><strong>John Malkovich</strong> Added 3 products
                                                <br><i>3 hours ago</i>
                                            </p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p><strong>Sonata Arctica</strong> Send you a message <strong>"Lorem ipsum dolor..."</strong>
                                                <br><i>12 hours ago</i>
                                            </p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p><strong>Johnny Depp</strong> Updated his avatar
                                                <br><i>Yesterday</i>
                                            </p>
                                        </a>
                                    </li>
                                    <li class="dropdown-footer">
                                        <div class="btn-group btn-group-justified">
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-primary"><i class="icon-ccw-1"></i> Refresh</a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-danger"><i class="icon-trash-3"></i> Clear All</a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-success">See All <i class="icon-right-open-2"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown iconify hide-phone">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="label label-danger absolute">3</span></a>
                                <ul class="dropdown-menu dropdown-message">
                                    <li class="dropdown-header notif-header"><i class="icon-mail-2"></i> New Messages</li>
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
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="rounded-image topbar-profile-image"><img src="assets/img/users/user-35.jpg"></span> {{ Auth::user()->name }}  <i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">My Profile</a></li>
                                    <li><a href="#">Change Password</a></li>
                                    <li><a href="#">Account Setting</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-help-2"></i> Help</a></li>
                                    <li><a href="lockscreen.html"><i class="icon-lock-1"></i> Lock me</a></li>

                                    <li><a class="md-trigger" href="{{route('logout')}}"  ><i class="icon-logout-1"></i> Logout</a></li>
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

        <!-- Left Sidebar End --> <!-- Right Sidebar Start -->

        <!-- Right Sidebar End -->
        <!-- Start right content -->



<div id="app">
 <div class="content-page">
    <!-- ============================================================== -->
    <!-- Start Content here -->
    <!-- ============================================================== -->
    <div class="content">
                        <!-- Page Heading Start -->

        <!-- Page Heading End-->				<div class="row">
            <div class="col-md-12 portlets ui-sortable">




    <div class="row">
    <div class="widget darkblue-3 col-sm-3">
        <div class="widget-header">
            <h2><strong>---</strong> --- </h2>

        </div>
        <div id="painel-chamada" class="widget-content padding">
            <p style="font-size: 30px"><marquee>Selecione o Departamento</marquee></p>

        </div>
    </div>
    </div>




<div class="row">
<div class="widget">
    <div class="widget-header transparent">
        <h2><strong>Departamentos disponivel para atender</strong> </h2>

    </div>
    <div class="widget-content padding">
        <div >

            @foreach ($dpt1 as $dpts)

            <a href="{{$dpts[0]->nome}}"  class="btn btn-primary btn-lg d-flex align-items-center justify-content-center gap-2">
                <span class="glyphicon glyphicon-briefcase"></span> {{$dpts[0]->nome}}</a>

            @endforeach




        </div>

    </div>
</div>
</div>
<div class="row">
    <div class="widget">
        <div class="widget-header transparent">
            <h2><strong>Minha Fila</strong></h2>
        </div>
        <div class="widget-content padding">
            <p id="fila-container">
                NENHUMA SENHA NA FILA (**)
            </p>
        </div>
    </div>
</div>









                    <!-- Footer Start -->
    <footer>
        Cerrado Cloud © 2024
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
    </div>
 <!-- End right content -->

 <!-- End of page -->
  <!-- the overlay modal e




 ///


            <!-- ============================================================== -->
            <!-- End content here -->
            <!-- ============================================================== -->

        <!-- End right content -->

        <script>
      // Defina a função fora de $(document).ready() para torná-la globalmente acessível
function atualizarFila() {
    $.ajax({
        url: 'http://efila.test/atendente.atualizaFila', // Endpoint da sua API
        type: 'GET', // Método da requisição
        dataType: 'json', // Formato de resposta esperado
        success: function(response) {
            if (response.fila && response.fila.length > 0) {
                let filaHtml = '';
                response.fila.forEach(function(fila) {
                    filaHtml += '<a href="#" class="btn btn-sm btn-info"><i class="fa fa-user"></i> ' + fila.sigla + '-' + fila.numero + '</a>';
                });
                $('#fila-container').html('Total: ' + response.fila.length +' <hr color="red">'+ filaHtml);
                $('#btn_chamar').removeClass('disabled').css('pointer-events', 'auto').removeAttr('aria-disabled');
            } else {
                $('#fila-container').html('NENHUMA SENHA NA FILA (**)');
                $('#btn_chamar').addClass('disabled').css('pointer-events', 'none').attr('aria-disabled', 'true');

            }
        },
        error: function(xhr, status, error) {
            console.error("Erro ao buscar fila: ", status, error);
            $('#fila-container').html('Erro ao carregar a fila.');
        }
    });
}


function chamarProximo() {
    $.ajax({
        url: 'http://efila.test/atendente.chamar', // Endpoint da sua API
        type: 'GET', // Método da requisição
        dataType: 'json', // Formato de resposta esperado
        success: function(response) {
           console.log(response.senha);
           $('#painel-chamada').html('<p style="font-size: 30px">Chamando: ' + response.senha + '</p>');
           $('#btn_inicia').show();
           $('#btn_ninguem').show();
           $('#btn_inicia').attr('onclick', 'iniciaAtendimento("' +response.id_atendimento+ '")');
           $('#btn_ninguem').attr('onclick','naoCompareceu("'+response.id_atendimento+'")');
           $('#btn_chamar').hide();

        },
        error: function(xhr, status, error) {
            console.error("Erro ao buscar fila: ", status, error);
            $('#fila-container').html('Erro ao carregar a fila.');
        }
    });
}



setInterval(atualizarFila, 3000);
$(document).ready(function() {
    // Chama a função para carregar a fila ao carregar a página


    // Atualiza a fila a cada 30 segundos


    // Se quiser atualizar a fila com um clique em um botão específico
    $('#atualizar-fila-btn').click(function() {
        atualizarFila(); // Chama a função quando o botão for clicado
    });
});


            </script>


    <!-- End of page -->
    <!-- the overlay modal element -->
    <div class="md-overlay"></div>
    <!-- End of eoverlay modal -->


    	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="http://efila.test/assets/libs/jquery/jquery-1.11.1.min.js"></script>
	<script src="http://efila.test/assets/libs/bootstrap/js/bootstrap.min.js"></script>
	<script src="http://efila.test/assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="http://efila.test/assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js"></script>
	<script src="http://efila.test/assets/libs/jquery-detectmobile/detect.js"></script>
	<script src="http://efila.test/assets/libs/jquery-animate-numbers/jquery.animateNumbers.js"></script>
	<script src="http://efila.test/assets/libs/ios7-switch/ios7.switch.js"></script>
	<script src="http://efila.test/assets/libs/fastclick/fastclick.js"></script>
	<script src="http://efila.test/assets/libs/jquery-blockui/jquery.blockUI.js"></script>
	<script src="http://efila.test/assets/libs/bootstrap-bootbox/bootbox.min.js"></script>
	<script src="http://efila.test/assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
	<script src="http://efila.test/assets/libs/jquery-sparkline/jquery-sparkline.js"></script>
	<script src="http://efila.test/assets/libs/nifty-modal/js/classie.js"></script>
	<script src="http://efila.test/assets/libs/nifty-modal/js/modalEffects.js"></script>
	<script src="http://efila.test/assets/libs/sortable/sortable.min.js"></script>
	<script src="http://efila.test/assets/libs/bootstrap-fileinput/bootstrap.file-input.js"></script>
	<script src="http://efila.test/assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="http://efila.test/assets/libs/bootstrap-select2/select2.min.js"></script>
	<script src="http://efila.test/assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
	<script src="http://efila.test/assets/libs/pace/pace.min.js"></script>
	<script src="http://efila.test/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="http://efila.test/assets/libs/jquery-icheck/icheck.min.js"></script>

	<!-- Demo Specific JS Libraries -->
	<script src="http://efila.test/assets/libs/prettify/prettify.js"></script>

	<script src="http://efila.test/assets/js/init.js"></script>




</div></body></html>
