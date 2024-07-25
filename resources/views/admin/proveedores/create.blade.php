@extends('layouts.admin')

@section('content')
<div class="container-fluid mb-5">
   <div class="row justify-content-center">
      <div class="col">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title text-center">REGISTRAR PROVEEDORES</h4>

               <form action="{{ route('prove.store')}}" class="row" method="post">
                  @csrf()

                  @include('admin.proveedores.forms.form')

                  <button type="submit" class="btn btn-outline-success btn-lg btn-block mt-2">
                     <i class="fas fa-save    "></i> Guardar
                  </button>

               </form>

            </div>
         </div>

      </div>
   </div>

</div>
@endsection