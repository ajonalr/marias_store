<div class="form-group">
   <label for="">PLACA</label>
   <input type="text" class="form-control text-uppercase" value="{{$vehiculo->placa}}" name="placa" placeholder="PLACA">
</div>

<div class="form-group">
   <label for="">TIPO</label>
   <input type="text" class="form-control" value="{{$vehiculo->tipo}}" name="tipo" id="" placeholder="TIPO DE VEHICULO">
</div>


<div class="form-group">
   <label for="">COSTO</label>
   <input type="number" step="any" class="form-control" value="{{$vehiculo->costo}}" name="costo" id="" placeholder="COSTO DE VEHICULO">
</div>

<div class="form-group">
   <label for="">FECHA DE MANTENIMIENTO</label>
   <input type="date" class="form-control" value="{{$vehiculo->matenimiento}}" name="matenimiento">
</div>


<div class="form-group">
   <label for="descripcion">DESCRIPCION DE VEHICULO</label>
   <textarea class="form-control" name="descripcion" id="editor1" rows="3">@php echo $vehiculo->descripcion; @endphp</textarea>
</div>