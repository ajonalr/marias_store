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

                  <span id="card_title" style="font-size: 172%; ">
                     {{ __('MOBILIARIO Y EQUIPO') }}
                  </span>

                  <div class="float-right">
                     <a href="{{ route('mobiliario.create') }}" class="btn btn-primary  float-right" data-placement="left">
                        {{ __('REGISTRAR NUEVO MOBILIARIO') }}
                     </a>
                  </div>
               </div>
            </div>


            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped table-hover" id="table_id" data-page-length="15">
                     <thead class="thead">
                        <tr>
                           <th>No</th>
                           <th>NOMBRE</th>
                           <th>DESCRIPCION</th>
                           <th>CANTIDAD</th>
                           <th>PRECIO</th>
                           <th>FECHA DE MANTENIMIENTO</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($mobiliarios as $data)
                        <tr>
                           <td>{{ $data->id }}</td>
                           <td>{{ $data->nombre }}</td>
                           <td>@php echo $data->descripcion; @endphp</td>
                           <td>{{ $data->cantidad }}</td>
                           <td>Q. {{ number_format($data->precio, 2) }}</td>
                           <td>{{$data->mantenimiento}}</td>
                           <td>
                              <a href="{{route('mobiliario.show', ['id' => $data->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                              <form action="{{route('mobiliario.delete', ['id' => $data->id])}}" method="POST">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Estas Seguro?')"><i class="fa fa-fw fa-trash"></i> </button>
                              </form>

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