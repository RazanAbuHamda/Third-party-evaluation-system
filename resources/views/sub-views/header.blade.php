<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Area Charts | Notika - Notika Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('dashboardPublic/img/favicon.ico')}}">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/bootstrap.min.css')}}>
    <!-- font awesome CSS
		============================================ -->
    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/font-awesome.min.css')}}>
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/owl.carousel.css')}}>
    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/owl.theme.css')}}>
    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/owl.transitions.css')}}>
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/meanmenu/meanmenu.min.css')}}>
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/animate.css')}}>
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/normalize.css')}}>
    <!-- wave CSS
        ============================================ -->
    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/wave/waves.min.css')}}>
    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/wave/button.css')}}>
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/scrollbar/jquery.mCustomScrollbar.min.css')}}>
    <!-- Notika icon CSS
		============================================ -->
    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/notika-custom-icon.css')}}>
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/main.css')}}>
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href={{asset('style.css')}}>
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/responsive.css')}}>
    <!-- modernizr JS
		============================================ -->
    <script src={{asset('dashboardPublic/assets/js/vendor/modernizr-2.8.3.min.js')}}></script>

</head>

<body>
<!-- Start Header Top Area -->
<div class="header-top-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="logo-area">
                    <a href="#"><img src="" alt=""/></a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="padding-top: 15px;">
                <div class="header-top-menu" style="float: left;">
                    <ul class="nav navbar-nav notika-top-nav">
                        <h1 style="font-size: 24px; font-weight: bold; color: white;">Third party evaluation system</h1>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Header Top Area -->
<!-- Mobile Menu start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">

                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Menu end -->
<!-- Main Menu area start-->
<div class="main-menu-area mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                    <li class="users"><a data-toggle="tab" href="#Users"><i class="user"></i> Users</a>
                    </li>
                    <li class="enterprises"><a data-toggle="tab" href="#Enterprises"><i class="enterprise"></i>
                            Enterprises</a>
                    </li>
                    <li class="forms"><a data-toggle="tab" href="#Forms"><i class="form"></i> Forms</a>
                    </li>
                </ul>
                <div class="tab-content custom-menu-content">
                    <div id="Users" class="tab-pane notika-tab-menu-bg animated flipInX users">
                        <ul class="notika-main-menu-dropdown">
                            @can('Show users')
                                <li><a href="{{Url('users')}}">Show users</a>
                                </li>
                            @endcan
                            @can('Add user')
                                <li><a href="{{Url('users/create')}}">Add user</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                    <div id="Enterprises" class="tab-pane notika-tab-menu-bg animated flipInX enterprises">
                        <ul class="notika-main-menu-dropdown">
                            @can('Show enterprises')
                                <li><a href="{{ url('enterprises/index') }}">Show Enterprises</a>
                                </li>
                            @endcan
                            @can('Add Enterprise')
                                <li><a href="{{ url('enterprises/create') }}">Add Enterprise</a>
                                </li>
                                @endcan
                        </ul>
                    </div>
                    <div id="Forms" class="tab-pane notika-tab-menu-bg
                    animated flipInX forms">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="{{ url('forms/index')}}">Show Forms</a>
                            </li>
                            <li><a href="{{url('forms/create')}}">Add Form</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Menu area End-->
