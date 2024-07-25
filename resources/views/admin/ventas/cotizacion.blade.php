@extends('layouts.app')

@section('styles')
<style>
    @media print {

        .oculto-impresion,
        .oculto-impresion * {
            display: none !important;
        }
    }
</style>
@endsection


@section('content')


<div class="container-fluid">
    @includeIf('includes.alerta')
    <div class="row">
        <div class="col-5 " style="margin-top: 5%">

            <div align="center">
                <h3 class="text-capitalize">{{config('app.name')}}</h3>
                <div style="font-size: 20px;">
                    <p class="style=" text-align: center;"">
                        {{config('app.direccion')}}
                    </p>
                    <p style="text-align: center;">
                        Teléfono: <span class="text-info">{{config('app.telefono')}}</span>
                    </p>
                </div>
            </div>

        </div>

        <div class="col-2">
            <div class="text-right mb-2">
                <img src="{{asset('assets/images/logo.png')}}" style="width: 90%;" class="img-fluid" alt="{{config('app.name')}}">
                <div class="text-center">
                    <b>{{config('app.slogan')}}</b>
                </div>

            </div>
        </div>

        <div class="col-5" style="margin-top: 5%;">
            <h3 class="text-capitalize text-center" style="margin-left:  13%;">Datos De Emision</h3>
            <div class="text-right" style="font-size: 20px;">
                <p class="text-uppercase " style="margin-left:  30%;">
                    Fecha: @php echo date('d-m-Y h:i:s') @endphp
                </p>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <div class="card p-4">


                <form action="{{route('coti.store')}}" method="post" autocomplete="off">
                    @csrf

                    <div class="form-group row mb-2">
                        <div class="col-md-9">
                            <label for="">Nombre: </label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre de Cliente" required>
                        </div>
                        <div class="col-md-3">
                            <label for="">NIT: </label>
                            <input type="text" class="form-control" name="nit" placeholder="NIT de Cliente" required>
                        </div>
                    </div>


                    <p>
                        <button class="btn btn-primary oculto-impresion" type="button" data-toggle="collapse" data-target="#contentId" aria-expanded="false" aria-controls="contentId">

                            <i class="fa fa-cart-plus" aria-hidden="true"></i>

                        </button>
                    </p>
                    <div class="collapse" id="contentId">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Articulos: </font>
                                </font>
                            </label>
                            <div class="col-md-10">
                                <select class="form-control" name="articulo" id="medicamento" autofocus>
                                    <option value="">Seleccione Articulo &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</option>
                                    @foreach($articulos as $art)
                                    <option value="{{ $art->id}}_{{$art->stock}}_{{$art->p_venta}}">{{$art->nombre}}
                                        @php
                                        echo $art->descripcion;
                                        @endphp

                                        / {{$art->cod_barras}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row mx-3">

                                <div class="col-3">
                                    Precio
                                    <input type="text" class="form-control" placeholder="Precio Venta" name="" id="pventa">

                                </div>

                                <div class="col-3">
                                    Existencia
                                    <input type="text" class="form-control" placeholder="Existencia" name="" disabled id="existencia">
                                </div>

                                <div class="col-3">
                                    Cantidad
                                    <input type="number" class="form-control" name="" value="1" id="cantidad">
                                </div>


                                <div class="col-2">
                                    <a href="#" style="font-size: 150%;" id="add"> <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 65px;"></i> </a>
                                </div>

                            </div>
                        </div>
                    </div>


                    <h1 class="display-4 text-center text-uppercase ">Datos de Cotizacion</h1>

                    <hr>


                    <!-- descripcion -->
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col">
                                <!-- Widget: user widget style 1 -->

                                <table class="table table-hover table-inverse" id="tabla_venta">
                                    <thead class="" style="    background-color: #174578;color: white;">
                                        <tr>
                                            <th class="oculto-impresion">Accion</th>
                                            <th>Articulo</th>
                                            <th>Precio Venta</th>
                                            <th>Cantidad</th>
                                            <th>Total</th>
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
                    </div>
                    <!-- fin descripcio -->

                    <!-- totales -->
                    <div class="row justify-content-end">
                        <div class="col-4">
                            <p class="lead">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Monto a Pagar </font>
                                </font>
                            </p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Total:Q</font>
                                                </font>
                                            </th>
                                            <td>
                                                <label id="total"> </label>

                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- fin totales -->



                    <button class="btn btn-success oculto-impresion">Guardar</button>


                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/theme/vendor/select2/select2.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#idcliente').select2({
            width: '100% !important'
        });
        $('#medicamento').select2({
            width: '100% !important'
        });
    });
