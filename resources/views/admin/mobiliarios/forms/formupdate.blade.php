<div class="form-group">
   <label for="">Nombre de Mobiliario y Equipo</label>
   <input type="text" class="form-control text-uppercase" name="nombre" placeholder="Nombre de Mobiliario y Equipo" value="{{$mobiliario->nombre}}">
</div>

<div class="form-group">
   <label for="">Cantidad</label>
   <input type="number" step="any" class="form-control" name="cantidad" id="" placeholder="Cantidad de Mobiliario" value="{{$mobiliario->cantidad}}">
</div>

<div class="form-group">
   <label for="">Precio</label>
   <input type="number" step="any" class="form-control" name="precio" id="" placeholder="Precio de Mobiliario" value="{{$mobiliario->precio}}">
</div>

<div class="form-group">
   <label for="">Fecha de Mantenimiento</label>
   <input type="date" class="form-control" name="mantenimiento"  value="{{$mobiliario->mantenimiento}}">
</div>


<div class="form-group">
   <label for="descripcion">Descripcion de Mobiliario</label>
   <textarea class="form-control" name="descripcion" id="editor1" rows="3">@php echo $mobiliario->descripcion; @endphp</textarea>
</div>