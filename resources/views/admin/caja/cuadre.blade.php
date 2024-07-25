@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">

            <h4 class="card-title text-center display-4">Cuadre</h4>
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <h4> Total en Ventas del Dia: <b>Q. {{ number_format($ventas, 2) }}</b></h4>
                            <h4> Total en Caja Chica / Abonos: Q. {{ number_format( $entradas , 2)}}</h4>
                            <h4> Total en Salidas / Gastos: Q. {{ number_format( $salida, 2 )}}</h4>
                            <h4> Total en Creditos: Q. {{ number_format( $deudas, 2 )}}</h4>
                            <h4> Total en Depositos: Q. {{ number_format( $depositos->total_depo, 2 )}} </h4>
                            <h4> Total en Propina: Q. {{ number_format( $propina, 2 )}} </h4>

                        </div>
                        <div class="col-md-6">

                            <h4> Total en Abonos en Deposito: Q. {{ number_format( $abo_depo->total_depo, 2 )}}</h4>
                            <h4> Total en Abonos en Cheque: Q. {{ number_format( $abo_cheque->total_che, 2 )}}</h4>
                        </div>

                    </div>




                    <hr>

                    <h3>Total a Cuadrar = Q. {{ number_format((($entradas - $salida)- $deudas - $depositos->total_depo) + $ventas, 2)    }}</h3>

                    <form action="{{route('caja.cuadreStore')}}" method="post">
                        @csrf

                        <input type="hidden" name="entrada" value="{{$entradas}}">
                        <input type="hidden" name="salida" value="{{$salida}}">
                        <input type="hidden" id="cauadre" name="cuadre" value="{{(($entradas - $salida)- $deudas - $depositos->total_depo) + $ventas}}">



                        <div class="form-group my-2">
                            <input type="number" step="any" class="form-control" name="efectivo" placeholder="TOTAL EN EFECTIVO / ABONOS REALIZADOS" id="efectivo">
                        </div>

                        <div class="form-group my-2">
                            <input type="number" step="any" class="form-control" name="visas" placeholder="TOTAL EN POS" id="visas">
                        </div>

                        <div class="form-group my-2">
                            <input type="number" step="any" class="form-control" id="depositos" name="depositos" placeholder="DEPOSITOS" value="{{$depositos->total_depo}}">
                        </div>

                        <div class="form-group my-2">
                            <input type="number" step="any" class="form-control" name="faltante" placeholder="FALTANTE" id="faltante">
                        </div>

                        <div class="text-lefth my-2">
                            <button type="button" class="btn btn-info" id="igualar"> <i class="fa fa-save mr-1"></i> Cuadrar</button>
                        </div>

                        <div class="text-right my-2">
                            <button type="submit" id="guardar" class="btn btn-success" disabled> <i class="fa fa-save mr-1"></i> Guardar Registro</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')


<script>
    $(document).ready(function() {
        var cuadre = $('#cauadre').val();
        var efectivo = $('#efectivo');
        var faltante = $('#faltante');
        var boton = $('#igualar');
        var visas = $('#visas');
        var depositos = $('#depositos');

        console.log(boton);

        boton.click(function() {
            let total = cuadre - (parseFloat(efectivo.val()) + parseFloat(visas.val()));
            console.log('entro');

            faltante.val(total);
            $('#guardar').prop('disabled', false);
        });

    });
</script>
@endsection