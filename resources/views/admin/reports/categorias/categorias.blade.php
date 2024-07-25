@extends('layouts.app')

@section('content')
<div class="container-fluid p-5">
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
                                <th>Tipo de Venta</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorias as $cat)
                            <tr>
                                <td>{{$cat->id}}</td>
                                <td>{{$cat->nombre}}</td>
                                <td>{{$cat->tipo}}</td>
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