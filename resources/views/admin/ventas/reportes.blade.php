@extends('layouts.admin')



@section('content')
<div class="container-fluid mb-5">

    <h1 class="text-center text-uppercase">reporte de ventas</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow p-3 mb-5 bg-body rounded ">

                <center>
                    <img style="width: 30%;height: 100%;" class="card-img-top img-fluid my-2" width="30%" height="100%" src="{{asset('logos/images/artall.png')}}">
                </center>

                <div class="card-body">

                    <h4 class="card-title text-capitalize text-center">todas las ventas </h4>
                    <p class="card-text text-center">Imprime un listado de todas las ventas</p>

                    <div class="text-right mt-2">
                        <form action="{{route('venta.reportesAll')}}" method="get">

                            <div class="form-group">
                                <label for="">INICIO: </label>
                                <input type="date" name="inicio" class="form-control">
                            </div>
                            <div class="form-group ml-4">
                                <label for="">FIN: </label>
                                <input type="date" name="fin" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-info ml-4"><i class="fa fa-search" aria-hidden="true"></i></button>

                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4 mt-2">
            <div class="card shadow p-3 mb-5 bg-body rounded ">
                <center>
                    <img style="width: 30%;height: 100%;" class="card-img-top img-fluid my-2" width="30%" src="{{asset('logos/images/artstock.png')}}">
                </center>

                <div class="card-body">

                    <h4 class="card-title text-capitalize text-center">Ventas Del Dia </h4>
                    <p class="card-text text-center">Imprime un Listado de todas las ventas del <b>Dia</b> </p>

                    <div class="text-right mt-2">


                        <a name="" class="btn btn-primary" href="{{route('venta.diaReport')}}"> <i class="fa fa-print" aria-hidden="true"></i> Imprimir Reporte </a>


                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4 mt-2">
            <div class="card shadow p-3 mb-5 bg-body rounded ">
                <center>
                    <img style="width: 30%;height: 100%;" class="card-img-top img-fluid my-2" width="30%" src="{{asset('logos/images/artstock.png')}}">
                </center>

                <div class="card-body">

                    <h4 class="card-title text-capitalize text-center">Graficas Estadisticas </h4>
                    <p class="card-text text-center">Imprime un Submodulo de Control Estadistico </p>

                    <div class="text-right mt-2">


                        <a name="" class="btn btn-primary" href="{{route('venta.estadistica')}}"> <i class="fa fa-print" aria-hidden="true"></i> Imprimir Datos </a>


                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4 mt-md-2">
            <div class="card shadow p-3 mb-5 bg-body rounded ">

                <center>
                    <img style="width: 30%;height: 100%;" class="card-img-top img-fluid my-2" width="30%" height="100%" src="{{asset('logos/images/artall.png')}}">
                </center>

                <div class="card-body">

                    <h4 class="card-title text-capitalize text-center">VENTAS </h4>
                    <p class="card-text text-center">Imprime un listado de todas las ventas FILTRADAS POR DIA DE FORMA COMPIRMIDA Y SISMPLE</p>

                    <div class="text-right mt-2">
                        <form action="{{route('venta.fucturasSimples')}}" method="POST">
                            @csrf()
                            <div class="form-group">
                                <label for="">De (Fecha de Inicio): </label>
                                <input type="date" class="form-control" name="desde" placeholder="Fecha de Inicio" required>
                            </div>
                            <div class="form-group">
                                <label for="">Hasta (Fecha de Final): </label>
                                <input type="date" class="form-control" name="hasta" placeholder="Fecha de Fin" required>
                            </div>

                            <button class="btn btn-dark" type="submit"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-md-2">
            <div class="card shadow p-3 mb-5 bg-body rounded ">

                <center>
                    <img style="width: 30%;height: 100%;" class="card-img-top img-fluid my-2" width="30%" height="100%" src="{{asset('logos/images/artall.png')}}">
                </center>

                <div class="card-body">

                    <h4 class="card-title text-capitalize text-center">TIPOS DE VENAS </h4>
                    <p class="card-text text-center">Imprime un listado de todas las ventas FILTRADAS POR DIA Y TIPO DE PAGO</p>

                    <div class="text-right mt-2">
                        <form action="{{route('ventas.reportVentasToTipoAndDate')}}" method="POST">
                            @csrf()
                            <div class="form-group">
                                <label for="">De (Fecha de Inicio): </label>
                                <input type="date" class="form-control" name="inicio" placeholder="Fecha de Inicio" required>
                            </div>
                            <div class="form-group">
                                <label for="">Hasta (Fecha de Final): </label>
                                <input type="date" class="form-control" name="fin" placeholder="Fecha de Fin" required>
                            </div>

                            <div class="form-group">
                                <label for=""></label>
                                <select class="form-control" name="tipo">
                                    <option value="EFECTIVO">EFECTIVO</option>
                                    <option value="CREDITO">CREDITO</option>
                                    <option value="DEPOSITO">DEPOSITO</option>
                                    <option value="TARJETA">TARJETA</option>
                                    <option value="OTROS">OTROS</option>

                                </select>
                            </div>


                            <button class="btn btn-dark" type="submit"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>
@endsection