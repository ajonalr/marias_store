@extends('layouts.admin')


@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Proyecto') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('proyectos.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('NUEVO PROYECTO') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table_id" data-page-length="15">
                            <thead class="thead" >
                                <tr>
                                    <th>No</th>
                                    <th>Cliente</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Total</th>
                                    <th>Git</th>
                                    <th>Fecha Entrega</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $proyecto)
                                <tr>
                                    <td>{{ $proyecto->id }}</td>

                                    <td>{{ $proyecto->cliente->nombre }}</td>
                                    <td>{{ $proyecto->nombre }}</td>
                                    <td>{{ $proyecto->descripcion }}</td>
                                    <td>{{ $proyecto->total }}</td>
                                    <td>{{ $proyecto->url_git }}</td>
                                    <td>{{ $proyecto->fecha_entrega }}</td>

                                    <td>
                                        <form action="{{ route('proyectos.destroy',$proyecto->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('proyectos.show',$proyecto->id) }}"><i class="fa fa-fw fa-eye"></i> </a>
                                            <a class="btn btn-sm btn-success" href="{{ route('proyectos.edit',$proyecto->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('¿Estas Seguro de Eliminar?')"class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> </button>
                                        </form>
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