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

                    <div class="d-flex justify-content-sm-between">
                        <h3 class="card-title">Listado de Articulos</h3>

                        <div class=""><a class="btn btn-primary" href="{{route('cliente.create')}}"> <i class="fa fa-plus" aria-hidden="true"></i> Registrar Cliente</a></div>
                    </div>

                    <br>

                    <div class="table-responsive mb-5">
                        <table class="table table-hover" id="table_id" data-page-length="15">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Nit </th>
                                    <th>Direccion</th>
                                    <th>Telefono 1</th>
                                    <th>Telefono 2</th>
                                    <th>Accion </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clientes as $cli)
                                <tr>
                                    <td>{{$cli->nombre}}</td>
                                    <td>{{$cli->nit}}</td>
                                    <td>{{$cli->direccion}}</td>
                                    <td>{{$cli->telefono1}}</td>
                                    <td>{{$cli->telefono2}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{route('cliente.show', ['id' => $cli->id])}}"><i class="fa fa-eye" aria-hidden="true"></i>Datos</a>

                                        <a class="btn btn-sm btn-danger" onclick="return confirm('Esta Seguro de Eliminar?')" href="{{route('cliente.delete', ['id' => $cli->id])}}"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
        $('#table_id').DataTable({
            "language": {
                'info': '_TOTAL_ Registros',
                'search': 'Buscar',
                'paginate': {
                    'next': 'SIGUIENTE',
                    'previous': 'ATRAS'
                },
                'loadingRecords': 'CARGANDO',
                'emptyTable': 'NO HAY DATOS',
                'zeroRecords': 'NO HAY DATOS IGUALES'
            }
        });
    });
</script>
@endsection