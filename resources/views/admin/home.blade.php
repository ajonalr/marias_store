@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">
<script src="{{asset('plugins/fontaweson/fontaws.js')}}"></script>
@endsection

@section('content')
<div class="container-fluid">
     <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="card text-white" style="background-color: #009c37;">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <a href="JavaScript: void(0);">
                            <i class="fas fa-user-tie" style="font-size: 45px; color: #FFF" class="mx-2"></i>
                        </a>
                        <div class="mx-3 mt-2">
                            <h4 class="font-weight-medium mb-0 text-white">
                                CLIENTES REGISTROS
                            </h4>
                            <h5 class="text-white">No. {{$clietes}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card bg-cyan text-white" style="background-color: #71afef;">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <a href="JavaScript: void(0);">
                            <i class="fa fa-money" style="font-size: 45px; color: #FFF" class="mx-2" aria-hidden="true"></i>
                        </a>
                        <div class="mx-3 mt-2">
                            <h4 class="font-weight-medium mb-0 text-white">
                                VENTAS ESPERADAS
                            </h4>
                            <h5 class="text-white">Q. {{number_format($ventas, 2)}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card bg-orange text-white" style="background-color: #d1587f;">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <a href="JavaScript: void(0);">
                            <i class="fas fa-boxes" style="font-size: 45px; color: #FFF" class="mx-2"></i>
                        </a>
                        <div class="mx-3 mt-2">
                            <h4 class="font-weight-medium mb-0 text-white">
                                ARTICULOS
                            </h4>
                            <h5 class="text-white">No. {{$articulounic}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-md-3">
            <div class="card bg-info text-white" style="background-color: #009c37;">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <a href="JavaScript: void(0);">
                            <i class="fas fa-sign-out-alt" style="font-size: 45px; color: #FFF" class="mx-2"></i>
                        </a>
                        <div class="mx-3 mt-2">
                            <h4 class="font-weight-medium mb-0 text-white">
                                SALIDAS DE EFECTIVO
                            </h4>
                            <h5 class="text-white">Q. {{ number_format( $salidas, 2 ) }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card bg-inverse text-white" style="background-color: #c3b15c;">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <a href="JavaScript: void(0);">
                            <i class="fas fa-newspaper" style="font-size: 45px; color: #FFF" class="mx-2"></i>
                        </a>
                        <div class="mx-3 mt-2">
                            <h4 class="font-weight-medium mb-0 text-white">
                                ARTICULOS EN OFERTA
                            </h4>
                            <h5 class="text-white">No. {{$catalogo}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card text-white" style="background-color: #813372;">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <a href="JavaScript: void(0);">
                            <i class="fas fa-user-tie" style="font-size: 45px; color: #FFF" class="mx-2"></i>
                        </a>
                        <div class="mx-3 mt-2">
                            <h4 class="font-weight-medium mb-0 text-white">
                                DEUDA DE CLIENTES
                            </h4>
                            <h5 class="text-white">No. {{$deudasCliente}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> 
    
    <div class="row mt-2">

    
        <div class="col-md-6 card d-none">
            <h1>Articulos a Vencer en {{config('app.articulos_vencidos')}} dias </h1>
            <div class="table-resposive">
                <table class="table table-borderless table-striped table-earning" id="tablasss">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Articulo</th>
                            <th>Stock</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vencidos as $art)
                        <tr>
                            <td>{{$art->fecha_ven}}</td>
                            <td>{{$art->nombre}} {{$art->descripcion}}</td>
                            <td>{{$art->stock}}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{route('articulo.show', ['id' => $art->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Añadidos Recientemente</h4>
                    <div class="list-group">
                        @foreach ($anadidos as $art )
                        <a href="{{route('articulo.show', ['id' => $art->id])}}" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $art->nombre}}</h5>
                                <small> Stock: {{$art->stock}}</small>
                            </div>
                            <p class="mb-1"><?php echo $art->descripcion; ?></p>
                            <small>Q. {{ number_format($art->p_venta, 2) }}</small>
                        </a>
                        @endforeach
                        <a href="{{route('articulo.index')}}" class="btn btn-link">Ver Todos</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <div class="row mt-2 mb-2">
        <div class="col mb-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ARTICULOS</h4>
                    <p class="card-text">LISTADO ARTICULOS CON POCA EXISTENCIA</p>
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-earning dataTable" id="table_id2" data-page-length="5">
                            <thead>
                                <tr style="cursor: pointer;">
                                    <th>Articulo</th>
                                    <th>Codigo de Barras</th>
                                    <th>Stock</th>
                                    <th>Minimo de Stock</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($artStock as $art)
                                @if ($art->stock <= $art->min_stock)
                                    <tr>
                                        <td>{{$art->nombre}} <?php echo $art->descripcion; ?></td>
                                        <td>{{$art->cod_barras}}</td>
                                        <td>{{$art->stock}}</td>
                                        <td>{{$art->min_stock}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{route('articulo.show', ['id' => $art->id])}}"><i class="fa fa-eye" aria-hidden="true"></i> Ver Datos</a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <div class="row mb-5">
        <div class="col-md-6">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pago de Abono a Proveedores en {{config('app.pago_proveedor')}} dias</h4>
                    <div class="table-responsive">
                        <table class="table table-hover  ">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Proveedor</th>
                                    <th>Telefonos</th>
                                    <th>Valor</th>
                                    <th>Fecha de Pago</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($abonos as $ab)

                                <tr>
                                    <td>{{$ab->nombre}}</td>
                                    <td>{{$ab->telefono1}} / {{$ab->telefono2}}</td>
                                    <td>{{$ab->valor}}</td>
                                    <td>{{$ab->fecha_de_pago}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CREDITOS PROXIMOS A COBRAR EN {{config('app.cobrar_creditos')}} DIAS</h4>
                    <div class="table-responsive">
                        <table class="table table-sm ">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>#</th>
                                    <th>CLIENTE</th>
                                    <th>DESCRIPCION</th>
                                    <th>FECHA DE PAGO</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deudas as $deu)
                                <tr>
                                    <td>{{$deu->id}}</td>
                                    <td>{{$deu->nombre}} / {{$deu->telefono1}}, {{$deu->telefono2}} </td>
                                    <td>{{$deu->descripcion}}</td>
                                    <td>{{$deu->fecha_pago}}</td>
                                    <td>Q. {{number_format($deu->total, 2)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body table-responsive">
                    <h4>PAGO DE CHEQUES EN {{config('app.pago_cheques')}} DIAS</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>PROVEEDOR</th>
                                <th>TELEFONO</th>
                                <th>VALOR</th>
                                <th>FECHA DE COBRO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cheques as $che)
                            <tr>
                                <td>{{$che->nombre}}</td>
                                <td>{{$che->telefono1}}</td>
                                <td>Q. {{number_format($che->valor, 2)}}</td>
                                <td>{{$che->fecha_cobro}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')

<script src="{{asset('plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatable/js/dataTables.bootstrap4.min.js')}}"></script>


@endsection