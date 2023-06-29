<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Rate Mentor System</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .logo-img {
            max-width: 200px; /* Adjust the width as needed */
            height: 100px; /* Maintain the aspect ratio */
            /* Optional: Add some right margin */
        }

        .delete-button {
            background-color: #FFFFFF;
            color: red;
        }

        .pull-left {
            display: flex;
            align-items: center;
        }

        .pull-left i {
            margin-right: 35px; /* Adjust the spacing between the icon and the text */
        }

        .fa-angle-left {
            font-size: 24px; /* تعديل حجم السهم حسب الحجم المطلوب */
        }
        .logo-img {
            max-width: 200px; /* Adjust the width as needed */
            height: 100px; /* Maintain the aspect ratio */
            /* Optional: Add some right margin */
        }

        .header-top-area {
            background-color: #F4F4F4;
        }

        .nav-tabs {
            background-color: #F4F4F4;
            border: none;
        }

        .nav-tabs > li {
            display: inline-block;
            margin: 0;
        }

        .nav-tabs > li > a {
            padding: 10px 20px;
            color: #000;
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
            background-color: transparent;
            border: none;
        }

        .nav-tabs > li > a:hover,
        .nav-tabs > li > a:focus {
            color: #333;
            background-color: #F4F4F4;
        }

        .tab-content {
            background-color: #FFF;
            /*padding: 20px;*/
            border: 1px solid #DDD;
        }
        .tab-pane ul.notika-main-menu-dropdown li a {
            color: #000;
        }

        .tab-pane ul.notika-main-menu-dropdown li a:hover {
            color: #333;
            font-weight: bold;
            font-size: 15px;
        }
    </style>
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('dashboardPublic/img/favicon.png')}}">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    <link rel="stylesheet" href={{asset('dashboardPublic/assets/css/responsive.css')}}>
    <!-- modernizr JS

		============================================ -->
    <script src={{asset('dashboardPublic/assets/js/vendor/modernizr-2.8.3.min.js')}}></script>

</head>
<body>

<!-- Start Header Top Area -->
<div class="header-top-area" style="background-color: #F4F4F4">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-right: -60px">
                <div class="logo-area" style="margin-left: 0px;">
                    <a href="#"><img src="{{ asset('dashboardPublic/img/logo.png') }}" alt="Logo" class="logo-img"></a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="margin-left: -60px">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                    @can('Show users')
                        <li class="users"><a data-toggle="tab" href="#Users"><i class="user"></i> Users</a>
                        </li>
                    @endcan
                    @can('Show enterprises')
                        <li class="enterprises"><a data-toggle="tab" href="#Enterprises"><i
                                    class="enterprise"></i>
                                Enterprises</a>
                        </li>
                    @endcan
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
                            @can('Add enterprise')
                                <li><a href="{{ url('enterprises/create') }}">Add Enterprise</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                    <div id="Forms" class="tab-pane notika-tab-menu-bg animated flipInX forms">
                        <ul class="notika-main-menu-dropdown">
                            @can('Show forms')
                                <li><a href="{{ url('forms/index')}}">Show Forms</a></li>
                            @else
                                @can('Show enterprise forms')
                                    <li><a href="{{ url('forms/showEnterpriseForms') }}">Show Enterprise Forms</a></li>
                                @endcan
                            @endcan

                            @can('Add form')
                                <li><a href="{{url('forms/create')}}">Add Form</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br>

<!-- Main Menu area End-->
