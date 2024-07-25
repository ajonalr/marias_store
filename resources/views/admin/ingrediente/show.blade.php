@extends('layouts.admin')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col">

      <form action="{{route('ingrediente.update', $ing->id)}}" method="post">
        @csrf
        @method('put')

        <div class="row">
          <div class="col-md-5">
            <label for="inputEmail4">Nombre:</label>
            <input type="text" class="form-control" name="nombre" value="@isset($ing->nombre){{ $ing->nombre }}@endisset" required>
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
            <input type="number" class="form-control" required name="p_costo" step="any" value="@isset($ing->p_costo){{ $ing->p_costo }}@endisset">
          </div>

          <div class="col">
            <label for="">Cantidad / Stock: </label>
            <input type="number" class="form-control" name="stock" id="stock1" step="any" value="@isset($ing->stock){{ $ing->stock }}@endisset">
          </div>

          <div class="col">
            <label for="">Minimo de Stock:</label>
            <input type="number" class="form-control text-uppercase" name="min_stock" value="@isset($ing->min_stock){{ $ing->min_stock }}@endisset" value="0">
          </div>

        </div>

        <hr>


        <div class="row justify-content-center">
          <div class="col-md-4">
            <div class="">
              <label for="">Imagen</label>
              <input type="text" class="form-control" name="img" value="@isset($ing->img){{ $ing->img }}@endisset">
            </div>
          </div>

        </div>


        <div class="row">

          <div class="form-group col">
            <label for="">Descripcion:</label>
            <textarea class="form-control" name="descripcion" id="editor1" rows="10" required>@if(isset($ing->descripcion)){{$ing->descripcion}}@endif</textarea>
          </div>

        </div>

        <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
      </form>

    </div>
  </div>
</div>

@endsection