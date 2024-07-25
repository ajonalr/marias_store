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
        input,
        textarea,
        select {
            border-radius: 25px !important;
            border: 2px solid #716aca !important;
        }

        body {
            background: #fff !important;
        }
    </style>

    @yield('styles')
</head>

<body>


    <div class="">

        <div class="text-center">
            <img src="{{asset('logos/main.png')}}" alt="" class="logo" style="width: 12%;">
        </div>


        <div class="container-fluid">
            @include('partial.admin.alert')

            @yield('content')

            @include('partial.admin.footer')
        </div>




        <script src="{{asset('plugins/bootstrap/jquery.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap/popper.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>



        @yield('scripts')
</body>

</html>
