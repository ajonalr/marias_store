@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <div style="display: flex; justify-content: space-between; align-items: center;">

                  <span id="card_title" style="font-size: 172%;">
                     {{ __('PERIDAS') }}
                  </span>

                  <div class="float-right">
                     <!-- Button trigger modal -->
                     <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modelId">
                        NUEVA PERDIDA
                     </button>
                  </div>
               </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form action="{{route('perdida.store')}}" method="post">
                        @csrf
                        <div class="modal-body">
                           <div class="form-group">
                              <label for="descripcion">DESCRIPCION</label>
                              <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                           </div>

                           <div class="form-group">
                              <label for="">VALOR</label>
                              <input type="text" class="form-control" name="valor" step="any">
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                           <button type="submit" class="btn btn-primary"><i class="fas fa-save    "></i> GUARDAR</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>


            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped table-hover" id="table_id" data-page-length="15">
                     <thead class="thead">
                        <tr>
                           <th>DESCRIPCION</th>
                           <th>VALOR</th>
                           <th>FECHA</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($data as $data)
                        <td>{{$data->descripcion}}</td>
                        <td>Q. {{number_format($data->valor, 2)}}</td>
                        <td>{{$data->created_at}}</td>
                        <td>
                           <form action="{{route('perdida.delete', $data->id)}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button type='submit' class='btn btn-danger' onclick="return confirm('Esta Seguro de Eliminar?')"><i class='fa fa-trash' aria-hidden='true'></i></button>
                           </form>
                        </td>
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