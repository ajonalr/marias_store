@extends('layouts.admin')

@section('content')
<div class="container-fluid mb-5">

    @can('caja_registro_cajachica')
    <div class="row">
        <div class="col mb-5">
            <div class="alert alert-info alert-dismissible  show" role="alert">
                <button type="button" class="close btn btn-info" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="card mb-5">

                    <div class="card-body" style="color: black;">
                        <h3 class="card-title text-center">REGISTRAR CAJA CHICA</h3>
                        <form action="{{route('caja.entradaStore')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Valor </label>
                                <input type="text" name="valor" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Descripcion</label>
                                <input type="text" class="form-control" name="descripcion" required>
                            </div>

                            <button type="submit" class="mt-2 btn btn-sm btn-outline-success"><i class="fas fa-save"></i> GUARDAR</button>
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
            <h4 class="card-title text-center display-4">CAJA CHICA</h4>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover" id="table_id" data-page-length="15">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Valor </th>
                                <th>Descripcion</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($entradas as $ent)
                            <tr>
                                <td>{{$ent->fecha}}</td>
                                <td>{{ number_format( $ent->valor , 2)}}</td>
                                <td>{{$ent->descripcion}}</td>
                                <td>

                                    @can('caja_delete_cajachica')
                                    <a href="{{route('caja.deleteentrada', ['id' => $ent->id])}}" class="btn btn-sm btn-danger"> <i class="fa fa-trash" onclick="return confirm('Esta Seguro de Eliminar?')" aria-hidden="true"></i> Eliminar </a>
                                    @endcan

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-right mx-4">
                        <h2>Total de Entradas: Q. {{number_format($total, 2)}}</h2>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection