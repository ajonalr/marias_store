<div class="row justify-content-center">
   <input type="hidden" id="id_producto">
   <div class="col-md-3">
      Precio Venta
      <input type="text" class="form-control" id="preciog">

   </div>
   <div class="col-md-3 d-none">
      Existencia
      <input type="text" class="form-control" placeholder="Existencia" disabled id="existenciag">
   </div>


   <div class="col-md-3 d-none">
      Descuento Unitario
      <input type="number" class="form-control" placeholder="Descuento" id="descuentog" disabled>
   </div>

   <div class="col-md-3">
      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#cliente">
         CLIENTE
      </button>
   </div>

   <div class="col-md-3">
      <a type="button" target="_blank" href="{{route('venta.index')}}" class="btn btn-primary btn-lg btn-block">NUEVO PEDIDO</a>
   </div>
</div>