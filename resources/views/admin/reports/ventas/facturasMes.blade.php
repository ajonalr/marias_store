@extends('layouts.app')

@section('content')

<div class="container-fluid">
   <div class="row">
      <div class="col">

         <div class="card">
            <div class="card-body">
               <h4 class="card-title text-center">FACTURAS</h4>
               <div class="table-responsive">
                  <table class="table table-sm" id="table_id">
                     <thead>
                        <tr>
                           <th>RECIBO</th>
                           <th>NOMBRE</th>
                           <th>NIT</th>
                           <th>DIRECCION</th>
                           <th>TOTAL</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php
                        $total = 0;
                        @endphp
                        @foreach ($data as $fac)
                        @php
                        $total += $fac->total;
                        @endphp
                        <tr>
                           <td>{{$fac->id}}</td>
                           <td>{{$fac->nombre}}</td>
                           <td>{{$fac->nit}}</td>
                           <td>{{$fac->direccion}}</td>
                           <td>Q. {{number_format($fac->total, 2)}}</td>
                        </tr>
                        @endforeach


                     </tbody>
                  </table>
               </div>

            </div>
         </div>


         <div class="text-center">

         <p>PORCENTAJE: {{$por}}%</p>

         <p>TOTAL: Q. {{number_format($total)}}</p>

         @php
            $aprox = ($por / 100) * $total;
         @endphp

         <p>APROXIMADO A PAGAR: Q. {{number_format($aprox, 2)}}</p>

         </div>



      </div>
   </div>
</div>


@endsection