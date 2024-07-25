@extends('layouts.app')

@section('content')

<div class="container-fluid">
   <div class="row">
      <div class="col">

         <div class="text-center h3">REPORTE DE VENTAS DE USUARIO: {{$user->name}} </div>
         <div class="text-center h5">Inicio {{$inicio}} - Fin {{$fin}}</div>

         <table class="table">
            <thead>
               <tr>
                  <th>FECHA</th>
                  <th>CLIENTE</th>
                  <th>RECIBO</th>
                  <th>ARTICULO</th>
                  <th>VENTA</th>
                  <th>CANTIDAD</th>
                  <th>DESCUENTO</th>
                  <th>SUBTOTAL</th>
               </tr>
            </thead>
            <tbody>
               <?php $t_v = 0; ?>
               @foreach ($data as $d)
               @php
               $t_v += $d->total;
               @endphp
               <tr>
                  <td>{{$d->created_at}}</td>
                  <td>{{$d->cliente->nombre}}</td>
                  <td>{{$d->factura_id}}</td>
                  <td>{{$d->articulo->nombre}} {{$d->articulo->descripcion}}</td>
                  <td>Q. {{number_format($d->articulo->p_venta, 2)}}</td>
                  <td>{{$d->cantidad}}</td>
                  <td>{{number_format($d->descuento, 2)}}</td>
                  <td>Q. {{number_format($d->total, 2)}}</td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
   <div class="d-flex justify-content-center">
      <div>
         <div class="card">
            <div class="card-body text-center">
               <h4 class="card-title">Q. {{number_format($t_v, 2)}}</h4>
               <p class="card-text">TOTAL EN VENTAS</p>
            </div>
         </div>
      </div>
   </div>

</div>

@endsection