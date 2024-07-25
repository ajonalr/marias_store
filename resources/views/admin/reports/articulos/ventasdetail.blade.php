@extends('layouts.app')

@section('styles')
<style>
  td,
  th {
    font-size: 10px;
  }
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col mt-4">
      <h4 class="display-4 text-capitalize text-center"> Articulo Vendidos:  {{$articulo->nombre}}, <?php echo $articulo->descripcion;?></h4>
    </div>
  </div>
  <div class="row my-4">
    <div class="col">
      <table class="table table-hover" id="deudas" data-page-length="15">
        <thead>
          <tr>
            <th>Rec. / Tipo</th>
            <th>Articulo </th>
            <th>P. Venta Uni.</th>
            <th>P. Costo Uni.</th>
            <th>Desc. Uni</th>
            <th>Utilidad Uni.</th>
            <th>Cantidad Ven.</th>
            <th>Total Costo</th>
            <th>Total Desc.</th>
            <th>Total Venta</th>
            <th>Ganancia</th>
            <th>Cliente</th>
            <th>Fecha / Hora de Venta</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $cnt = 0;
          ?>
          @foreach($data as $d)
          <?php

          $totalInversion += $d->articulo->p_costo * $d->cantidad;
          $totalganancias += $d->total - ($d->articulo->p_costo * $d->cantidad);
          $cnt += $d->cantidad;
          ?>
          <tr>
            <td>{{$d->factura_id}} / {{$d->tipo}}</td>
            <td>{{$d->articulo->nombre}} <?php echo $d->articulo->descripcion ?></td>
            <td>Q. {{number_format($d->total / $d->cantidad, 2 )}}</td>
            <td>Q {{number_format($d->articulo->p_costo, 2)}}</td>
            <td>Q. {{number_format($d->descuento / $d->cantidad, 2)}}</td>
            <td>Q. {{number_format( (($d->total / $d->cantidad)  - $d->articulo->p_costo)  )}}</td>
            <td> {{$d->cantidad}}</td>
            <td>Q. {{number_format($d->articulo->p_costo * $d->cantidad, 2)}}</td>
            <td>Q. {{number_format($d->descuento, 2)}}</td>
            <td>Q. {{number_format($d->total, 2)}}</td>
            <td>Q. {{ number_format($d->total - ($d->articulo->p_costo * $d->cantidad), 2)}} </td>
            <td>{{$d->nombre}}</td>
            <td>{{$d->fechaVenta}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>

  <div class="row">
    <div class="col">
      <h3 class="text-center text-info">

        <p>Total Vendidos: {{ $cnt }}</p>
        <p>Total en Ventas (esperadas): Q. {{ number_format($totalventasesperadas, 2) }}</p>
        <p>Total en Descuentos: Q. {{number_format($totaldescuentos, 2) }}</p>
        <p>Total en Ventas - Descuentos: Q. {{ number_format($totalventasmenosdescuentos, 2) }}</p>
        <p>Total Inversion: Q. {{number_format($totalInversion, 2)}}</p>
        <p>Ganancias: Q. {{number_format($totalganancias, 2)}}</p>

      </h3>

    </div>
  </div>
  <hr>
</div>
@endsection