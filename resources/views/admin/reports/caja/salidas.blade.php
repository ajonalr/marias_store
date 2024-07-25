@extends('layouts.app')

@section('content')

<div class="container-fluid" >
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
               @foreach ($data as $dt)
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