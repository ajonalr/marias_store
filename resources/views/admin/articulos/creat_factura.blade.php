@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/slim-select/slimselect.min.css') }}">
@endsection


@section('content')

<div class="container-fluid">
   <div class="row">
      <div class="col">

         <div class="card">
            <div class="card-body">
               <h4 class="card-title">REGISTRO DE FACTURA A PROVEEDORES</h4>


               <form action="{{route('articulo.store_factura')}}" method="post">
                  @csrf
                  <div class="row">
                     <div class="col-md-9">
                        <div class="form-group">
                           <label for="">PROVEEDOR</label>
                           <select class="form-control" name="proveedor_id" id="proveeedor">
                              @foreach ($proveedor as $p )
                              <option value="{{$p->id}}"> {{$p->nombre}} </option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-check">
                           <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="credito" id="" value="true">
                              CREDITO
                           </label>
                        </div>
                     </div>

                  </div>
                  <div class="form-group row">
                     <div class="col-md-5">
                        <p>Articulos</p>
                        <select class="form-control" name="articulo" id="articulo" autofocus>
                           <option value="">Seleccione Articulo</option>
                           @foreach($articulos as $art)
                           <option value="{{$art->id}}__{{$art->stock}}__{{$art->p_venta}}__{{$art->descripcion}}">{{$art->nombre}} <?php echo $art->descripcion; ?>, Stock: {{$art->stock}}, {{$art->cod_barras}} </option>
                           @endforeach
                        </select>
                        <br>
                     </div>

                     <div class="form-group col-md-2">
                        <label for="">NUMERO DE FACTURA</label>
                        <input type="text" class="form-control" name="descripcion" required>
                     </div>

                     <div class="col-md-2">
                        <div class="col">
                           TOTAL DE FACTURA
                           <input type="number" step="any" class="form-control" name="total" required>
                        </div>
                     </div>

                     <div class="col-md-2">
                        <div class="col">
                           Cantidad a Comprar
                           <input type="number" class="form-control" name="" value="1" id="bolsa_cantidad">
                        </div>
                     </div>



                     <div class="">
                        <button type="button" id="add_bolsa" class="btn btn-outline-primary float-right" style="border-radius: 25px;"> <i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                     </div>

                  </div>

                  <div class="w-100"></div>

                  <!-- end articulos -->

                  <div class="row d-none">
                     <div class="col">
                        <div class="form-group row mx-3">
                           <div class="row">

                              <div class="col d-none">
                                 Precio
                                 <input type="text" class="form-control " placeholder="Precio Venta" disabled name="" id="bolsa_pventa">

                              </div>

                              <div class="col d-none">
                                 Descuento
                                 <input type="number" class="form-control " placeholder="Descuento" id="bolsa_descuento">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row p-4 d-none">
                     <div class="col">
                        <label for="" id="abolsa_descripArt"></label>
                     </div>
                  </div>



                  <div class="row justify-content-center">
                     <div class="col table-responsive">
                        <!-- Widget: user widget style 1 -->

                        <table class="table table-hover table-sm" id="tabla_bolsa">
                           <thead class="">
                              <tr>
                                 <th></th>
                                 <th>Articulo</th>
                                 <th class="d-none">Precio Venta</th>
                                 <th class="d-none">Descuento</th>
                                 <th>Cantidad</th>
                                 <th class="d-none">Subtotal</th>
                              </tr>
                           </thead>
                           <tbody>

                              <tr>

                              </tr>

                           </tbody>
                        </table>

                        <!-- /.widget-user -->
                     </div>

                  </div>

                  <div class="row">
                     <label id="bolsa_total"> </label>
                     <br>
                     <label id="bolsa_descuento"> </label>
                  </div>

                  <div class="row">
                     <div class="col">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> GUARDAR</button>
                     </div>
                  </div>
               </form>



            </div>
         </div>


      </div>
   </div>
</div>

@endsection


@section('scripts')
<script src="{{asset('compras/articulos.js')}}"></script>

<script src="{{asset('plugins/slim-select/slimselect.min.js') }}"></script>
<script>
   setTimeout(function() {
      new SlimSelect({
         select: '#proveeedor',
         placeholder: 'Select Permissions',
         deselectLabel: '<span>&times;</span>',
         hideSelectedOption: true,
      })
   }, 300);
   setTimeout(function() {
      new SlimSelect({
         select: '#articulo',
         placeholder: 'Select Permissions',
         deselectLabel: '<span>&times;</span>',
         hideSelectedOption: true,
      })
   }, 300);
</script>

@endsection