<div class="row">

   <div class="col-md-6">

      <div class="form-group">
         <label for="cliente_id">PROPIETARIO</label>
         <select class="form-control" name="cliente_id" id="cliente_id" required>
            <option value="{{$data->cliente_id}}">{{$data->cliente->nombre}} / {{$data->cliente->telefono1}}</option>

            @foreach ($clientes as $c)
            <option value="{{$c->id}}"> {{$c->nombre}} / {{$c->telefono1}}</option>
            @endforeach

         </select>
      </div>

      <div class="form-group">
         <label for="nombre">EMPRESA</label>
         <input type="text" class="form-control" name="nombre" placeholder="NOMBRE DE EMPRESA / LOCAL / INSTITUCION" value="{{$data->nombre}}">
      </div>

      <div class="form-group">
         <label for="descripcion">DESCRIPCION</label>
         <textarea class="form-control" name="descripcion" rows="3">{{$data->descripcion}}</textarea>
      </div>

   </div>

   <div class="col-md-6">

      <div class="form-group">
         <label for="total">TOTAL</label>
         <input type="number" step="any" class="form-control" name="total" value="{{$data->total}}">
      </div>
      <div class="form-group">
         <label for="total">FECHA DE ENTREGA</label>
         <input type="date" class="form-control" name="fecha_entrega" value="{{$data->fecha_entrega}}">
      </div>
      <div class="form-group">
         <label for="total">URL GIT</label>
         <input type="text" class="form-control" name="url_git" value="{{$data->url_git}}">
      </div>

   </div>


</div>