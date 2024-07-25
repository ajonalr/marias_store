<div class="form-group col-md-6">
   <label for="nombre">Nombre de Vendedor: </label>
   <input type="text" class="form-control form-control-lg" name="nombre" placeholder="NOMBRE DE PROVEEDOR" value="@if(isset($data->nombre)){{$data->nombre}}@endif" required>
</div>
<div class="form-group col-md-6">
   <label for="nombre">Dias de Visita: </label>
   <input type="text" class="form-control form-control-lg" value="@if(isset($data->dias)){{$data->dias}}@endif" name="dias" placeholder="Dias de Visita ">
</div>
<div class="w-100"></div>

<div class="form-group col-md-6">
   <label for="nombre">Empresa de: </label>
   <input type="text" class="form-control form-control-lg" value="@if(isset($data->empresa)){{$data->empresa}}@endif" name="empresa" placeholder="Empresa a la que Representa ">
</div>

<div class="form-group col-md-6">
   <label for="nombre">Direccion de Empresa: </label>
   <input type="text" class="form-control form-control-lg" value="@if(isset($data->direccion)){{$data->direccion}}@endif" name="direccion" placeholder="Direccion a la que Representa ">
</div>

<div class="w-100"></div>

<div class="form-group col-md-6">
   <label for="nombre">Telefono Principal: </label>
   <input type="number" class="form-control form-control-lg" name="telefono1" placeholder="Telefono Primario" value="@if(isset($data->telefono1)){{$data->telefono1}}@endif" required>
</div>
<div class="form-group col-md-6">
   <label for="nombre">Telefono Secundario: </label>
   <input type="number" class="form-control form-control-lg" name="telefono2" placeholder="Telefono Secundario" value="@if(isset($data->telefono2)){{$data->telefono2}}@endif">
</div>

<div class="form-group col">
   <label for=""> Articulos que Provee: </label>
   <textarea class="form-control" name="articulos" rows="5" placeholder="Articulos que Provee">@if(isset($data->articulos)){{$data->articulos}}@endif</textarea>
</div>