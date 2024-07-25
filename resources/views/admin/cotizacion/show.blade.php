@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

<div class="container-fuid ">
   <div class="row">
      <div class="col">
         <div class="card mb-4">
            <div class="d-flex justify-content-around mt-4">
               <div>
                  <h4 class="card-title">Listado de Cotizacion</h4>
               </div>
               <div>
                  <a class="btn btn-dark" href="{{route('coti.print_cotizacion', $codigo)}}"><i class="fa fa-print" aria-hidden="true"></i></a>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive  table-responsive mb-5">
                  <table class="table table-data table-hover" id="table_id" data-page-length="15">
                     <thead style=" cursor: pointer;">
                        <tr style="background-color: #DCA2BA ; color:white;">
                           <th style="color: white;">Articulo <i class="fa fa-sort"></i> </th>
                           <th style="color: white;">Stock <i class="fa fa-sort"></i> </th>
                           <th style="color: white;">Precio de Venta <i class="fa fa-sort"></i></th>

                           <th style="color: white;">Cantidad<i class="fa fa-sort"></i></th>

                           <th style="color: white;">Total <i class="fa fa-sort"></i></th>


                        </tr>
                     </thead>
                     <tbody>
                        @foreach($data as $d)

                        <tr class="tr-shadow">
                           <td>{{$d->nombre}} / <?php echo $d->descripcion; ?></td>
                           <td>{{$d->stock}}</td>
                           <td>{{$d->p_venta}}</td>
                           <td>{{$d->cantidad}}</td>
                           <td>{{$d->total}}</td>
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