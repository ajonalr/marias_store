@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col">
        @include('includes.alerts')
    </div>
</div>

<div class="container-fluid p-3" >
    <div class="row">
        <div class="col mt-4">
            <h4 class="text-center display-4">CUADRES </h4>
        </div>
    </div>
    <div class="row my-4">
        <div class="col">
            <table class="table table-hover" id="cauadres" data-page-length="31">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Usuarios </th>
                        <th>Entradas </th>
                        <th>Salidas</th>
                        <th>Servicios </th>
                        <th>Total En Cuadre</th>
                        <th>Total en Efectivo</th>
                        <th>Total en Visas</th>
                        <th>Faltante</th>
                        <th>Anular Cuadre</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($cuadres as $cau)
                    <tr>
                        <td>{{$cau->created_at}}</td>
                        <td>{{$cau->name}}</td>
                        <td>{{$cau->entrada}}</td>
                        <td>{{$cau->salida}}</td>
                        <td>{{$cau->servicios}}</td>
                        <td>{{$cau->cuadre}}</td>
                        <td>{{$cau->totalEfectico}}</td>
                        <td>{{$cau->totalVisas}}</td>
                        <td>{{$cau->faltante}}</td>
                        <td>
                            @can('caja_cuadre_delete')
                            <a href="{{route('caja.deleteCuadre', [ 'id' => $cau->id ] )}}" class="btn btn-sm btn-danger" onclick="return confirm('Esta Seguro de Eliminar?')"> <i class="fa fa-trash" aria-hidden="true"></i> Eliminar Cuadre</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection