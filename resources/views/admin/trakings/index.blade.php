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
                    <h4 class="card-head">
                        <p class="text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
                                <i class="fas fa-plus-square    "></i> Registrar Tracking
                            </button>
                        </p>
                    </h4>
                    <!-- Button trigger modal -->


                    <!-- Modal para añadi un nuevo tracking-->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Registrar Tracking en Espera a Entrar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{route('tra.store')}}" method="POST">
                                        @csrf()

                                        <div class="form-group">
                                            <label for="">Descripcion de Paquete</label>
                                            <input type="text" name="descripcion" class="form-control" placeholder="AGREGUE LA DESCRIPCION DEL PAQUETE">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Numero de Tracking</label>
                                            <input type="text" name="traking" class="form-control" placeholder="AGREGUE EL NUMERO DE TRACKING DE SU PAQUETE">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Costo</label>
                                            <input type="text" name="costo" class="form-control" placeholder="AGREGUE EL COSTO DE SU PAQUETE">
                                        </div>

                                        <div class="form-group invisible">
                                            <input type="text" name="estado" value="true">
                                        </div>

                                        <button type="submit" name="" id="" class="btn btn-primary btn-lg btn-block"> <i class="fas fa-save    "></i> Guardar</button>

                                    </form>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal para añadir un nuevo tracking -->


                    <h4 class="text-center display-4">Tracking en Curso</h4>
                    <table class="table table-hover" id="table_id" data-page-length="15">
                        <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th>Tracking </th>
                                <th>Costo</th>
                                <th>Fecha de Registro</th>
                                <th>Recibido</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($falta as $flt)
                            <tr>
                                <td>{{$flt->descripcion}}</td>
                                <td>{{$flt->traking}}</td>
                                <td>{{$flt->precio}}</td>
                                <td>{{$flt->created_at}}</td>

                                <td>

                                    <a class="btn btn-sm btn-primary" href="{{route('tra.entre', ['id' => $flt->id])}}"><i class="fa fa-eye" aria-hidden="true"></i> Recibido</a>



                                    <a class="btn btn-sm btn-danger" onclick="return confirm('Esta Seguro de Eliminar?')" href="{{route('tra.destroy', ['id' => $flt->id])}}"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <h4 class="text-center display-4">Tracking's Recibidos</h4>
                    <table class="table table-hover" id="table_id2" data-page-length="15">
                        <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th>Tracking </th>
                                <th>Costo</th>
                                <th>Fecha de Registro</th>
                                <th>Recibido</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($entre as $ent)
                            <tr>
                                <td>{{$ent->descripcion}}</td>
                                <td>{{$ent->traking}}</td>
                                <td>{{$ent->precio}}</td>
                                <td>{{$ent->created_at}}</td>

                                <td>

                                    <a class="btn btn-sm btn-primary" href="{{route('tra.reg', ['id' => $ent->id])}}"><i class="fa fa-eye" aria-hidden="true"></i> Regresar a "En Curso"</a>



                                    <a class="btn btn-sm btn-danger" onclick="return confirm('Esta Seguro de Eliminar?')" href="{{route('tra.destroy', ['id' => $ent->id])}}"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>

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
                    'next': 'SIGUIENTE',
                    'previous': 'ATRAS'
                },
                'loadingRecords': 'CARGANDO',
                'emptyTable': 'NO HAY DATOS',
                'zeroRecords': 'NO HAY DATOS IGUALES'
            }
        });
        $('#table_id2').DataTable({
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