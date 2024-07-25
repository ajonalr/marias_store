@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <p class="text-center">INGREDIENTES REGISTRADOS</p>
        <table class="table table-data table-hover" id="table_id" data-page-length="40">
            <thead style=" cursor: pointer;">
                <tr >
                    <th></th>
                    <th >Nombre  </th>
                    <th >Descripcion  </th>
                    <th >Cantidad</th>
                    <th >Factura </th>
                    <th >Usuario </th>
                </tr>
            </thead>
            <tbody>
                @foreach($ingredientes as $art)

                <tr class="tr-shadow ">
                    <td>
                        <a href="{{route('ingrediente.delete_compra', $art)}}" type='submit' class='btn btn-danger' onclick="return confirm('Esta Seguro de Eliminar?')" ><i class='fa fa-trash' aria-hidden='true'></i></a>
                    </td>
                
                    <td>{{$art->ingrediente->nombre}}</td>
                    <td>@php
                        echo $art->ingrediente->descripcion;
                        @endphp</td>

                    <td>Q. {{number_format($art->cantidad, 2)}}</td>
                    <td>{{$art->factura}}</td>
                    <td><span class="badge badge-warning" style="    background-color: #ff9595;font-size: 14px;color: white;">{{$art->user->name}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection