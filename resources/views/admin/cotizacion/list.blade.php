@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

<div class="container-fluid ">
   <div class="row">
      <div class="col">
         <div class="card mb-4">
            <div class="card-body">
               

               <div class="d-flex justify-content-sm-between mb-3">
                  <h3 class="card-title">Listado de Cotizaciones</h3>

                  <!-- <div class=""><a class="btn btn-primary" href="{{route('coti.index')}}"> <i class="fa fa-plus" aria-hidden="true"></i> Registrar Cotizacion</a></div> -->
               </div>
               <div class="table-responsive  table-responsive mb-5">
                  <table class="table table-data table-hover" id="table_id" data-page-length="15">
                     <thead style=" cursor: pointer;">
                        <tr style="background-color: black; color:white;">
                           <th style="color: white;">Codigo <i class="fa fa-sort"></i> </th>
                           <th style="color: white;">Nombre <i class="fa fa-sort"></i> </th>
                           <th style="color: white;">Nit <i class="fa fa-sort"></i></th>
                           <th style="color: white;">Fecha de Creacion <i class="fa fa-sort"></i></th>

                           <th style="color: white;"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($data as $d)

                        <tr class="tr-shadow">
                           <td>{{$d->codigo}}</td>
                           <td>{{$d->cliente->nombre}}</td>
                           <td>{{$d->cliente->nit}}</td>
                           <td>{{$d->created_at}}</td>
                           <td>
                              <a class="btn btn-info" href="{{route('coti.show', ['codigo' => $d->codigo])}}" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a>
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