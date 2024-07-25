@extends('layouts.app')

@section('content')
    <div class="container-fuild p-5">
        <div class="row">
            <div class="col">
                <h4 class="card-title text-center display-4"><img src="{{asset('assets/images/logo.png')}}" class="img-fluid" alt="{{config('app.name', 'MEGACEL') }}"> <br>Categorias Registradas</h4>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover" id="table_id" data-page-length="15">
                            <thead>
                                <tr>
                                    <th># Codigo</th>
                                    <th>Nombre</th>
                                    <th>Empresa</th>
                                    <th>Direccion</th>
                                    <th>Telefono Primario</th>
                                    <th>Telefono Secundario</th>
                                    <th>Dias que Visita</th>
                                    <th>Articulos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->nombre}}</td>
                                    <td>{{$data->empresa}}</td>
                                    <td>{{$data->direccion}}</td>
                                    <td>{{$data->telefono1}}</td>
                                    <td>{{$data->telefono2}}</td>
                                    <td>{{$data->dias}}</td>
                                    <td>{{$data->articulos}}</td>
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