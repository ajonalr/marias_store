@extends('layouts.admin')
@section('content')
<div class="container-fluid">
   <div class="row justify-content-between">
      <div class="col-md6">
         <div class="text-center h3 text-uppercase">ARCHIVO / CARPETA : {{$data->tipo}}</div>
      </div>
      <div class="col-md6">
         <!-- Button trigger modal -->
         <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
            NUEVO REGISTRO
         </button>

      </div>
   </div>

   <div class="row">
      @forelse ($fotos as $f)
      <div class="col-md-3">

         <div class="card">
            <img class="card-img-top" src="{{config('app.url')}}{{ Storage::url('archivos/' . $f->foto) }}" alt="">
            <div class="card-body">
               <div class="text-center h5">{{$f->created_at}}</div>

               <a class="btn btn-danger" onclick="return confirm('Esta Seguro de Eliminar?')" href="{{route('archi.deleteFotoToArchivos', $f->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
               <a class="btn btn-primary" href="{{config('app.url')}}{{ Storage::url('archivos/' . $f->foto) }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
            </div>
         </div>

      </div>
      @empty
      <div class="alert alert-info" role="alert">
         <strong>SIN DATOS</strong>
      </div>
      @endforelse
   </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">NUEVO REGISTRO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('archi.setFotoMultiple')}}" method="post" enctype="multipart/form-data">
            @csrf()
            <input type="hidden" name="archivo_id" value="{{$data->id}}">
            <div class="modal-body">

               <div class="form-group">
                  <label for="images">ARCHIVOS</label>
                  <input type="file" class="form-control-file" name="images[]" multiple accept="image/*">
               </div>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
               <button type="submit" class="btn btn-primary">GUARDAR</button>
            </div>
         </form>
      </div>
   </div>
</div>

@endsection

