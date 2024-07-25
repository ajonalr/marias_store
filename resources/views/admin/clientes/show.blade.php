@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">
@endsection



@section('content')

<div class="container-fluid mb-5">
    <div class="row mb-5">
        <div class="col mb-5">
            <div class="card p-4 mb-5">
                <h4 class="card-title text-uppercase">{{$cliente->nombre}} </h4><br>

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-capitalize" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">datos de Cliente</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="pills-deuda-tab" data-toggle="pill" href="#pills-deuda" role="tab" aria-controls="pills-deuda" aria-selected="false">Historial de Credito</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="pills-credito-tab" data-toggle="pill" href="#pills-credito" role="tab" aria-controls="pills-credito" aria-selected="false">Reporte de Credito</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Actualizar</a>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-success rounded" data-toggle="modal" data-target="#credito">
                            AÑADIR CREDITO
                        </button>
                    </li>

                    <li class="nav-item">

                        <button type="button" class="btn btn-primary rounded" data-toggle="modal" data-target="#abonos">
                            NUEVO ABONO
                        </button>
                    </li>

                </ul>

                <div class="tab-content" id="pills-tabContent">

                    <!-- Modal para abonos-->
                    <div class="modal fade" id="abonos" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">NUEVO ABONO</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('cliente.abonosNew')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="cliente_id" value="{{$cliente->id}}">

                                        <div class="form-group">
                                            <label for="descripcion">DESCRIPCION</label>
                                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Tipo de Abono</label>
                                            <select class="form-control" name="tipo">
                                                <option value="EFECTIVO">EFECTIVO</option>
                                                <option value="DEPOSITO">DEPOSITO</option>
                                                <option value="CHEQUE">CHEQUE</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">TOTAL DE ABONO</label>
                                            <input type="number" class="form-control form-control-sm" name="total" step="any" placeholder="VALOR DE CREDITO" required>
                                        </div>

                                        <button type="submit" class="btn btn-info rounded"> GARDAR ABONO</button>

                                    </form>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para creadito -->
                    <div class="modal fade" id="credito" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">CREDITO</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{route('cliente.saveDeuda')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="cliente_id" value="{{$cliente->id}}">

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="salto" value="1">
                                                MAS CREDITO
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="descripcion">DESCRIPCION</label>
                                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="">TOTAL DE DEUDA</label>
                                            <input type="number" class="form-control form-control-sm" name="total" step="any" placeholder="VALOR DE CREDITO" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">FECHA DEPAGO</label>
                                            <input type="date" class="form-control" name="fecha_pago">
                                        </div>



                                        <button type="submit" class="btn btn-info rounded"> GARDAR</button>

                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- compras  -->
                    <div class="tab-pane fade" id="pills-deuda" role="tabpanel" aria-labelledby="pills-deuda-tab">

                        <h4>CREDITOS</h4>

                        <div class="table-responsive">
                            <table class="table table-sm ">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>DESCRIPCION</th>
                                        <th>FECHA DE PAGO</th>
                                        <th>FECAH DE REGISTRO</th>
                                        <th>TOTAL</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $t_deuda = 0;
                                    @endphp
                                    @foreach ($deudas as $deu)
                                    @php
                                    $t_deuda += $deu->total;
                                    @endphp
                                    <tr>
                                        <td>{{$deu->id}}</td>
                                        <td><?php echo $deu->descripcion; ?></td>
                                        <td>{{$deu->fecha_pago}}</td>
                                        <td>{{$deu->created_at}}</td>
                                        <td>Q. {{number_format($deu->total, 2)}}</td>
                                        <td>
                                            <form action="{{route('cliente.deleteCredito', $deu->id)}}" method="post">
                                                @csrf
                                                @method('delete')

                                                @can('admin')
                                                <button type='submit' class='btn btn-danger btn-sm' onclick="return confirm('Esta Seguro de Eliminar?')"><i class='fa fa-trash' aria-hidden='true'></i></button>
                                                @endcan
                                                
                                                <a target="_blank" href="{{route('cliente.print_credito', ['id' => $deu->id])}}" calss="btn btn-primary rounded-circle"><i class="fa fa-print" aria-hidden="true"></i></a>
                                            </form>


                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>

                        <h4>ABONOS</h4>

                        <div class="table-responsive">
                            <table class="table table-sm ">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>FECHA DE REGISTRO</th>
                                        <th>DESCRIPCION</th>
                                        <th>TIPO</th>
                                        <th>TOTAL</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $t_abono = 0;
                                    @endphp
                                    @foreach ($abonos as $deu)
                                    @php
                                    $t_abono += $deu->total;
                                    @endphp
                                    <tr>
                                        <td>{{$deu->id}}</td>
                                        <td>{{$deu->created_at}}</td>
                                        <td>{{$deu->descripcion}}</td>
                                        <td>{{$deu->tipo}}</td>

                                        <td>Q. {{number_format($deu->total, 2)}}</td>
                                        <td>

                                            <form action="{{route('cliente.deleteAbono', $deu->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                @can('admin')
                                                    
                                                <button type='submit' class='btn btn-danger' onclick="return confirm('Esta Seguro de Eliminar?')"><i class='fa fa-trash' aria-hidden='true'></i></button>
                                                @endcan
                                                <a target="_blank" href="{{route('cliente.print_abonos', ['id' => $deu->id])}}" calss="btn btn-primary rounded-circle"><i class="fa fa-print" aria-hidden="true"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- fin compras -->

                    <!-- reporte de creditos -->

                    <div class="tab-pane fade" id="pills-credito" role="tabpanel" aria-labelledby="pills-credito-tab">

                        <p class="text-center h4">REPORTE DE HISTORIAL DE CREDITO</p>

                        <form action="{{route('cliente.reportVentaToClienteAndDate')}}" method="POST">
                            @csrf()

                            <input type="hidden" name="cliente_id" value="{{$cliente->id}}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">De (Fecha de Inicio): </label>
                                        <input type="date" class="form-control" name="inicio" placeholder="Fecha de Inicio" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Hasta (Fecha de Final): </label>
                                        <input type="date" class="form-control" name="fin" placeholder="Fecha de Fin" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> BUSCAR</button>

                        </form>
                    </div>
                    <!-- fin reporte de creditos -->


                    <!-- Axtualizar  -->
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <h4>Actualizar Cliente</h4>
                        <form action="{{route('cliente.update', ['id' => $cliente->id])}}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('admin/clientes/components/form')


                            @can('admin')
                            <div class="form-group">
                                <label for="">DEUDA</label>
                                <input type="text" class="form-control" name="deuda" value="{{$cliente->deuda}}">
                            </div>
                            @endcan
                            <button type="submit" class="btn btn-success btn-block"> <i class="fa fa-save"></i> Actualizar</button>
                        </form>

                    </div>
                    <!-- end Actualizar -->

                    <!-- datos del cliente -->
                    <div class="tab-pane fade show active text-center" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                        <h4> Cliente / {{$cliente->nombre}}</h4>

                        <div class="card p-3">
                            <div class="center">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">{{$cliente->nombre}}</h5>
                                <p class="card-text text-capitalize">Direccion: {{$cliente->direccion}}</p>
                                <p class="card-text">Nit: {{$cliente->nit}}</p>
                                <p class="card-text">Telefono: {{$cliente->telefono1}}</p>
                                <p class="card-text">Telefono 2: {{$cliente->telefono2}}</p>

                            </div>
                        </div>


                        <p class="h2">Total Deuda: Q. {{number_format($cliente->deuda, 2)}}</p>



                    </div>
                    <!-- fin datos del cliente -->

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

        $('#deudas').DataTable({
            "language": {
                'info': '_TOTAL_ Registros',
                'search': 'Buscar',
                'paginate': {
                    'next': 'Siguiente',
                    'previous': 'Atras'
                },
                'loadingRecords': 'cargando',
                'emptyTable': 'No hay datos',
                'zeroRecords': 'No hay datos iguales'
            }
        });

        $('#compras').DataTable({
            "language": {
                'info': '_TOTAL_ Registros',
                'search': 'Buscar',
                'paginate': {
                    'next': 'Siguiente',
                    'previous': 'Atras'
                },
                'loadingRecords': 'cargando',
                'emptyTable': 'No hay datos',
                'zeroRecords': 'No hay datos iguales'
            }
        });
    });
</script>
@endsection