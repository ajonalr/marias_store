@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">
@endsection


@section('content')
<div class="container-fluid mb-5">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-sm-around">
                        <h3 class="card-title">Historial de Ventas</h3>

                        <div class="">
                            <form action="" method="get" class="form-inline">
                                <div class="form-group">
                                    <label for="">FECHA DE HISTORIAL</label>
                                    <input type="date" class="form-control" name="fecha">
                                </div>

                                <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>

                    @if ($show)
                    <div class="table-responsive">

                        <table class="table table-hover" id="contado" data-page-length="15">
                            <thead>
                                <tr>
                                    <th>No. Factura</th>
                                    <th>Cliente</th>
                                    <th>Fecha / Hora de Venta</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contado as $con)
                                <tr> 
                                    <td>{{$con->factura_id}} / <br> MESA:  {{$con->mesa}}</td>
                                    <td>{{$con->nombre}}</td>


                                    <td>{{$con->fechaVenta}}</td>
                                    <td>

                                        <a class="btn btn-sm btn-warning" href="{{route('venta.showventa', $con->factura_id)}}" role="button"><i class="fas fa-edit    "></i></a>

                                        @can('venta_recibo')
                                        <a target="_blank" class="btn btn-primary btn-sm" href="{{route('venta.facturaPrint', ['idFactura' => $con->factura_id, 'idCliente' => $con->cliente_id] )}}"><i class="fa fa-print" aria-hidden="true"></i> Recibo</a>
                                        <form action="{{route('ventas.generatePropina')}}" method="post">
                                            @csrf
                                            <button type='submit' class='btn btn-info' onclick="return confirm('Esta Seguro de Generar Propina?')" ><i class="fa fa-money" aria-hidden="true"></i></button>
                                        </form>
                                        @endcan

                                        @can('venta_anulacion')
                                        <a class="btn btn-danger btn-sm mt-1" href="{{route('venta.delete', ['id' => $con->factura_id, 'idArt' => $con->articulo_id] )}}" onclick="return confirm('Esta Seguro de Eliminar?')"> <i class="fa fa-trash" aria-hidden="true"></i>Anular</a>
                                        @endcan

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @endif

                    <!-- end ventas al contado -->
                    <hr>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatable/js/dataTables.bootstrap4.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#contado').DataTable({
            "language": {
                'info': '_TOTAL_ Registros',
                'search': 'Buscar',
                'paginate': {
                    'next': 'Siguiente',
                    'previous': 'Atras'
                },
                'loadingRecords': 'Cargando',
                'emptyTable': 'No hay datos',
                'zeroRecords': 'No hay datos iguales'
            }
        });


    });
</script>
@endsection