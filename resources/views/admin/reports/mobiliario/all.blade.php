@extends('layouts.app')

@section('content')

<table class="table table-striped table-hover" id="table_id" data-page-length="15">
   <thead class="thead">
      <tr>
         <th>No</th>
         <th>NOMBRE</th>
         <th>DESCRIPCION</th>
         <th>CANTIDAD</th>
         @if ($visible)
         <th>PRECIO</th>
         <th>TOTAL</th>
         @endif
         <th>FECHA DE MANTENIMIENTO</th>
      </tr>
   </thead>
   <tbody>
      @php
      $t_in = 0;
      @endphp
      @foreach ($dat as $data)
      <tr>
         <td>{{ $data->id }}</td>
         <td>{{ $data->nombre }}</td>
         <td>@php echo $data->descripcion; @endphp</td>
         <td>{{ $data->cantidad }}</td>
         @if ($visible)
         <td>Q. {{ number_format($data->precio, 2) }}</td>
         <td>Q. {{ number_format($data->precio * $data->cantidad, 2) }}</td>
         @endif
         <td>{{$data->mantenimiento}}</td>
         @php

         $t_in += $data->precio * $data->cantidad;

         @endphp
      </tr>
      @endforeach
   </tbody>
</table>

@if ($visible)
<p class="text-center text-upercase h4">
   TOTAL DE INVERSION <b>Q. {{number_format($t_in, 2)}}</b>
</p>
@endif

@endsection