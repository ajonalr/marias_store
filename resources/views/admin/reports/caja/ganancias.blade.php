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
      <div class="col-md-6">
         <h3 class="text-center text-info">
            <p>VENTAS</p>
            <p>Total en Ventas (esperadas): Q. {{ number_format($totalventasesperadas, 2) }}</p>
            <p>Total en Descuentos: Q. {{number_format($totaldescuentos, 2) }}</p>
            <p>Total en Ventas - Descuentos: Q. {{ number_format($totalventasmenosdescuentos, 2) }}</p>
            <p>Total Inversion: Q. {{number_format($totalInversion, 2)}}</p>
            <p>Ganancias Brutas: Q. {{number_format($totalganancias, 2)}}</p>
         </h3>
      </div>
      <div class="col-md-6">
         <h3 class="text-center text-info">
            <p>SALIDAS / GASTOS</p>
            <p>Total en Gastos / Salidas: Q. {{ number_format($total, 2) }}</p>
         </h3>
      </div>
   </div>

   <div class="row">
      <div class="col-md-12 text-success h2 text-center">
         GANANCIAS LIQUIDAS: Q. {{number_format($totalganancias - $total , 2)}}
      </div>
   </div>

   <div class="row">
      <div class="col mt-4">
         <h4 class="display-4 text-capitalize text-center"> Articulos Vendidos de: {{$mes}}, al : {{$ano}} </h4>
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
               @foreach($ventas as $d)
               <tr>
                  <td>{{$d->factura_id}} / {{$d->tipo}}</td>
                  <td>{{$d->nomArt}} <?php echo $d->descripcion ?></td>
                  <td>Q. {{number_format($d->total / $d->cantidad, 2 )}}</td>
                  <td>Q {{number_format($d->p_costo, 2)}}</td>
                  <td>Q. {{number_format($d->descuento / $d->cantidad, 2)}}</td>
                  <td>Q. {{number_format( (($d->total / $d->cantidad)  - $d->p_costo)  )}}</td>
                  <td> {{number_format($d->cantidad, 2)}}</td>
                  <td>Q. {{number_format($d->p_costo * $d->cantidad, 2)}}</td>
                  <td>Q. {{number_format($d->descuento, 2)}}</td>
                  <td>Q. {{number_format($d->total, 2)}}</td>
                  <td>Q. {{ number_format($d->total - ($d->p_costo * $d->cantidad), 2)}} </td>
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

         <h1 class="display-4 text-center">REPORTE DE SALIDAS</h1>

         <table class="table">
            <thead>
               <tr>
                  <th>Fecha</th>
                  <th>Valor</th>
                  <th>Usuario</th>
                  <th>Descripcion</th>
                  <th>Tipo</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($salidas as $dt)
               <tr>
                  <td scope="row">{{$dt->fecha}}</td>
                  <td>Q. {{number_format($dt->valor, 2)}}</td>
                  <td>{{$dt->name}}</td>
                  <td>{{$dt->descripcion}}</td>
                  <td>{{$dt->tipo}}</td>
               </tr>
               @endforeach

            </tbody>
         </table>

         <h4>Total: Q. {{number_format($total, 2)}}</hh4>
      </div>
   </div>



</div>

@endsection