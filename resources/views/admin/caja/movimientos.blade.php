@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">


        @can('caja_filtrado_gastos')
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">GASTOS</h4>
                    <p class="card-text">IMPRIME / VISUALIZA EL LISTADO DE SALIDAS DE EFECTIVO FILTRADO POR FECHA</p>

                    <br>


                    <form action="{{route('caja.salidaReport')}}" method="post">
                        @csrf()

                        <div class="form-group">
                            <label for="">TIPO DE SALIDA / GASTO</label>
                            <select class="form-control" name="tipo">
                                <option value="ADELANTO DE SUELDO">ADELANTO DE SUELDO</option>
                                <option value="ALMUERZOS PERSONAL">ALMUERZOS PERSONAL</option>
                                <option value="GASOLINA">GASOLINA</option>
                                <option value="PAGO QUINCENA">PAGO QUINCENA</option>
                                <option value="PAGO FIN DE MES">PAGO FIN DE MES</option>
                                <option value="REPUESTOS">REPUESTOS</option>
                                <option value="REFACCIONES">REFACCIONES</option>
                                <option value="TODOS">TODOS</option>

                                <option value="OTROS" selected>OTROS</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">De (Fecha de Inicio): </label>
                            <input type="date" class="form-control" name="desde" placeholder="Fecha de Inicio" required>
                        </div>
                        <div class="form-group">
                            <label for="">Hasta (Fecha de Final): </label>
                            <input type="date" class="form-control" name="hasta" placeholder="Fecha de Fin" required>
                        </div>

                        <button type="submit" class="btn btn-primary"> <i class="fa fa-filter" aria-hidden="true"></i> Buscar </button>
                    </form>


                </div>
            </div>
        </div>
        @endcan

        @can('caja_filtrado_cajachica')
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CAJA CHICA</h4>
                    <p class="card-text">IMPRIME / VISUALIZA EL LISTADO DE ENTRADAS "EXTRAS" DE EFECTIVO FILTRADO POR FECHA</p>
                    <br>
                    <form action="{{route('caja.entradasReport')}}" method="post">
                        @csrf()
                        <div class="form-group">
                            <label for="">De (Fecha de Inicio): </label>
                            <input type="date" class="form-control" name="desde" placeholder="Fecha de Inicio" required>
                        </div>

                        <div class="form-group">
                            <label for="">Hasta (Fecha de Final): </label>
                            <input type="date" class="form-control" name="hasta" placeholder="Fecha de Fin" required>
                        </div>

                        <button type="submit" class="btn btn-primary"> <i class="fa fa-filter" aria-hidden="true"></i> Buscar </button>
                    </form>
                </div>
            </div>
        </div>
        @endcan

    </div>

    @can('caja_movimientos_filtrados')
    <div class="row mt-3">

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Reporte de Cuadres del Mes</h4>
                    <p class="card-text">Imprime y lista un Reporte de los Cuadres Realizados</p>
                    <a class="btn btn-primary" href="{{route('caja.cuadreReport')}}" role="button"> <i class="fa fa-print" aria-hidden="true"></i> IMPRIMIR </a>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Reporte de Cuadres Filtrado</h4>
                    <p class="card-text">Imprime y lista un Reporte de los Cuadres Realizados Filtrados por mes y Año</p>

                    <form action="{{route('caja.cuadrereportFilter')}}" method="get">

                        <div class="form-group">
                            <label for="mes">Año</label>
                            <select class="form-control" name="ano">
                                @for($i = 2022; $i < 2051; $i ++) <option value="{{$i}}">Año: {{$i}}</option>
                                    @endfor
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="mes">Mes</label>
                            <select class="form-control" name="mes">
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
                        </div>


                        <button class="btn btn-primary" type="submit"> <i class="fa fa-print" aria-hidden="true"></i> IMPRIMIR </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="card text-left">
                <div class="card-body">
                    <h4 class="card-title">MOVIMIENTOS DE HOY</h4>
                    <p class="card-text">RETORNA LOS MOVIMOS DE UN DIA EN ESPECIFICO</p>

                    <form action="{{route('caja.movimientos_dia')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">MOVIEMITOS DE LA FECHA</label>
                            <input type="date" name="fecha" class="form-control">
                            <small id="helpId" class="text-muted">MOVIEMITOS</small>
                        </div>


                        <button type="submit" class="btn btn-dark"><i class="fa fa-print" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">GANANCIAS</h4>
                    <p class="card-text">IMPRIME / VISUALIZA EL REPORTE DE GANACIAS CON VENTAS Y GASTOS DETALLADOS</p>
                    <br>
                    <form action="{{route('caja.ganancias')}}" method="post">
                        @csrf()
                        <div class="form-group">
                            <label for="">De (Fecha de Inicio): </label>
                            <input type="date" class="form-control" name="inicio" placeholder="Fecha de Inicio" required>
                        </div>

                        <div class="form-group">
                            <label for="">Hasta (Fecha de Final): </label>
                            <input type="date" class="form-control" name="fin" placeholder="Fecha de Fin" required>
                        </div>

                        <button type="submit" class="btn btn-primary"> <i class="fa fa-filter" aria-hidden="true"></i> Buscar </button>
                    </form>
                </div>
            </div>
        </div>


    </div>
    @endcan

</div>

@endsection