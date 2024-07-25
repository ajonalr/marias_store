@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/slim-select/slimselect.min.css')}}">
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-3 p-4 card">
         <div class="text-center h3">REPORTE DE ARCHIVOS</div>
         <p>RETORNA UN REPORTE DE LOS ARCHIVOS, SELECCIONANDO LAS FECHAS</p>
         <form action="{{route('archi.getFotoToArchivoReport')}}" method="post">
            @csrf
            <div class="form-group">

               <div class="form-group">
                  <label for="">CARPETAS</label>
                  <select class="form-control" name="archivo_id" id="archivo_id">
                     @foreach ($data as $d)
                     <option value="{{$d->id}}">{{$d->tipo}}</option>
                     @endforeach
                  </select>
               </div>

               <label for="">INICIO: </label>
               <input type="date" name="inicio" class="form-control">
            </div>
            <div class="form-group ml-4">
               <label for="">FIN: </label>
               <input type="date" name="fin" class="form-control">
            </div>
            <button type="submit" class="btn btn-info ml-4"><i class="fa fa-search" aria-hidden="true"></i></button>
         </form>
      </div>
   </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('plugins/slim-select/slimselect.min.js')}}"></script>
<script>
   new SlimSelect({
      select: '#archivo_id'
   });
</script>
@endsection