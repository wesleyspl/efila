<html>

<head>
    <meta charset="UTF-8">
    <title>{{ config('admin.title') }}</title>
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
    <link href="{{ asset('assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/fontello/css/fontello.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/animate-css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/nifty-modal/css/component.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/ios7-switch/ios7-switch.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/pace/pace.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/sortable/sortable-theme-bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/jquery-icheck/skins/all.css') }}" rel="stylesheet" />
    <!-- Code Highlighter for Demo -->
    <link href="{{ asset('assets/libs/prettify/github.css') }}" rel="stylesheet" />

    <!-- Extra CSS Libraries Start -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- Extra CSS Libraries End -->
    <link href="{{ asset('assets/css/style-responsive.css') }}" rel="stylesheet" />

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
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/apple-touch-icon-152x152.png" />
</head>

<body class="fixed-left widescreen pace-done">
    <div class="pace pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>

    <!-- Begin page -->
    <div id="wrapper" class="">

        <!-- Top Bar Start -->
        <div class="topbar">
            <div class="topbar-left">
                <div class="logo">
                    <h1>
                        <a href="#"><img class="logo" src="{{ asset('assets/img/logo.png') }}" style="width: 123px; height: 50px;" alt="Logo"></a>
                    </h1>
                </div>
                <button class="button-menu-mobile open-left">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            @include('templates.partitials.account-menu')   
        </div>
        <!-- Top Bar End -->

        <!-- Left Sidebar Start -->
        @include('templates.partitials.side-menu')

        <div class="content-page">
            <!-- ============================================================== -->
            <!-- Start Content here -->
            <!-- ============================================================== -->
            <div class="content">
                <!-- Page Heading Start -->
                <div class="page-heading">
                    <h1><i class='fa fa-file'></i>{{ $titulo }}</h1>
                    <h3>{{ $subtitulo }}</h3>
                </div>
                <!-- Page Heading End-->
                <div class="row">
                    <div class="col-md-12 portlets">
                        @yield('content')
                    </div>
                </div>

                @include('templates.partitials.footer')

            </div>
            <!-- ============================================================== -->
            <!-- End content here -->
            <!-- ============================================================== -->

        </div>
        <div class="md-overlay"></div>
        <!-- End of eoverlay modal -->
        <script>
            var resizefunc = [];
        </script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{ asset('assets/libs/jquery/jquery-1.11.1.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-detectmobile/detect.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-animate-numbers/jquery.animateNumbers.js') }}"></script>
        <script src="{{ asset('assets/libs/ios7-switch/ios7.switch.js') }}"></script>
        <script src="{{ asset('assets/libs/fastclick/fastclick.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-blockui/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap-bootbox/bootbox.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-sparkline/jquery-sparkline.js') }}"></script>
        <script src="{{ asset('assets/libs/nifty-modal/js/classie.js') }}"></script>
        <script src="{{ asset('assets/libs/nifty-modal/js/modalEffects.js') }}"></script>
        <script src="{{ asset('assets/libs/sortable/sortable.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap-fileinput/bootstrap.file-input.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap-select2/select2.min.js') }}"></script>
        <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('assets/libs/pace/pace.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-icheck/icheck.min.js') }}"></script>

        <!-- Demo Specific JS Libraries -->
        <script src="{{ asset('assets/libs/prettify/prettify.js') }}"></script>

        <script src="{{ asset('assets/js/init.js') }}"></script>

</body>

</html>