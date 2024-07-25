@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">
@endsection



@section('content')
<div class="container-fluid mb-5">
    <div class="row">
        <div class="col mb-5">
            <div class="card mb-5">
                <div class="card-body">

                    <div class="d-flex justify-content-sm-between">
                        <h3 class="card-title">Tipos de Ventas</h3>

                        <div class=""><a class="btn btn-primary" href="{{route('categoria.create')}}"> <i class="fa fa-plus" aria-hidden="true"></i> Registrar Categorias</a></div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover" id="table_id" data-page-length="15">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Imagen </th>
                                    <th>Accion </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categorias as $cat)
                                <tr>
                                    <td>{{$cat->nombre}}</td>
                                    <td>
                                        <img style="width: 10vh;" class="img-fluid img-thumbnail rounded" src="{{$cat->tipo}}" alt="" srcset="">
                                    </td>

                                    <td>

                                        <a class="btn btn-sm btn-primary" href="{{route('categoria.show', ['id' => $cat->id])}}"><i class="fa fa-eye" aria-hidden="true"></i> Ver Datos</a>

                                        <a class="btn btn-sm btn-danger" onclick="return confirm('Esta Seguro de Eliminar?')" href="{{route('categoria.delete', ['id' => $cat->id])}}"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>

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
                    'next': 'siguiente',
                    'previous': 'atras'
                },
                'loadingRecords': 'cargando',
                'emptyTable': 'No hay datos',
                'zeroRecords': 'No hay datos iguales'
            }
        });
    });
</script>
@endsection