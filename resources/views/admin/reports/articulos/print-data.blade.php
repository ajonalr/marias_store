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




    <div class="container-fluid">
        <div class="row">

            <h4 class="card-title text-uppercase text-center">{{$articulo->nombre}}</h4> <br>

            <hr>
            <p class=" text-uppercase text-center"><?php echo $articulo->descripcion; ?></p>
            <br>

            <div class="w-100"></div>
            <div class="row">
                @for ($i = 0; $i < 80; $i++) 
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            {!! DNS1D::getBarcodeHTML($articulo->cod_barras, 'C128') !!}
                            {{$articulo->cod_barras}}
                        </div>
                    </div>
            </div>
            @endfor
        </div>


    </div>
    </div>







    <script src="{{asset('plugins/bootstrap/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>



    @yield('scripts')
</body>

</html>