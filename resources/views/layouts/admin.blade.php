<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="{{asset('theme/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('theme/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/responsive.css')}}">
    <script src="{{asset('theme/js/modernizr-2.8.3.min.js')}}"></script>
    <script src="{{asset('plugins/fontaweson/fontaws.js')}}" crossorigin="anonymous"></script>
    @yield('styles')
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        @include('partial.admin.navbar')
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            @include('partial.admin.header')
            <!-- header area end -->
            <!-- page title area start -->



            <div class="page-title-area">
                @include('partial.admin.bread-crumb')
            </div>

            <!-- page title area end -->
            <div class="main-content-inner">
                @include('partial.admin.alert')
                @yield('content')
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        @include('partial.admin.footer')
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->

    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="{{asset('plugins/bootstrap/jquery.min.js')}}"></script>
    <script src="{{asset('theme/js/popper.min.js')}}"></script>
    <script src="{{asset('theme/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('theme/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('theme/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('theme/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('theme/js/jquery.slicknav.min.js')}}"></script>
    <script src="{{asset('theme/js/plugins.js')}}"></script>
    <script src="{{asset('theme/js/scripts.js')}}"></script>

    @yield('scripts')
</body>

</html>