<form action="{{route('articulo.comprar')}}">
   <div class="row">
      <div class="col-md-9">
         <div class="form-group">
            <label for="">PROVEEDOR</label>
            <select class="form-control" name="proveeedor" id="proveeedor">
               @foreach ($prove as $p )
               <option value="{{$p->id}}"> {{$p->nombre}} </option>
               @endforeach
            </select>
         </div>
      </div>
      <div class="col-md-3">
         <button type="submit" class="btn btn-info rounded mt-4 btn-sm"> <i class="fa fa-search" aria-hidden="true"></i> BUSCAR</button>
      </div>
   </div>


</form>