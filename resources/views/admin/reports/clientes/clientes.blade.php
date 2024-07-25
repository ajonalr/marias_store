@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h4 class="card-title text-center display-4"><img src="{{asset('assets/images/logo.png')}}" class="img-fluid" alt="{{config('app.name', 'LIBRERIA ELY') }}"> <br>Clientes Registrados</h4>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover" id="table_id" data-page-length="15">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Nit </th>
                                    <th>Direccion</th>
                                    <th>Telefono 1</th>
                                    <th>Telefono 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clientes as $cli)
                                <tr>
                                    <td>{{$cli->nombre}}</td>
                                    <td>{{$cli->nit}}</td>
                                    <td>{{$cli->direccion}}</td>
                                    <td>{{$cli->telefono1}}</td>
                                    <td>{{$cli->telefono2}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right mx-4">
                            <h2>Total de Clientes: {{$total}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection