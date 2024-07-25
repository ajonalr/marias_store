@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{asset('plugins/slim-select/slimselect.min.css') }}">
@endsection

@section('content')
<div class="container-fluid">

    <h4 class="display-4 text-uppercase">reporte de articulos</h4>
    <div class="row">

        <div class="col-md-4 my-2">
            <div class="card text-white" style="background-color: #20d894 !important;">
                <center>
                    <img style="width: 30%;height: 30%;" class="card-img-top img-fluid my-2" width="30%" height="30%" src="{{asset('logos/images/artall.png')}}">
                </center>
                <div class="card-body">
                    <h4 class="card-title text-capitalize text-center">ARTICULOS DETALLADOS PARA ADMINISTRADOR </h4>
                    <p class="card-text text-center">IMPRIME UN LISTAS CON TODOS LOS ARTICULOS REGISTRADOS, CON PRECIO DE VENTAS Y TOTAL DE CAPITAL INVERTIDO</p>
                    <div class="text-right mt-2">
                        <a target="_blank" class="btn btn-dark" href="{{route('articulo.repotesAll')}}" role="button"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 my-2">
            <div class="card text-white" style="background-color: #d26d6d !important;">
                <center>
                    <img style="width: 30%;height: 30%;" class="card-img-top img-fluid my-2" width="30%" height="30%" src="{{asset('logos/images/artstock.png')}}">
                </center>

                <div class="card-body">

                    <h4 class="card-title text-capitalize text-center">articulos con minimo de stock </h4>
                    <p class="card-text text-center">Imprime un Listado de todos los Articulos con <b>Minimo</b> de Stock, reflejando precio ventas y precios costo (recomendado para Administrador) </p>

                    <div class="text-right mt-2">
                        <a target="_blank" class="btn btn-dark" href="{{route('articulo.repotesAllmin')}}" role="button"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4 my-2">
            <div class="card text-white" style="background-color: #e39932 !important">
                <center>
                    <img style="width: 30%;height: 30%;" class="card-img-top img-fluid my-2" width="30%" height="30%" src="{{asset('logos/images/artstock.png')}}">
                </center>

                <div class="card-body">

                    <h4 class="card-title text-capitalize text-center">EXISTENCIA PARA INVENTARIOS - PARA COLABORADORES </h4>
                    <p class="card-text text-center">Imprime un Listado de todos los Articulos para <b>Control de Existencia</b>, en este no se veran precios costo. Solamente precio venta y cantidad registrada </p>

                    <div class="text-right mt-2">
                        <a target="_blank" class="btn btn-dark" href="{{route('articulo.stockControl')}}" role="button"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4 my-2">
            <div class="card text-white" style="background-color: #05c1bd  !important">
                <center>
                    <img style="width: 30%;height: 30%;" class="card-img-top img-fluid my-2" width="30%" height="30%" src="{{asset('logos/images/artstock.png')}}">
                </center>

                <div class="card-body">

                    <h4 class="card-title text-capitalize text-center">articulos vendidos solo con contenido de impresion </h4>
                    <p class="card-text text-center">Imprime un Listado de todos los Articulos <b>Vendidos</b>, filtrados por Año y Mes, en este solo se visualizara: Nombre de Articulo y Cantidad Vendida </p>

                    <form action="{{route('articulo.articulosvendidos')}}" method="get">

                        <select name="ano" class="form-control mb-2">
                            <option value="">Seleccione Año</option>
                            @for($i = 2022; $i < 2050; $i ++) <option value="{{$i}}">Año: {{$i}}</option>
                                @endfor
                        </select>

                        <select name="mes" class="form-control mb-2">
                            <option selected hidden>Mes</option>
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>

                        <div class="text-right mt-2">
                            <button class="btn btn-success"> <i class="fa fa-print" aria-hidden="true"></i> Imprimir </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 my-2">
            <div class="card text-white" style="background-color: #b455c5 !important; color: white">

                <center>
                    <img style="width: 30%;height: 30%;" class="card-img-top img-fluid my-2" width="30%" height="30%" src="{{asset('logos/images/artall.png')}}">
                </center>

                <div class="card-body">

                    <h4 class="card-title text-capitalize text-center">Historial de Articulos Comprados </h4>
                    <p class="card-text text-center">GENERA EL REPORTE DE TODAS LAS COMPRAR DE ARTICULOR REALIZADA, (nombre de articulo, numero de factura y cantidad comprada)</p>

                    <form class="" method="GET" action="{{route('articulo.compraReport')}}">
                        <div class="form-group">
                            <label for="">INICIO: </label>
                            <input type="date" name="inicio" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">FIN: </label>
                            <input type="date" name="fin" class="form-control">
                        </div>
                        <div class="text-right mt-2">
                            <button type="submit" class="btn btn-info ml-4"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-4 my-2">
            <div class="card">

                <center>
                    <img style="width: 30%;height: 30%;" class="card-img-top img-fluid my-2" width="30%" height="30%" src="{{asset('logos/images/artall.png')}}">
                </center>

                <div class="card-body">
                    <h4 class="card-title text-capitalize text-center">ARTICULOS REGISTRADOS </h4>
                    <p class="card-text text-center">GENERA EL REPORTE DE ARTICULOS REGISTRADOS, RETORNA INFORMACION SENSIBLE COMO: PRECIO DE VENTA, PRECIO COSTO (ADMINISTRADO)</p>
                    <form class="" method="GET" action="{{route('articulo.registerToDate')}}">
                        <div class="form-group">
                            <label for="">INICIO: </label>
                            <input type="date" name="inicio" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">FIN: </label>
                            <input type="date" name="fin" class="form-control">
                        </div>
                        <div class="text-right mt-2">
                            <button type="submit" class="btn btn-info ml-4"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 my-2">
            <div class="card">

                <center>
                    <img style="width: 30%;height: 30%;" class="card-img-top img-fluid my-2" width="30%" height="30%" src="{{asset('logos/images/artall.png')}}">
                </center>

                <div class="card-body">
                    <h4 class="card-title text-capitalize text-center">ARTICULO VENDIDO </h4>
                    <p class="card-text text-center">GENERA EL REPORTE DE ARTICULOS VENDIDOS, RETORNA INFORMACION SENSIBLE COMO: PRECIO DE VENTA, PRECIO COSTO (ADMINISTRADO)</p>
                    <form class="" method="GET" action="{{route('articulo.articulo_vendido')}}">

                    <select name="articulo_id" id="articulo">
                        @foreach ($data as $d)
                        <option value="{{$d->id}}">{{$d->nombre}}, <?php echo $d->descripcion;?></option>
                        @endforeach
                    </select>
                        <div class="form-group">
                            <label for="">INICIO: </label>
                            <input type="date" name="inicio" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">FIN: </label>
                            <input type="date" name="fin" class="form-control">
                        </div>
                        <div class="text-right mt-2">
                            <button type="submit" class="btn btn-info ml-4"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>


</div>

@endsection



@section('scripts')
<script src="{{asset('plugins/slim-select/slimselect.min.js') }}"></script>
<script>
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