@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col ">
            <div class="card p-4 mb-3">

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Articulo</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Actualizar</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " target="_blank" href="{{route('articulo.exportdata', ['id' => $articulo->id])}}">Imprimir Codigo</a>
                    </li>

                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active text-center" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                        <h4> Articulo / {{$articulo->nombre}}</h4>

                        <div class="card p-3">
                            <div class="center">
                                <img class="card-img-top img-fluid rounded-circle" style="width: 300px;" src="{{config('app.url')}}/storage/articulos/{{$articulo->img}}" alt="{{$articulo->nombre}}">
                                {{-- <img class="card-img-top img-fluid" style="width: 300px;" src="{{$articulo->img2}}" alt="{{$articulo->nombre}}"> --}}
                            </div>
                            <div class="card-body row">


                                <div class="col-md-6">
                                    <h2 class="text-uppercase text-center">{{$articulo->nombre}}</h2>

                                    <p class="text-uppercase">
                                        Description: <br>
                                    </p>

                                    @php
                                    echo $articulo->descripcion;
                                    @endphp
                                    <p class="card-text text-capitalize">Descripcion Interna: </p>

                                    @php
                                    echo $articulo->descripcion_interna;
                                    @endphp


                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <p class="card-text text-capitalize">Maximo Stock: {{$articulo->stock_maximo}}</p>
                                            <p class="card-text text-capitalize">Codigo De Barras: {{$articulo->cod_barras}}</p>
                                            <p class="card-text">Precio Venta: Q. {{number_format($articulo->p_venta, 2)}}</p>
                                            <p class="card-text">Precio Costo: Q. {{number_format($articulo->p_costo, 2)}}</p>
                                            <p class="card-text">Utilidad del Articulo: Q. {{$articulo->p_venta - $articulo->p_costo}}</p>
                                        </div>

                                        <div class="col-md-6">
                                            <h4>Talla: <span class="badge badge-primary">{{$articulo->fabricante}}</span></h4>



                                            <div class="card-text">Url de Compra:

                                                <a name="" id="" class="btn btn-warning btn-sm" href="{{$articulo->medida}}" role="button" target="_blank"><i class="fa fa-link" aria-hidden="true"></i> URL DE COMPRA</a>
                                            </div>

                                            <p class="card-text mt-3">Fecha de Registro: {{$articulo->created_at}}</p>
                                            <p>Minimo de Stock: {{$articulo->min_stock}}</p>
                                            <p class="card-text">Existencia:
                                                @if($articulo->stock > $articulo->min_stock)
                                                <span class="badge bg-success" style="font-size: 15px; color: white;">{{$articulo->stock}}</span>
                                                @else
                                                <span class="badge bg-warning" style="font-size: 15px;">{{$articulo->stock}} (Poca existencia)</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 d-none">
                                    <h4>INGREDIENTES</h4>
                                    @foreach ($ingredients as $ing)
                                    <p>{{$ing->ingrediente->nombre}} - SALIDA DE ARTICULO: {{$ing->cantidad}}u</p>
                                    <p><?php echo $ing->ingrediente->descripcion; ?></p>
                                    <form action="{{route('ingrediente.deleteIngredienteMenu', $ing)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type='submit' class='btn btn-danger btn-sm' onclick="return confirm('Esta Seguro de Eliminar?')"><i class='fa fa-trash' aria-hidden='true'></i></button>
                                    </form>
                                    <hr>
                                    @endforeach
                                </div>

                                <div class="col-md-6">

                                    <h3>DATOS DE PROVEEDOR</h3>
                                    <p>Nombre de Vendedor: {{$articulo->provName}}</p>
                                    <p>Empresa: {{$articulo->empresa}}</p>
                                    <p>Direccion de Empresa: {{$articulo->direccion}}</p>
                                    <p>Telefono Primario: {{$articulo->telefono1}}</p>
                                    <p>Telefono Secundario: {{$articulo->telefono2}}</p>
                                    <p>Articulos Que Provee</p>
                                    <pre>{{$articulo->articulos}}</pre>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <h4>Actualizar</h4>


                        <form action="{{route('articulo.update', ['id' => $articulo->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('admin.articulos.forms.store')

                            <button type="submit" class="btn btn-warning btn-block"> <i class="fas fa-save    "></i> Actualizar</button>
                        </form>


                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

<script src="{{ asset('plugins/ckeditor/ckeditor.js')  }}"></script>
<script>
   
</script>

@endsection