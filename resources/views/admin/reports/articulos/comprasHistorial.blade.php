@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h4 class="card-title text-center display-4"><img src="{{asset('assets/images/logo.png')}}" class="img-fluid" alt="{{config('app.name', 'LIBRERIA ELY') }}"> <br>Historial de Articulos Comprados</h4>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover" id="table_id" data-page-length="15">
                        <thead>
                            <tr>
                                <th>Articulo</th>
                                <th>Descripcion </th>
                                <th>Factura </th>
                                <th>Cantidad </th>
                                <th>Usuario </th>
                                <th>Fecha </th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($historial as $data)
                            <tr>
                            <td>{{$data->nombre}} - {{$data->talla}}</td>

                                <td><?php echo $data->descripcion ?></td>
                                <td>{{$data->factura}}</td>
                                <td>{{$data->cantidad}}</td>
                                <td>{{$data->userName}}</td>
                                <td>{{$data->fecha}}</td>
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