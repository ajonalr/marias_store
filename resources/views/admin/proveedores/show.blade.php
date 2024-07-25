@extends('layouts.admin')

@section('content')
<div class="container-fluid mb-5">
   <div class="row justify-content-center">
      <div class="col">
         <div class="card mb-5">
            <div class="card-body">
               <h4 class="card-title text-center text-uppercase">ACTUALIZR PROVEEDOR {{$data->nombre}}</h4>

               <div class="custom-tab">
                  <nav>
                     <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active show" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home" aria-selected="false">Datos</a>

                        <a class="nav-item nav-link " id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile" aria-selected="true">Actualizar</a>

                        <a class="nav-item nav-link " id="custom-nav-factura-tab" data-toggle="tab" href="#custom-nav-factura" role="tab" aria-controls="custom-nav-factura" aria-selected="true">Registrar Factura Pendiente de Pago</a>

                        <a class="btn btn-warning btn-sm" target="_blank" href="{{route('prove.abonos', ['id' => $data->id])}}">Abonar Pago de Factura</a>

                        <a class="btn btn-info btn-sm" target="_blank" href="{{route('prove.mascomprado', ['id' => $data->id])}}">Mas Comprado</a>


                     </div>
                  </nav>

                  <div class="tab-content pl-3 pt-2 " id="nav-tabContent">
                     <div class="tab-pane fade active show" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">

                        <div class="jumbotron">
                           <h1 class="display-4 text-info text-uppercase">{{$data->nombre}}</h1>
                           <p class="lead"> <b>Empresa que Representa: </b> {{$data->empresa}}</p>
                           <p class="lead"> <b>Direccion de Empresa: </b> {{$data->direccion}}</p>
                           <p class="lead"> <b>Telefono Primario: </b> {{$data->telefono1}}</p>
                           <p class="lead"> <b>Telefono secundario: </b> {{$data->telefono2}}</p>
                           <hr class="my-2">

                           <div class="row justify-content-center">
                              <div class="col-md-6">
                                 <h4 class="text-primary">ARTICULOS QUE PROVEE</h4>
                                 <pre>@php echo $data->articulos @endphp</pre>
                              </div>
                              <div class="col-md-6">
                                 <h4 class="text-primary">DIAS QUE NOS VISITA</h4>
                                 <p>{{$data->dias}}</p>
                              </div>
                           </div>


                        </div>

                     </div>

                     <div class="tab-pane fade " id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                        <form action="{{ route('prove.update', ['id' => $data->id])}}" class="row" method="post">
                           @csrf()
                           @method('PUT')

                           @include('admin.proveedores.forms.form')

                           <button type="submit" class="btn btn-outline-warning btn-lg btn-block mt-2">
                              <i class="fas fa-save    "></i> Actualizar
                           </button>
                        </form>
                     </div>

                     <div class="tab-pane fade " id="custom-nav-factura" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                        <div class="row">
                           <!-- formulario para registro de factuas -->
                           <div class="col-md-3">
                              <form action="{{ route('prove.facturacreate')}}" method="post">
                                 @csrf()

                                 <input type="hidden" name="proveedor_id" value="{{ $data->id }}" <div class="row">

                                 <input type="hidden" name="estado" value="PENDIENTE"  class="row">


                                 <div class="form-group mt-2">
                                    <label for="">NUMERO DE FACTURA</label>
                                    <input type="text" class="form-control" name="factura" placeholder="INGRESE NUMERO DE FACTURA">
                                 </div>

                                 <div class="w-100"></div>

                                 <div class="form-group mt-2">
                                    <label for="">VALOR DE FACTURA</label>
                                    <input type="text" class="form-control" name="valor" placeholder="INGRESE VALOR DE FACTURA">
                                 </div>

                                 <div class="w-100"></div>
                                 <div class="form-group mt-2">
                                    <label for="">FECHA DE COMPRA</label>
                                    <input type="date" class="form-control" name="fecha_compra" placeholder="FECHA DE COMPRA">
                                 </div>
                                 <div class="w-100"></div>

                                 <div class="form-group mt-2">
                                    <label for="">FECHA PARA PAGO</label>
                                    <input type="date" class="form-control" name="fecha_de_pago" placeholder="FECHA DE PAGO DE FACTURA">
                                 </div>

                                 <div class="w-100"></div>


                                 <button type="submit" class="btn btn-outline-warning mt-2">
                                    <i class="fas fa-save    "></i> REGISTRAR
                                 </button>
                              </form>
                           </div>

                           <div class="col-md-9">
                              Factuas Registradas:
                              <b>{{$numero}}</b>


                              <div class="table-responsive">
                                 <table class="table table-striped table-hover ">
                                    <thead class="thead-inverse">
                                       <tr>
                                          <th>No. Factura</th>
                                          <th>Valor</th>
                                          <th>Fecha de Compra</th>
                                          <th>Fecha de Pago</th>
                                          <th>Descripcion</th>
                                          <th>Estado</th>
                                          <th></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($facturas as $f )
                                       @if ($f->estado ==='PENDIENTE' || $f->estado == '' )

                                       <tr>
                                          <td>{{$f->factura}}</td>
                                          <td>{{$f->valor}}</td>
                                          <td>{{$f->fecha_compra}}</td>
                                          <td>{{$f->fecha_de_pago}}</td>
                                          <td><?php echo $f->description; ?></td>
                                          <td>{{$f->estado}}</td>

                                          <td>
                                             <a class="btn btn-success btn-sm" href="{{route('prove.changeTipoToFactura', ['id' => $f->id])}}" role="button"><i class="fa fa-check" aria-hidden="true"></i></a>
                                             <a class="btn btn-danger btn-sm" onclick="return confirm('Esta Seguro de Eliminar?')" href="{{route('prove.facturadelete', ['id' => $f->id])}}" role="button"><i class="fa fa-trash" aria-hidden="true"></i> </a>

                                          </td>
                                       </tr>
                                       @endif
                                       @endforeach
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


@endsection