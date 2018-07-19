<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Dini Shop Admin</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sidebar-nav.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/default.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('assets/css/datatables.min.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery-confirm.min.css') }}" id="theme" rel="stylesheet">
</head>

<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <a class="logo" href="index.html">
                      <b>
                        <img src="{{ asset('assets/images/admin-logo.png') }}" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="{{ asset('assets/images/admin-logo-dark.png') }}" alt="home" class="light-logo" />
                      </b>
                      <span class="hidden-xs">
                        <img src="{{ asset('assets/images/admin-text.png') }}" alt="home" class="dark-logo" /><!--This is light logo text--><img src="{{ asset('assets/images/admin-text-dark.png') }}" alt="home" class="light-logo" />
                      </span> 
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> 
                        </form>
                    </li>
                    <li>
                        <a class="profile-pic" href="#"><b class="hidden-xs">{{ Auth::user()->fullname }}</b></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                @include('master.sidebar')
            </div>
        </div>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">{{$title}}</h4> 
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Blank Page</li>
                        </ol>
                    </div>
                </div>
                @yield('content')
            </div>
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by wrappixel.com </footer>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-nav.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('assets/js/notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
