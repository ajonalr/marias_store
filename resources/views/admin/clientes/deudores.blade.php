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
                    <h4 class="card-title">Deudores</h4><br>
                    <table class="table table-hover" id="table_id" data-page-length="15">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Telefono 1</th>
                                <th>Telefono 2</th>
                                <th>Deuda</th>
                                <th>Accion </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deudores as $deu)
                            <tr>
                                <td>{{$deu->nombre}}</td>
                                <td>{{$deu->direccion}}</td>
                                <td>{{$deu->telefono1}}</td>
                                <td>{{$deu->telefono2}}</td>
                                <td>Q. <b>{{number_format($deu->deuda, 2)}}</b></td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{route('cliente.show', ['id' => $deu->id])}}"><i class="fa fa-eye" aria-hidden="true"></i>Datos</a>
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