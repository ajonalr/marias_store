@extends('layouts.app')

@section('content')

<div class="container-fluid">
   <div class="row">
      <div class="col">
         <div class="text-center h3">REPORTE DE ARCHIVO</div>
      </div>
   </div>

   <div class="row">
      @foreach ($data as $f)
      <div class="col-12 my-3">
         <img class="img-fluid" src="{{config('app.url')}}{{ Storage::url('archivos/' . $f->foto) }}" alt="">
      </div>
      @endforeach
   </div>
</div>


@endsection