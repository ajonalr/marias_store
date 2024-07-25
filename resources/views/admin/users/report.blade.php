@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/slim-select/slimselect.min.css')}}">
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-4">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">REPORTE DE VENTAS</h4>
               <p class="card-text">GENERA UN REPORTE DE VENTAS POR VENDEDOR</p>
               <form action="{{route('user.getVentasToUserAndDate')}}" method="post">
                  @csrf()

                  <div class="form-group">
                     <label for="">Usuario</label>
                     <select class="form-control" name="user_id" id="user_id">
                        @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>                        
                        @endforeach
                     </select>
                  </div>

                  <div class="form-group">
                     <label for="">De (Fecha de Inicio): </label>
                     <input type="date" class="form-control" name="inicio" placeholder="Fecha de Inicio" required>
                  </div>
                  <div class="form-group">
                     <label for="">Hasta (Fecha de Final): </label>
                     <input type="date" class="form-control" name="fin" placeholder="Fecha de Fin" required>
                  </div>
                  <button class="btn btn-dark" type="submit"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('plugins/slim-select/slimselect.min.js')}}"></script>
<script>
   new SlimSelect({
      select: '#user_id'
   });
</script>
@endsection