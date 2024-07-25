@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">

@endsection

@section('bread')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Oferta</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Actualizar Articulo en Oferta</a></li>
                    <li class="breadcrumb-item active">{{$articulo->nombre}}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('content')
<div class="row">
    <div class="col">

        <div class="card text-left">
            <div class="card-body">
                <form action="{{route('catalogo.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('admin/catalogo/forms/form')

                    <input type="hidden" name="id" value="{{$articulo->id}}">

                    <img width="300px" src="{{ Storage::url($articulo->imagen) }}" class="img-fluid" alt="Imagen" srcset="">

                    <div class="form-group col border">
                        <div class="form-group">
                            <label for="">Nueva Imagen</label>
                            <input type="file" class="form-control-file" name="imagen_new" accept="image/*">
                        </div>
                    </div>


                    <button class="btn  btn-outline-success"> <i class="fa fa-save"></i> Actualizar</button>

                </form>


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