@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="row">
   <div class="col text-center h4 my-3">Articulos DB</div>
</div>

<div class="row">
   <div class="col">

      <div class="card">
         <div class="card-body">
            <div class="table-responsive">
               <table class="table" id="table_id">
                  <thead>
                     <tr>
                        <th>##</th>
                        <th>id</th>
                        <th>categoria_id</th>
                        <th>proveedor_id</th>
                        <th>nombre</th>
                        <th>cod_barras</th>
                        <th>descripcion</th>
                        <th>descripcion_interna</th>
                        <th>p_venta</th>
                        <th>p_costo</th>
                        <th>p_descuento</th>
                        <th>stock</th>
                        <th>stock_maximo</th>
                        <th>min_stock</th>
                        <th>img</th>
                        <th>img2</th>
                        <th>fabricante</th>
                        <th>medida</th>
                        <th>Estante</th>
                        <th>Sub Estanteria</th>
                        <th>##</th>
                        <th>deleted_at</th>
                        <th>created_at</th>
                        <th>created_at</th>
                        <th>minimo1</th>
                        <th>maximo1</th>
                        <th>precio1</th>
                        <th>minimo2</th>
                        <th>maximo2</th>
                        <th>precio2</th>
                        <th>minimo3</th>
                        <th>maximo3</th>
                        <th>precio3</th>
                        <th>##</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($articulos as $art)
                     <form action="" id="$art->id" method="post">

                        <tr>
                           <td><a class="btn btn-warning btn-sm" onclick="update()"><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
                           <td>{{$art->id}}</td>
                           <td><input value="{{$art->categoria_id}}" name="categoria_id" /></td>
                           <td> <input value="{{$art->proveedor_id}}" name="proveedor_id" /></td>
                           <td> <input value="{{$art->nombre}}" name="nombre" /></td>
                           <td> <input value="{{$art->cod_barras}}" name="cod_barras" /></td>
                           <td> <textarea name="descripcion">{{$art->descripcion}}</textarea></td>
                           <td> <textarea name="descripcion_interna">{{$art->descripcion_interna}}</textarea></td>
                           <td> <input value="{{$art->p_venta}}" name="p_venta" /></td>
                           <td> <input value="{{$art->p_costo}}" name="p_costo" /></td>
                           <td> <input value="{{$art->p_descuento}}" name="p_descuento" /></td>
                           <td> <input value="{{$art->stock}}" name="stock" /></td>
                           <td> <input value="{{$art->stock_maximo}}" name="stock_maximo" /></td>
                           <td> <input value="{{$art->min_stock}}" name="min_stock" /></td>
                           <td> <input value="{{$art->img}}" name="img" /></td>
                           <td> <input value="{{$art->img2}}" name="img2" /></td>
                           <td> <input value="{{$art->fabricante}}" name="fabricante" /></td>
                           <td> <input value="{{$art->medida}}" name="medida" /></td>
                           <td> <input value="{{$art->unidad}}" name="unidad" /></td>
                           <td> <input value="{{$art->eti_equivalente}}" name="eti_equivalente" /></td>
                           <td>
                              <a name="" id="" class="btn btn-primary" href="#" role="button"></a>
                           </td>
                           <td> <input value="{{$art->deleted_at}}" name="deleted_at" /></td>
                           <td> <input value="{{$art->created_at}}" name="created_at" /></td>
                           <td> <input value="{{$art->created_at}}" name="created_at" /></td>
                           <td> <input value="{{$art->minimo1}}" name="minimo1" /></td>
                           <td> <input value="{{$art->maximo1}}" name="maximo1" /></td>
                           <td> <input value="{{$art->precio1}}" name="precio1" /></td>
                           <td> <input value="{{$art->minimo2}}" name="minimo2" /></td>
                           <td> <input value="{{$art->maximo2}}" name="maximo2" /></td>
                           <td> <input value="{{$art->precio2}}" name="precio2" /></td>
                           <td> <input value="{{$art->minimo3}}" name="minimo3" /></td>
                           <td> <input value="{{$art->maximo3}}" name="maximo3" /></td>
                           <td> <input value="{{$art->precio3}}" name="precio3" /></td>
                           <td>
                              <a name="" id="" class="btn btn-primary" href="#" role="button"></a>
                           </td>
                        </tr>
                     </form>

                     @endforeach

                  </tbody>
               </table>
            </div>
         </div>
      </div>

   </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatable/js/dataTables.bootstrap4.min.js')}}"></script>

<script>
   $(document).ready(function() {
      var table = $('#table_id').DataTable({
         paging: false,
         ordering: false,
         info: false,
      });
   });


   function update(tr) {
      var config = {};
      $(`#${tr} input`).each(function() {
         config[this.name] = this.value;
      });
      console.log(config);
   }
</script>
@endsection