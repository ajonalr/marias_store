<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>

    <title>{{config('app.name')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sobre Nosotros">

    <meta name="author" content="DeCoDev Desarrollo de Software">
    <!-- Favicon icon -->

    <link rel="icon" href="{{asset('logos/ico.ico')}}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('plugins/bootstrap/bootstrap.min.css')}}">



    <script src="{{asset('plugins/fontaweson/fontaws.js')}}" crossorigin="anonymous"></script>


    <link href="{{ asset('styles.css') }}" rel="stylesheet">

    <style>
        body {
            background: #fff;
        }
    </style>

    @yield('styles')
</head>

<body>


    <div class="container-flui">

        @yield('content')

    </div>


    <script src="{{asset('plugins/bootstrap/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>


    @yield('scripts')
</body>

</html>
