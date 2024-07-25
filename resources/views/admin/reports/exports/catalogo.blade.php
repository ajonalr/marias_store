@extends('layouts.app')

@section('styles')
<style>
    .product {
        width: 500px;
        font-family: sans-serif;
        margin: 2%;
    }

    .product-image {
        background: #e9e9e9;
        margin-bottom: 10px;
        position: relative;
        min-height: 250px;
    }

    .onsale-section {
        position: absolute;
        top: -6px;
        right: 15px;
    }

    .onsale-section:after {
        position: absolute;
        content: '';
        display: block;
        width: 0;
        height: 0;
        border-left: 50px solid transparent;
        border-right: 50px solid transparent;
        border-top: 6px solid #6ec5d5;
    }

    .onsale {
        position: relative;
        display: inline-block;
        text-align: center;
        color: #fff;
        background: #6ec5d5;
        font-size: 14px;
        line-height: 1;
        padding: 12px 8px 6px;
        border-top-right-radius: 8px;
        width: 105px;
        text-transform: uppercase
    }

    .onsale:before,
    .onsale:after {
        position: absolute;
        content: '';
        display: block;
    }

    .onsale:before {
        background: #6ec5d5;
        height: 7px;
        width: 6px;
        left: -6px;
        top: 0;
    }

    .onsale:after {
        background: #96a0a2;
        height: 7px;
        width: 8px;
        border-radius: 8px 8px 0 0;
        left: -8px;
        top: 0;
    }

    .product img {
        display: block;
    }
</style>
@endsection




@section('content')
<div class="container-fluid">


    <div class="row justify-content-center">
        <div class="col-4 mb-4">

            <img src="{{asset('assets/images/logo.png')}}" alt="{{config('app.name', 'DeCoDev')}}" style="max-width: 850px; width: 550px;" class="img-fluidd mt-4 img-yo" alt="">
            <br>
        </div>
    </div>

    <div class=" row">
        <div class="col text-center">
            <h4 class="display-4">Articulos en Oferta</h4>
            <p>Articulos en Oferta (sujetos a cambios y existencia)</p>
        </div>
    </div>

    <div class="row">
        @foreach($articulo as $art)
        <div class="col-md-4">
            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card border-light">
                    <center>
                        @if($art->imagen)
                        <img src="{{Storage::url($art->imagen)}}" class="img-flfuid card-img-top rounded" style="height: 265px !important; width: 265px !important;">
                        @else
                        <img src="https://images.pexels.com/photos/577585/pexels-photo-577585.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="" class="img-fluid rounded">
                        @endif
                    </center>

                    <div class="card-body">
                        <h4 class="card-title text-center text-uppercase h3 text-info">{{$art->nombre}}</h4>
                        <pre class="form-control">{{$art->descripcion }}</pre>

                        <p class="text-right mt-2 h4">Costo: Q. {{number_format($art->costo, 2)}} </p>

                    </div>
                </div>

                @if($art->descuento > 0)
                <span class="onsale-section"><span class="onsale">DESCUENTO Q. {{$art->descuento}}</span></span>
                @endif


            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection