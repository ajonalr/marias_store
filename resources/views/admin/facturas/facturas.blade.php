@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">
@endsection


@section('content')

@if ($filtro)
<div class="row my-4">
   <div class="col">
      <div class="card">
         <div class="card-body">
            <form action="{{route('factura.filtrados')}}">

               <select name="ano" class="form-control mb-2">
                  <option value="">Seleccione Año</option>
                  @for($i = 2022; $i < 2050; $i ++) <option value="{{$i}}">Año: {{$i}}</option>
                     @endfor
               </select>

               <select name="mes" class="form-control mb-2">
                  <option selected hidden>Mes</option>
                  <option value="01">Enero</option>
                  <option value="02">Febrero</option>
                  <option value="03">Marzo</option>
                  <option value="04">Abril</option>
                  <option value="05">Mayo</option>
                  <option value="06">Junio</option>
                  <option value="07">Julio</option>
                  <option value="08">Agosto</option>
                  <option value="09">Septiembre</option>
                  <option value="10">Octubre</option>
                  <option value="11">Noviembre</option>
                  <option value="12">Diciembre</option>
               </select>

               <button class="btn btn-success rounded" type="submit"> <i class="fa fa-search" aria-hidden="true"></i> BUSCAR</button>


            </form>
         </div>
      </div>
   </div>
</div>
@endif

<div class="container-fluid">
   <div class="row">
      <div class="col">

         <div class="card">
            <div class="card-body">
               <h4 class="card-title text-center">FACTURAS A REALIZAR</h4>
               <div class="table-responsive">
                  <table class="table table-sm" id="table_id">
                     <thead>
                        <tr>
                           <th>RECIBO</th>
                           <th>NOMBRE</th>
                           <th>NIT</th>
                           <th>DIRECCION</th>
                           <th>TOTAL</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($data as $fac)
                        <tr>
                           <td>{{$fac->id}}</td>
                           <td>{{$fac->nombre}}</td>
                           <td>{{$fac->nit}}</td>
                           <td>{{$fac->direccion}}</td>
                           <td>Q. {{number_format($fac->total, 2)}}</td>
                           <td>

                              <a class="btn btn-info rounded btn-sm" href="{{route('factura.factura', ['id' => $fac->id])}}"> <i class="fa fa-th-list" aria-hidden="true"></i></a>

                           </td>
                        </tr>
                        @endforeach


                     </tbody>
                  </table>
               </div>

            </div>
         </div>


      </div>
   </div>
</div>

@endsection



@section('scripts')
<script src="{{asset('plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatable/js/dataTables.bootstrap4.min.js')}}"></script>

<script>
   $(document).ready(function() {
      $('#table_id').DataTable({
         "language": {
            'info': '_TOTAL_ REGISTROS',
            'search': 'BUSCAR',
            'paginate': {
               'next': 'SIGUIENTE',
               'previous': 'ATRAS'
            },
            'loadingRecords': 'CARGANDO',
            'emptyTable': 'NO EXISTEN DATOS',
            'zeroRecords': 'NO EXISTEN DATOS IGUALES'
         }
      });
   });
</script>
@endsection