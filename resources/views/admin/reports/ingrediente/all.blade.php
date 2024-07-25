@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <p class="text-center">INGREDIENTES REGISTRADOS</p>
        <table class="table table-data table-hover" id="table_id" data-page-length="40">
            <thead style=" cursor: pointer;">
                <tr >
                    <th >Nombre  </th>
                    <th >Descripcion  </th>
                    <th >Precio</th>
                    <th >Stock </th>
                    <th >Minimo Stock </th>
                </tr>
            </thead>
            <tbody>
                @foreach($ingredientes as $art)

                <tr class="tr-shadow ">
                
                    <td>{{$art->nombre}}</td>
                    <td>@php
                        echo $art->descripcion;
                        @endphp</td>

                    <td>Q. {{number_format($art->p_costo, 2)}}</td>
                    <td>{{$art->stock}}</td>
                    <td><span class="badge badge-warning" style="    background-color: #ff9595;font-size: 14px;color: white;">{{$art->min_stock}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection