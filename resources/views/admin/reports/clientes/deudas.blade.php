@extends('layouts.app')
@section('content')

<div class="container-fluid">
   <div class="row">
      <div class="col">

         <p class="h3 text-center">ABONOS / CREDITOS DE CLIENTE {{$cli->nombre}}</p>
         <p class="h4 text-center">DE {{$inicio}} A {{$fin}} </p>

         <h4>CREDITOS</h4>

         <div class="table-responsive">
            <table class="table table-sm ">
               <thead class="thead-inverse">
                  <tr>
                     <th>#</th>
                     <th>DESCRIPCION</th>
                     <th>FECHA DE PAGO</th>
                     <th>FECAH DE REGISTRO</th>
                     <th>TOTAL</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @php
                  $t_deuda = 0;
                  @endphp
                  @foreach ($deudas as $deu)
                  @php
                  $t_deuda += $deu->total;
                  @endphp
                  <tr>
                     <td>{{$deu->id}}</td>
                     <td>{{$deu->descripcion}}</td>
                     <td>{{$deu->fecha_pago}}</td>
                     <td>{{$deu->created_at}}</td>
                     <td>Q. {{number_format($deu->total, 2)}}</td>
                     <td>
                        <!-- <a href="{{route('cliente.pagarDeuda', ['id' => $deu->id])}}" calss="btn btn-primary rounded-circle"><i class="fa fa-check-circle" aria-hidden="true"></i></a> -->
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>


         </div>

         <h4>ABONOS</h4>

         <div class="table-responsive">
            <table class="table table-sm ">
               <thead class="thead-inverse">
                  <tr>
                     <th>#</th>
                     <th>FECHA DE REGISTRO</th>
                     <th>DESCRIPCION</th>
                     <th>TOTAL</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @php
                  $t_abono = 0;
                  @endphp
                  @foreach ($abonos as $deu)
                  @php
                  $t_abono += $deu->total;
                  @endphp
                  <tr>
                     <td>{{$deu->id}}</td>
                     <td>{{$deu->created_at}}</td>
                     <td>{{$deu->descripcion}}</td>
                     <td>Q. {{number_format($deu->total, 2)}}</td>
                     <td>

                        <!-- <a href="" calss="btn btn-primary rounded-circle"><i class="fa fa-check-circle" aria-hidden="true"></i></a> -->
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>


         <div class="row justify-content-center">
            <div class="col-md-3">
               <div class="card">
                  <div class="card-body">
                     <p class="card-text">Total Credito : Q.{{number_format( $t_deuda,2)}}</p>
                     <p class="card-text">Total Abonado: Q.{{number_format($t_abono,2)}}</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection