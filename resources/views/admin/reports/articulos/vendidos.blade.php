@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">

            <h4 class="card-title text-center display-4"><img src="{{asset('assets/images/logo.png')}}" class="img-fluid" alt="{{config('app.name', 'DECODEV') }}"> <br>
                Control de Articulos <?php echo date('d-M-Y') ?> <br>
            </h4>

            <div class="card">
                <div class="card-body">
                    <table class="table table-hover" id="table_id" data-page-length="15">
                        <thead>
                            <tr>
                                <th>Recibo</th>
                                <th>Articulo </th>
                                <th>Cantidad</th>
                                <th>Fecha de Venta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @foreach($articulos as $art)
                            <tr>
                                <td>{{$art->factura_id}}</td>
                                <td>{{$art->nomArt}} - {{$art->fabricante}} <?php echo $art->descripcion?></td>
                                <td>{{$art->cantidad}}</td>
                                <td>{{$art->fechaVenta}}</td>
                                <?php $total = $total + $art->cantidad; ?>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-right mx-4">
                        <h2>Total de Articulos Vendidos: {{number_format($total, 2)}}</h2>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>

@endsection