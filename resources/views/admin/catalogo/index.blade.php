@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">

@endsection

@section('content')


<div class="container-fluid mb-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="card">

                        <div class="card-body">

                            <table class="table table-hover" id="table_id" data-page-length="15">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Precio Venta</th>
                                        <th>Descuento</th>
                                        <th>Imagen</th>
                                        <th>Accion </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($articulos as $art)
                                    <tr>
                                        <td>{{$art->nombre}}</td>
                                        <td>{{$art->descripcion}}</td>
                                        <td>{{number_format($art->costo, 2)}}</td>
                                        <td>{{$art->descuento}} %</td>
                                        <td><img width="300px" src="{{ Storage::url($art->imagen) }}" class="img-fluid" alt="Imagen" style="max-width: 25%;" srcset=""></td>
                                        <td>

                                            @can('articulos_catalogo_update')
                                            <a class="btn btn-sm btn-primary" href="{{route('catalogo.show', ['id' => $art->id])}}"><i class="fa fa-eye" aria-hidden="true"></i> Ver Datos</a>
                                            @endcan

                                            @can('articulos_catalog_delete')
                                            <a class="btn btn-sm btn-danger" href="{{route('catalogo.delete', ['id' => $art->id])}}" onclick="return confirm('Esta Seguro de Eliminar?')" ><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>
                                            @endcan


                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>




                        </div>
                    </div>
                </div>
            </div>


            @can('articulos_catalogo_add')
            <div class="row">
                <div class="col">
                    <div class="card text-left">
                        <div class="card-body">
                            <h4 class="card-title">Nuevo Articulo</h4> <br>
                            <form action="{{route('catalogo.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @include('admin/catalogo/forms/form')
                                <div class="form-group col border">
                                    <div class="form-group">
                                        <label for="">Imagen</label>
                                        <input type="file" class="form-control-file" name="imagen" accept="image/*">
                                    </div>
                                </div>
                                <br>

                                <button class="btn  btn-outline-success"> <i class="fa fa-save"></i> Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endcan


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