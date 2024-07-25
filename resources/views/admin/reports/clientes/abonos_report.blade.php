@extends('layouts.app')

@section('content')

<div class="container-fluid">
   <div class="row">
      <div class="col">
         <div class="text-center h3">ABONOS DE CLIENTES</div>

         <table class="table">
            <thead>
               <tr>
                  <th>#</th>
                  <th>CLIENTE</th>
                  <th>DESCRIPCION</th>
                  <th>TIPO</th>
                  <th>TOTAL</th>
                  <th>FECHA DE REGISTRO</th>
               </tr>
            </thead>
            <tbody>
               <?php $t = 0; ?>
               @foreach ($data as $a)
               <?php $t += $a->total; ?>
               <tr>
                  <td>{{$a->id}}</td>
                  <td>{{$a->cliente->nombre}}</td>
                  <td>{{$a->descripcion}}</td>
                  <td>{{$a->tipo}}</td>
                  <td>Q. {{number_format($a->total, 2)}}</td>
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