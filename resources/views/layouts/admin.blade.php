<!doctype html>
<html class="no-js" lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('app.name')}}</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="{{asset('logos/ico.ico')}}">


    <link rel="stylesheet" href="{{asset('theme/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/icons1.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/icons2.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/style.css')}}">
   

    <script src="{{asset('plugins/fontaweson/fontaws.js')}}"></script>
    
    <link rel="stylesheet" href="{{asset('styles.css')}}">
    <link href="{{asset('theme/js/fuente.css')}}" rel='stylesheet' type='text/css'>

    @yield('styles')

</head>

<body>

    @include('partial.admin.navbar')

    <div id="right-panel" class="right-panel">

        @include('partial.admin.header')




        <div class="content mt-3">
            <div class="animated fadeIn">

                @include('partial.admin.alert')
                @yield('content')

            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->


    @yield('modal')


    <script src="{{asset('plugins/bootstrap/jquery.min.js')}}"></script>
    <script src="{{asset('theme/js/popper.min.js')}}"></script>
    <script src="{{asset('theme/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('theme/js/main.js')}}"></script>

    <script src="{{asset('plugins/bootstrap/jquery.min.js')}}"></script>

    @yield('scripts')

</body>

</html>