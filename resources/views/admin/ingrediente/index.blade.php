@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">
@endsection
@section('scripts')
<script src="{{asset('plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatable/js/dataTables.bootstrap4.min.js')}}"></script>

<script>
  $(document).ready(function() {
    var table = $('#table_id').DataTable({
      scrollY: '60vh',
      scrollCollapse: true,
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
      },
      lengthMenu: [
        [10, 25, 15, 50, -1],
        [10, 25, 15, 50, 'All'],
      ],
    });


  });
</script>
@endsection

@section('content')

<div class="d-flex justify-content-around">
  <div>
    INGREDIENTES
  </div>
  <div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
      NUEVO INGREDIENTE
    </button>
  </div>
</div>

<div class="row">
  <div class="col">
    <div class="card mb-4">
      <div class="card-body">

        <div class="d-flex justify-content-sm-between">
          <h3 class="card-title">Listado de Ingredientes</h3>
        </div>

        <div class="table-responsive  table-responsive mb-5">
          <table class="table table-data table-hover" id="table_id" data-page-length="40">
            <thead style=" cursor: pointer;">
              <tr style="background-color: black; color:white;">
                <th style="color: white;"></th>
                <th style="color: white;">Nombre <i class="fa fa-sort"></i> </th>
                <th style="color: white;">Descripcion <i class="fa fa-sort"></i> </th>
                <th style="color: white;">Precio<i class="fa fa-sort"></i></th>
                <th style="color: white;">Stock <i class="fa fa-sort"></i></th>
                <th style="color: white;">Minimo Stock <i class="fa fa-sort"></i></th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $art)

              <tr class="tr-shadow @if ($art->stock < $art->min_stock)
                            bg-info text-white
                        @endif">
                <td>

                  @can('articulos_show')
                  <a class="item btn btn-success" href="{{route('ingrediente.show', $art)}}" data-toggle="tooltip" data-placement="top" title="Ver Datos de  {{$art->nombre}}" data-original-title="Editar {{$art->nombre}}">
                    <i class="fa fa-eye" style="color:white;" aria-hidden="true"></i>
                  </a>
                  @endcan

                  @can('articulos_delete')
                 <form action="{{route('ingrediente.delete', $art->id)}}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Esta Seguro de Eliminar' )"><i class="fa fa-trash" aria-hidden="true"></i></button>
                 </form>
                  @endcan

                </td>
                <td>{{$art->nombre}}</td>
                <td>@php
                  echo $art->descripcion;
                  @endphp</td>
                
                <td>Q. {{number_format($art->p_costo, 2)}}</td>
                <td>{{$art->stock}}</td>
                <td><span class="badge badge-warning" style="    background-color: #ff9595;font-size: 14px;color: white;">{{$art->min_stock}}</span></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">INGREDIENTES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('ingrediente.store')}}" method="post">
        @csrf()
        <div class="modal-body">


          <div class="row">
            <div class="col-md-5">
              <label for="inputEmail4">Nombre:</label>
              <input type="text" class="form-control" name="nombre" value="@isset($articulo->nombre){{ $articulo->nombre }}@endisset" required>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <label for="">FECHA DE EXPIRACION</label>
                <input type="date" class="form-control" name="fecha_expi">
              </div>
            </div>

          </div>


          <hr>
          <div class="row justify-content-center">


            <div class="col">
              <label for="">Precio Costo:</label>
              <input type="number" class="form-control" required name="p_costo" step="any" value="@isset($articulo->p_costo){{ $articulo->p_costo }}@endisset">
            </div>

            <div class="col">
              <label for="">Cantidad / Stock: </label>
              <input type="number" class="form-control" name="stock" id="stock1" step="any" value="@isset($articulo->stock){{ $articulo->stock }}@endisset">
            </div>

            <div class="col">
              <label for="">Minimo de Stock:</label>
              <input type="number" class="form-control text-uppercase" name="min_stock" value="@isset($articulo->min_stock){{ $articulo->min_stock }}@endisset" value="0">
            </div>

          </div>

          <hr>


          <div class="row justify-content-center">
            <div class="col-md-4">
              <div class="">
                <label for="">Imagen</label>
                <input type="text" class="form-control" name="img" value="@isset($articulo->img){{ $articulo->img }}@endisset">
              </div>
            </div>

          </div>


          <div class="row">

            <div class="form-group col">
              <label for="">Descripcion:</label>
              <textarea class="form-control" name="descripcion" id="editor1" rows="10" required>@if(isset($articulo->descripcion)){{$articulo->descripcion}}@endif</textarea>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save    "></i> GUARDAR</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection