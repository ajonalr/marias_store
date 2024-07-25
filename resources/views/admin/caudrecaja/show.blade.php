@extends('layouts.admin')

@section('content')

<div class="container-fuid">
   <div class="row justify-content-center">
      <div class="col-md-6">

         <div class="card">
            <div class="card-body">
               <h4 class="card-title">EDITAR {{$data->tipo}}</h4>

               <form action="{{route('cajai.update', ['id' => $data->id])}}" method="post">
                  @csrf
                  @method('put')

                  <div class="form-group">
                     <label for="">TIPO</label>
                     <select class="form-control" name="tipo">
                        <option value="{{$data->tipo}}">{{$data->tipo}}</option>
                        <option value="ENTRADA">ENTRADA</option>
                        <option value="SALIDA">SALIDA</option>
                     </select>
                  </div>

                  <div class="form-group">
                     <label for="valor">VALOR</label>
                     <input type="number" step="any" class="form-control" name="valor" value="{{$data->valor}}" placeholder="VALOR DE CAJA">
                  </div>

                  <div class="form-group">
                     <label for="valor">DESCRIPCION</label>
                     <input type="text" class="form-control" name="descripcion" value="{{$data->descripcion}}" placeholder="DESCRPICION DE CAJA">
                  </div>

                  <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
               </form>
            </div>
         </div>

      </div>
   </div>
</div>

@endsection