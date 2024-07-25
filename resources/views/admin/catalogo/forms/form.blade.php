<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputEmail4">Nombre</label>
        <input type="text" class="form-control" name="nombre" value="@isset($articulo->nombre){{ $articulo->nombre }}@endisset" required>
    </div>
    <div class="w-100"></div>
    <div class="form-group col-md-6">
        <div class="form-group">
          <label for="">Descripcion</label>
          <textarea class="form-control" name="descripcion"  rows="5">@if(isset($articulo->descripcion)){{$articulo->descripcion}}@else Descripcion del Articulo @endif</textarea>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="inputCity">Precio Venta</label>
        <input type="number" class="form-control" required name="p_venta" step="any" value="@isset($articulo->costo){{ $articulo->costo }}@endisset">
    </div>



    <div class="form-group col-md-2">
        <label for="inputZip">Descuento Q.</label>
        <input type="number" class="form-control" name="descuento" value="@isset($articulo->descuento){{ $articulo->descuento }}@endisset">
    </div>
</div>





