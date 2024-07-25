@extends('layouts.admin')

@section('styles')
<!-- <link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}"> -->
@endsection


@section('content')
<div class="container-fluid mb-5">
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row d-flex align-items-stretch">
                <div class="col">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-sm-between">
                                <h3 class="card-title">Listado de Proveedores</h3>

                                <div class=""><a class="btn btn-primary" href="{{route('prove.create')}}"> <i class="fa fa-plus" aria-hidden="true"></i> Registrar Cotizacion</a></div>
                            </div>

                            <div class="table-responsive  table-responsive-data2 m-b-30">
                                <table class="table table-data2 table-hover " id="table_id" data-page-length="15">
                                    <thead>
                                        <tr style="background-color: black; color:white;">
                                            <th style="color: white;">Nombre</th>
                                            <th style="color: white;">Empresa</th>
                                            <th style="color: white;">Telefono </th>
                                            <th style="color: white;">Telefono Secundario</th>
                                            <th style="color: white;">Articulos</th>
                                            <th style="color: white;">Dias de Visita</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $data)
                                        <tr class="tr-shadow ">
                                            <td>{{$data->nombre}}</td>
                                            <td>{{$data->empresa}}</td>
                                            <td>{{$data->telefono1}}</td>
                                            <td>{{$data->telefono2}}</td>
                                            <td>{{$data->articulos}}</td>
                                            <td>{{$data->dias}}</td>
                                            <td>
                                                <div class="table-data-feature">

                                                    <a class="item btn btn-primary" href="{{route('prove.show', ['id' => $data->id])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar {{$data->nombre}}">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="item btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar {{$data->nombre}}" href="{{route('prove.delete', ['id' => $data->id])}}" onclick="return confirm('Esta Seguro de Eliminar?')">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </div>
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
                'info': '_TOTAL_ REGISTROS',
                'search': 'BUSCAR',
                'paginate': {
                    'next': 'SIGUIENTE',
                    'previous': 'ATRAS'
                },
                'loadingRecords': 'CARGANDO',
                'emptyTable': 'NO EXISTEN DATOS',
                'zeroRecords': 'NO EXISTEN DATOS IGUALES'
            }
        });
    });
</script>
@endsection