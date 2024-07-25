@extends('layouts.app')

@section('content')

<div class="container-fluid">
   <div class="row">
      <div class="col">

         <p class="h1 text-center">ABONOS REALIZADOS</p>

         <table class="table">
            <thead>
               <tr>
                  <th>#</th>
                  <th>PROVEEDOR</th>
                  <th>VALOR</th>
                  <th>TIPO</th>
                  <th>DESCRIPCION</th>
                  <th>FECHA DE COBRO</th>
                  <th>FECHA DE REGISTRO</th> 
               </tr>
            </thead>
            <tbody>
               <?php $t=0;?>
               @foreach ($abonos as $a)
               <?php $t += $a->valor;?>
               <tr>
                  <td>{{$a->id}}</td>
                  <td>{{$a->proveedor->nombre}} - {{$a->proveedor->empresa}}</td>
                  <td>Q. {{number_format($a->valor, 2)}}</td>
                  <td>{{$a->tipo}}</td>
                  <td>{{$a->descripcion}}</td>
                  <td>{{$a->fecha_cobro}}</td>
                  <td>{{$a->created_at}}</td>
               </tr>
               @endforeach
              
            </tbody>
         </table>

         <div class="text-center h3">TOTAL EN ABONOS: Q. {{number_format($t, 2)}}</div>

      </div>
   </div>
</div>

@endsection