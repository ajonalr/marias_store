@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    @can('caja_registro_gastos')
    <div class="row">
        <div class="col">
            <div class="alert alert-info alert-dismissible show" role="alert">
                <button type="button" class="close btn btn-info" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="card card-info">
                    <div class="card-body" style="color:black;">
                        <h3 class="card-title text-center">REGISTRAR GASTO</h3>
                        <form action="{{route('caja.salidaStore')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Valor </label>
                                <input type="text" name="valor" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">TIPO DE SALIDA / GASTO</label>
                                <select class="form-control" name="tipo">
                                    <option value="ADELANTO DE SUELDO">ADELANTO DE SUELDO</option>
                                    <option value="ALMUERZOS PERSONAL">ALMUERZOS PERSONAL</option>
                                    <option value="GASOLINA">GASOLINA</option>
                                    <option value="PAGO QUINCENA">PAGO QUINCENA</option>
                                    <option value="PAGO FIN DE MES">PAGO FIN DE MES</option>
                                    <option value="REPUESTOS">REPUESTOS</option>
                                    <option value="REFACCIONES">REFACCIONES</option>
                                    <option value="OTROS" selected>OTROS</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">DESCRIPCION: </label>
                                <textarea class="form-control" name="descripcion" rows="6">Descripcion: 


Entregado A:
                              </textarea>
                            </div>



                            <button type="submit" class="btn mt-2 btn-sm btn-outline-success"><i class="fas fa-save"></i> GUARDAR</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    @endcan


    <div class="row">
        <div class="col">
            <h4 class="card-title text-center display-4">Salidas de Efectivo</h4>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover" id="table_id" data-page-length="15">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Valor </th>
                                <th>Descripcion</th>
                                <th>Tipo</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($entradas as $ent)
                            <tr>
                                <td>{{$ent->fecha}}</td>
                                <td>{{ number_format(  $ent->valor, 2 )  }}</td>
                                <td>{{$ent->descripcion}}</td>
                                <td>{{$ent->tipo}}</td>

                                <td>
                                    @can('caja_delete_cajachica')
                                    <a href="{{route('caja.deletesalida', ['id' => $ent->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Esta Seguro de Eliminar?')"> <i class="fa fa-trash" aria-hidden="true"></i> Eliminar </a>
                                    @endcan

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-right mx-4">
                        <h2>Total de Salidas: Q. {{number_format($total, 2)}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection