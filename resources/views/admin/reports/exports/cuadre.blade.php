@extends('layouts.app')
@section('styles')
<style>
    body {
        background-color: white !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid p-3">
    <div class="row">
        <div class="col mt-4">
            <h4 class="text-center display-4">Cuadres </h4>
        </div>
    </div>
    <div class="row my-4">
        <div class="col">
            <table class="table table-hover" id="cauadres" data-page-length="31">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Usuarios </th>
                        <th>Entradas Fuera de Ventas </th>
                        <th>Salidas</th>
                        <th>Total En Cuadre</th>
                        <th>Total en Efectivo</th>
                        <th>Total en POS</th>
                        <th>Total en Depositos</th>
                        <th>Faltante</th>
                        <th>Anular Cuadre</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($cuadres as $cau)
                    <tr>
                        <td>{{$cau->created_at}}</td>
                        <td>{{$cau->name}}</td>
                        <td>Q. {{number_format($cau->entrada, 2)}}</td>
                        <td>Q. {{number_format($cau->salida, 2)}}</td>
                        <td>Q. {{number_format($cau->cuadre, 2)}}</td>
                        <td>Q. {{number_format($cau->totalEfectico, 2)}}</td>
                        <td>Q. {{number_format($cau->totalVisas, 2)}}</td>
                        <td>Q. {{number_format($cau->depositos, 2)}}</td>
                        <td>Q. {{number_format($cau->faltante, 2)}}</td>
                        <td>

                            @php
                            $aux = explode(" ", $cau->created_at);
                            @endphp

                            @can('caja_movimientos_dia')
                            <a href="{{route('caja.cuadreFecha', [ 'fecha' => $aux[0] ] )}}" class="btn btn-sm btn-info"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                            @endcan

                            @can('caja_cuadre_delete')
                            <a href="{{route('caja.deleteCuadre', [ 'id' => $cau->id ] )}}" class="btn btn-sm btn-danger" onclick="return confirm('Esta Seguro de Eliminar' )"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
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