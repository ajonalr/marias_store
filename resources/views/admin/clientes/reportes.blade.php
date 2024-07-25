@extends('layouts.admin')




@section('content')

<div class="container-fluid mb-5">
    <div class="row">
        <div class="col">
            <div class="card p-4">
                <h4 class="card-title text-uppercase">reporte de clientes</h4>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white" style="background-color: #20d894 !important;">

                            <center>
                                <img style="width: 30%;height: 30%;" class="card-img-top img-fluid my-2" width="30%" height="30%" src="{{asset('logos/images/users.png')}}">
                            </center>

                            <div class="card-body">

                                <h4 class="card-title text-capitalize text-center">todos los clientes </h4>
                                <p class="card-text text-center">Imprime un Listado de todos los Clientes Registrados</p>

                                <div class="text-right mt-2">
                                    <a target="_blank" class="btn btn-dark" href="{{route('cliente.reportesAllClientes')}}" role="button"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</a>
                                </div>

                            </div>
                        </div>
                    </div>

                 <div class="col-md-4">
                        <div class="card">
                            <center>
                                <img style="width: 30%;height: 30%;" class="card-img-top img-fluid my-2" width="30%" height="30%" src="{{asset('logos/images/userdeu.png')}}">
                            </center>

                            <div class="card-body">


                                <h4 class="card-title text-capitalize text-center">DEUDORES </h4>
                                <p class="card-text text-center">RETORNA EL REPORTE DE LOS CLIENTES DEUDORES CON SUMATORIA DE DEUDAS </p>

                                <div class="text-right mt-2">
                                    <a target="_blank" class="btn btn-dark" href="{{route('cliente.reportesDeudores')}}" role="button"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</a>
                                </div>

                            </div>
                        </div>
                    </div> 

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">PAGOS / ABONOS </h4>
                                <p class="card-text">RETORNA EL REPORTE DE CLIENTE QUE HAN REALIZADO UN ABONO</p>

                                <form action="{{route('cliente.abonos_report_filter')}}" method="post">
                                    @csrf()

                                    <div class="form-group">
                                        <label for="">De (Fecha de Inicio): </label>
                                        <input type="date" class="form-control" name="inicio" placeholder="Fecha de Inicio" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Hasta (Fecha de Final): </label>
                                        <input type="date" class="form-control" name="fin" placeholder="Fecha de Fin" required>
                                    </div>
                                    <button class="btn btn-dark" type="submit"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</button>

                                </form>

                            </div>
                        </div>
                    </div> 

                </div>

            </div>
        </div>
    </div>
</div>

@endsection