</script>

<script>
    var cliente = $('#idcliente');
    var total_venta = $('#total');
    var tabla = $('#tabla_venta');
    var btn_add = $('#add');
    var medicamento = $('#medicamento');
    var pventa = $('#pventa');
    var existenci = $('#existencia');
    var efectivo = $('#efectivo');
    var cambio = $('#cambio');

    var total = 0;
    var cont = 0;
    var subtotal = Array;



    medicamento.change(mostrarvalores);

    function mostrarvalores() {
        datosmerdicamento = document.getElementById('medicamento').value.split('_');

        existenci.val(datosmerdicamento[1]);
        pventa.val(datosmerdicamento[2]);

        // agregar();
    }

    function limpiar() {
        var medicamento = $('#medicamento').val('');

        let pventa = $('#pventa').val('');
        let existenci = $('#existencia').val('');
        let cantidad = $('#cantidad').val('1');
        medicamento.focus();
    }

    btn_add.click(function() {
        agregar();
    })

    function agregar() {
        datosmerdicamento = document.getElementById('medicamento').value.split('_');

        var idmedicamento = datosmerdicamento[0];
        let pventa = parseFloat($('#pventa').val());
        let existenci = $('#existencia').val();

        let cantidad = parseInt($('#cantidad').val());
        let medicamento = $('#medicamento option:selected').text();

        // console.log(pventa);
        // console.log(cantidad);

        if (idmedicamento != "" && pventa != "" && existenci != "" && cantidad != "") {
            if (cantidad <= existenci) {

                subtotal[cont] = cantidad * pventa;
                total = total + subtotal[cont];



                var fila = '<tr class="selected" id="fila' + cont + '">' +
                    '<td class="oculto-impresion"><a href="#" class="btn btn-danger btn-sm oculto-impresion" onclick="eliminar_fila(' + cont + ')">X</a></td>' +
                    '<td><input type="hidden" name="idArticulos[]" value="' + idmedicamento + '">' + medicamento + '</td>' + '<td><input type="number" class="form-control"  name="pventa[]" value="' + pventa + '" readonly></td> ' +
                    '<td><input type="number" class="form-control"  name="cantidad[]" value="' + cantidad + '" readonly ></td> ' +
                    '<td> <input type="hidden" name="subtotal[]" value="' + subtotal[cont] + '">' + subtotal[cont] + '</td>' +
                    '</tr>';
                cont++;
                limpiar();

                total_venta.html('<input type="number" id="totvent" name="totalventa" class="form-control" value="' + total + '" readonly >');
                tabla.append(fila);
            } else {
                alert('LA CANTIDAD A VENDER SUERA LA EXISTENCIA');
            }

        } else {
            alert('TODOS LOS CAMPOS DEBEN DE ESTAR LLENOS');
        }
    }

    function eliminar_fila(index) {
        total = total - subtotal[index];

        total_venta.html('<input type="number" name="totalventa" class="form-control" value="' + total + '" readonly >');
        $('#fila' + index).remove();
    }

    function cambiofun() {

        var totVent = $('#totvent').val();

        var cambio = parseFloat(efectivo.val()) - parseFloat(totVent);

        console.log(cambio);

        $('#cambio').val(cambio);


    }
</script>
@endsection