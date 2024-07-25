@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">

                    <div class="d-flex justify-content-sm-between">
                        <h3 class="card-title">Listado de Articulos</h3>

                        <div class=""><a class="btn btn-primary" href="{{route('articulo.nuevo')}}"> <i class="fa fa-plus" aria-hidden="true"></i> Registrar Articulo</a></div>
                    </div>

                    <div class="table-responsive  table-responsive mb-5">
                        <table class="table table-data table-hover" id="table_id" data-page-length="40">
                            <thead style=" cursor: pointer;">
                                <tr style="background-color: black; color:white;">
                                    <th style="color: white;"></th>

                                    <th style="color: white;">Nombre <i class="fa fa-sort"></i> </th>
                                    <th style="color: white;">Descripcion <i class="fa fa-sort"></i> </th>
                                    <th style="color: white;">Categoria <i class="fa fa-sort"></i></th>
                                    <th style="color: white;">Precio Venta <i class="fa fa-sort"></i></th>
                                    <th style="color: white;">Stock <i class="fa fa-sort"></i></th>
                                    <th style="color: white;">Minimo Stock <i class="fa fa-sort"></i></th>
                                    <th style="color: white;">Codigo de Barras <i class="fa fa-sort"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articulos as $art)

                                <tr class="tr-shadow @if ($art->stock < $art->min_stock)
                            bg-info text-white
                        @endif">
                                    <td>

                                        @can('articulos_show')
                                        <a class="item btn btn-success" href="{{route('articulo.show', ['id' => $art->id])}}" data-toggle="tooltip" data-placement="top" title="Ver Datos de  {{$art->nombre}}" data-original-title="Editar {{$art->nombre}}">
                                            <i class="fa fa-eye" style="color:white;" aria-hidden="true"></i>
                                        </a>
                                        @endcan

                                        @can('articulos_delete')
                                        <a class="item btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar {{$art->nombre}}" onclick="return confirm('Esta Seguro de Eliminar' )" data-original-title="Eliminar {{$art->nombre}}" href="{{route('articulo.delete', ['id' => $art->id])}}" onclick="return confirm('Esta Seguro de Eliminar?')">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        @endcan

                                    </td>
                                    <td>{{$art->nombre}}</td>
                                    <td>@php
                                        echo $art->descripcion;
                                        @endphp</td>
                                    <td>{{$art->nomCat}}</td>
                                    <td>Q. {{number_format($art->p_venta, 2)}}</td>
                                    <td>{{$art->stock}}</td>
                                    <td><span class="badge badge-warning" style="    background-color: #ff9595;font-size: 14px;color: white;">{{$art->min_stock}}</span></td>
                                    <td>{{$art->cod_barras}}</td>

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
        var table = $('#table_id').DataTable({
            scrollY: '60vh',
            scrollCollapse: true,
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
            },
            lengthMenu: [
                [10, 25, 15, 50, -1],
                [10, 25, 15, 50, 'All'],
            ],
        });

        
    });
</script>
@endsection