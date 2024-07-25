@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('ventas/estilos.css')}}">
<link rel="stylesheet" href="{{asset('plugins/slim-select/slimselect.min.css')}}">

<style>
   .form-check [type=checkbox]:checked,
   .form-check [type=checkbox]:not(:checked) {
      position: absolute;
      left: 10px;
   }

   .logo {
      display: none;
   }

   img {

      /* width: 70% !important; */

   }

   .pie-decodev {
      margin-right: 15%;
   }
</style>
@endsection


@section('content')

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">MAS DATOS</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p class="text-center h2">ANADIR MAS DATOS A RECIBO</p> <br>

            <form action="{{route('ventas.store_venta_existfactura')}}" method="post">
               @csrf

               <input type="hidden" name="factura" value="{{$recibo->id}}">
               <input type="hidden" name="cliente_id" value="{{$cli}}">



               <div class="form-group">
                  <select name="articulos_id" id="articulos_id">
                     @foreach ($articulos as $art)
                     <option value="{{$art->id}}">{{$art->nombre}}, Q. {{number_format($art->p_venta, 2)}}</option>
                     @endforeach
                  </select>
               </div>

               <div class="form-group">
                  <label for="">CANTIDAD</label>
                  <input type="text" class="form-control" name="cantidad">
               </div>

               <button type="submit" class="btn btn-primary"><i class="fas fa-save    "></i> GUARDAR</button>

            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save</button>
         </div>
      </div>
   </div>
</div>


<div class="container-fluid mb-5">
   <div class="row">
      <div class="col">
         <div class="card">
            <div class="card-body">

               <div class="d-flex justify-content-sm-around">
                  <h3 class="card-title">Venta / Recibo #{{$recibo->id}} / MESA: {{$recibo->mesa}}</h3>
               </div>
               <p>
                  Cliente: <b>{{$recibo->nombre}}</b> <br>
                  Nit: <b>{{$recibo->nit}}</b> <br>
                  Direccion: <b>{{$recibo->direccion}}</b> <br>
                  <!-- Total de Factura: <b>Q. {{number_format($recibo->total, 2)}}</b> -->
               </p>

               <a class="btn btn-primary" href="{{route('venta.index')}}" target="_blank" role="button">Ir A ventas</a>

               <a target="_blank" class="btn btn-primary btn-sm" href="{{route('venta.facturaPrint', ['idFactura' => $recibo->id, 0] )}}"><i class="fa fa-print" aria-hidden="true"></i> Recibo</a>

               <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modelId">MAS DATOS</button>


               <div class="table-responsive">
                  <table class="table table-hover" id="contado" data-page-length="15">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Articulo</th>
                           <th>Cantidad</th>
                           <th>P. Unitario</th>
                           <th>Total</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $t = 0;

                        ?>
                        @foreach($deuda as $venta)
                        <tr>
                           <td>{{$venta->id}}</td>
                           <td>{{$venta->articulo->nombre}} <?php echo $venta->articulo->descripcion ?></td>
                           <td>{{$venta->cantidad}}</td>
                           <th>Q. {{number_format($venta->total / $venta->cantidad, 2)}}</th>
                           <td>Q. {{number_format($venta->total, 2)}} <?php $t += $venta->total; ?> </td>
                           <td>
                              @can('venta_anulacion')
                              <form action="{{route('venta.deleteVentaEspecific', $venta->id)}}" method="post">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Esta seguro de Eliminar?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </form>
                              @endcan
                           </td>
                        </tr>
                        @endforeach

                     </tbody>
                  </table>

                  <p class="text-center display-5">Total: Q. {{number_format($t,2)}}</p>

               </div>
               <!-- end ventas al contado -->
               <hr>

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
      $('#contado').DataTable({
         "language": {
            'info': '_TOTAL_ Registros',
            'search': 'Buscar',
            'paginate': {
               'next': 'Siguiente',
               'previous': 'Atras'
            },
            'loadingRecords': 'Cargando',
            'emptyTable': 'No hay datos',
            'zeroRecords': 'No hay datos iguales'
         }
      });


   });
</script>


<script src="{{asset('plugins/slim-select/slimselect.min.js')}}"></script>
<script>
   new SlimSelect({
      select: '#articulos_id'
   });
</script>

@endsection