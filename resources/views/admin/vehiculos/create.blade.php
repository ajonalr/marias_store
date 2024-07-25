@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/slim-select/slimselect.min.css') }}">
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col">

         <div class="card">
            <div class="card-body">
               <h4 class="card-title">REGISTRAR NUEVO VEHICULO</h4>

               <form action="{{route('vehiculos.store')}}" method="post">
                  @csrf

                  @include('admin.vehiculos.forms.form')


                  <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> GUARDAR</button>
               </form>
            </div>
         </div>


      </div>
   </div>
</div>
@endsection

@section('scripts')

<script src="{{ asset('plugins/ckeditor/ckeditor.js')  }}"></script>
<script>
   CKEDITOR.replace('editor1');z
</script>
@endsection