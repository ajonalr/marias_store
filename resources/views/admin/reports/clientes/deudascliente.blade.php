@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col  ">
            <div align="center">
                <img src="https://is4-ssl.mzstatic.com/image/thumb/Purple113/v4/ee/91/eb/ee91ebc6-f7e6-2fa2-356e-d5930900691b/AppIcon-0-0-1x_U007emarketing-0-0-0-7-0-0-sRGB-0-0-0-GLES2_U002c0-512MB-85-220-0-0.png/1200x630wa.png" class="img-fluid rounded-circle mt-4" width="350px" height="350px" alt="">
                <p class="text-decoration-none">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita doloremque fuga at totam dicta nulla dolorum optio vero, obcaecati quas. Aliquid magni hic, cum minima totam assumenda praesentium corrupti autem?</p>
            </div>
        </div>
    </div>

    <div class="row my-4">
        <div class="col">
            <h1 class="display-4 text-center">Listado de Deudas / {{$cliente}}</h1>

            <table class="table table-hover" id="deudas" data-page-length="15">
                <thead>
                    <tr>
                        <th>No. Factura</th>
                        <th>Articulo </th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Credito</th>
                        <th>Fecha / Hora de Venta</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($deuda as $deu)
                    <tr>
                        <td>{{$deu->factura_id}}</td>
                        <td>{{$deu->nomArt}} {{$deu->descripcion}}</td>
                        <td>{{$deu->cantidad}}</td>
                        <td>{{$deu->total}}</td>
                        <td>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" value="checkedValue" checked>
                                    Credito
                                </label>
                            </div>
                        </td>
                        <td>{{$deu->fechaVenta}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3 class="text-right text-info"> Total en Deudas: Q. {{$totalDeuda}}</h3>
        </div>
    </div>
</div>
@endsection