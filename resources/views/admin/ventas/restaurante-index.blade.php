@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('ventas/estilos.css')}}">
<link rel="stylesheet" href="{{asset('plugins/slim-select/slimselect.min.css')}}">

<style>
    .form-check [type=checkbox]:checked,
    .form-check [type=checkbox]:not(:checked) {
        position: absolute;
        left: 10px;
    }

    .logo {
        display: none;
    }

    img {

        width: 70% !important;

    }

    .pie-decodev {
        margin-right: 15%;
    }

    body {
        overscroll-behavior: contain;
    }
</style>
@endsection

@section('content')
<div class="container-fluid mt-4 p-2">
    <div class="row">


        <div class="col-md-12 ">
            <div id="myModal" class="modal fade">
                <div class="modal-dialog modal-login">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">AVISO IMPORTANTE</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">

                            Espero que este mensaje lo encuentre bien. Me comunico con usted para recordarle amablemente que aun hay un saldo pendiente con nosotros DeCoDev Desarrollo de Software. Como hemos establecido en nuestros terminos y condiciones de pago, se esperaba que dicho saldo sea cancelado antes del 16 de Febrero de 2024.
                            <br><br>
                            Como empresa, nos tomamos muy en serio la gestion de nuestras finanzas y contabilidad, por lo que agradeceriamos que se proceda con el pago pendiente lo antes posible. Recuerde que este pago es crucial para mantener nuestra continuidad de negocio y para seguir ofreciendo nuestros servicios de calidad y para que el sistema {{config('app.name')}} no se dado de baja o bloqueado de forma temporal.
                            <br><br>

                            Agradeciendo la comprensión y cooperacion en este asunto. Si es necesario discutir el pago o si hay alguna pregunta sobre la cuenta, no dude en ponerse en contacto con nosotros con el numero de telefono + 502 3283 - 2683 o en la direccion de correo electronico infodecodev@gmail.com.
                            <br><br>



                            Esperamos poder contar con el pago pronto y continuar con nuestra relacion comercial. Muchas gracias por su atencion. <br>DeCoDev Desarrollo de Software #SiLoPuedesImaginarLoPodemosProgramar




                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="card scrolling-wrapper-categorias col-md-4 ">
            <div class="row text-center">
                @foreach ($categoria as $cat)
                <div class="col-6  col-lg-6 col-xl-4 p-3 text-center" onclick="seach_articulo(<?php echo $cat->id ?>)">
                    <div class="card text-center">
                        <img class="" style="width: 100%;" src="{{$cat->tipo}}" alt="">
                        <div class="card-body text-center">
                            <p class="card-title">{{$cat->nombre}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>



        <div class="col-md-5">

            <!-- aca se pinta el resultado de la busqueda / articulo -->
            <div class="row scrolling-wrapper overflow-auto" id="result">

            </div>

        </div>


        <div class="col-md-3">

            <form action="{{route('venta.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="card scrolling-wrapper-table" id="imp1">
                    <p>Datos de Comanda</p>
                    <div class="table-hover p-2">
                        <table class="table table-hover table-sm " id="tabla_venta" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ARTICULO</th>
                                    <th>P. VENTA</th>
                                    <!-- <th>DES.</th> -->
                                    <th class="">CANT</th>
                                    <th class="oculto">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <label for="" class="mt-md-3">TOTAL A CANCELAR: Q.</label>
                        <label id="total"> </label>

                        <div class="form-inline">
                            <div class="form-group mb-2">
                                <label for="">CANCELA: </label>
                                <input type="number" onkeyup="cambio_fun()" id="cancela" step="any" class="form-control ml-2">
                            </div>
                        </div>
                        <label for="" id="cambio"></label>
                    </div>
                    <div class="col-12">

                        <div class="form-group">
                            NUMERO DE MESA
                            <input type="text" class="form-control" name="mesa" id="mesa" placeholder="NUMERO DE MESA">
                        </div>


                        <a class="btn btn-info btn-sm" data-toggle="collapse" href="#VENTASeSPECIALES" aria-expanded="false" aria-controls="VENTASeSPECIALES">
                            VENTAS ESPECIALES
                        </a>

                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#cliente">
                            CLIENTE
                        </button>

                        <a type="button" target="_blank" href="{{route('venta.index')}}" class="btn btn-primary btn-lg btn-block mt-2">NUEVO PEDIDO</a>

                    </div>
                </div>



                <div class="collapse row" id="VENTASeSPECIALES">

                    <div class="form-group col-md-6 d-none">
                        <div class="form-group mb-3">
                            <label for="">DESCUENTO: </label>
                            <input type="number" name="descuentoglobal" value="0" step="any" class="form-control ml-2">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">TIPO DE VENTA</label>
                        <select class="form-control" name="tipo" id="">
                            <option value="EFECTIVO" selected> Ventas en efectivo</option>
                            <option value="CREDITO"> Ventas al crédito</option>
                            <option value="DEPOSITO"> Ventas con depósito</option>
                            <option value="TARJETA"> Ventas con tarjeta de crédito</option>
                            <option value="OTROS"> Ventas otros</option>
                        </select>
                    </div>

                    <div class="form-check ml-md-3 col-md-6">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_cititation" value="true">
                            COTIZACION ?
                        </label>
                    </div>


                </div>


                <button type="button" onclick="javascript:imprim1(imp1);">Imprimir</button>


                <button type="submit" class="btn btn-success mt-2 btn-flotante3" id="bt_submit" onclick="return confirm('¿ESTA SEGURO DE GUARDAR VENTA?')">REGISTRAR</button>




                <!-- Modal para cliente -->
                <div class="modal fade" id="cliente" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center">DATOS DE CLIENTE PARA FACTURA</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row justify-content-center">

                                    <div class="col-md-12 px-4">
                                        <label for="">CLIENTE</label>
                                        <select class="form-control" name="cliente_id" id="cliente_id">
                                            <option value="14" selected>CONSUMIDOR FINAL </option>
                                            <option value="">NUEVO CLIENTE</option>
                                            @foreach($clientes as $cli)
                                            <option value="{{$cli->id}}">{{$cli->nombre}} / {{$cli->nit}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <p>
                                        <a class="btn btn-primary mt-4" data-toggle="collapse" href="#new_cliente" aria-expanded="false" aria-controls="new_cliente">
                                            NUEVO CLIENTE
                                        </a>
                                    </p>
                                    <div class="collapse row" id="new_cliente">
                                        <div class="form-group col-md-6">
                                            <label for="">NOMBRE</label>
                                            <input type="text" class="form-control" name="nombre" placeholder="NOMBRE DE CLIENTE">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">NIT</label>
                                            <input type="text" class="form-control" name="nit" placeholder="NIT DE CLIENTE">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">DIRECCION</label>
                                                <textarea class="form-control" name="direccion" placeholder="DIRECCION"></textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group col-md-12 mt-2">
                                        <textarea class="form-control" name="descripcion" rows="3"></textarea>
                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <button type="button" onclick="addToTable()" class="btn  btn-sm btn-flotante mt-2">
                <i class="fa fa-cart-plus" aria-hidden="true"></i>
            </button>

        </div>


        <div class="col-md-7 d-none">
            <div class="row">
                <div class="col-md-5">
                    Articulo
                    <input type="text" id="producto" class="form-control" placeholder="PRODUCTO A BUSCAR">
                </div>

                <div class="col-md-3">
                    Descuento en %
                    <div class="form-group">
                        <select class="form-control" id="addDesc" disabled>
                            <option value="0">Precio Normal</option>
                            <option value="10">Precio Mayorista (10%) </option>
                            <option value="12">Precio Plus (12%) </option>
                            <option value="15">Precio Premium (15%) </option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    Cantidad
                    <input type="number" class="form-control" value="1" id="cantidadg" style="background: #f37a69; border: 4px solid #0000 !important;">
                </div>
            </div>

            <div class="row justify-content-center">
                <input type="hidden" id="id_producto">
                <div class="col-md-3">
                    Precio Venta
                    <input type="text" class="form-control" id="preciog">

                </div>
                <div class="col-md-3 d-none">
                    Existencia
                    <input type="text" class="form-control" placeholder="Existencia" disabled id="existenciag">
                </div>


                <div class="col-md-3 d-none">
                    Descuento Unitario
                    <input type="number" class="form-control" placeholder="Descuento" id="descuentog" disabled>
                </div>


            </div>





        </div>

        <div class="col-md-2 d-none">
            <div class="row justify-content-center">
                <input type="hidden" id="id_producto">
                <div class="col-md-3">
                    Precio Venta
                    <input type="text" class="form-control" id="preciog">

                </div>
                <div class="col-md-3 d-none">
                    Existencia
                    <input type="text" class="form-control" placeholder="Existencia" disabled id="existenciag">
                </div>


                <div class="col-md-3 d-none">
                    Descuento Unitario
                    <input type="number" class="form-control" placeholder="Descuento" id="descuentog" disabled>
                </div>

                <div class="col-md-3">
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#cliente">
                        CLIENTE
                    </button>
                </div>

                <div class="col-md-3">
                    <a type="button" target="_blank" href="{{route('venta.index')}}" class="btn btn-primary btn-lg btn-block">NUEVO PEDIDO</a>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

@section('scripts')
<script src="{{asset('plugins/slim-select/slimselect.min.js')}}"></script>

<script>
    window.addEventListener("beforeunload", function(event) {
        event.returnValue = "\\o/";
    });

    // es equivalente a
    window.addEventListener("beforeunload", function(event) {
        event.preventDefault();
    });

    function imprim1(imp1) {
        var printContents = document.getElementById('imp1').innerHTML;
        let mesa = document.getElementById('mesa').value;
        w = window.open();



        w.document.write('Mesa: ' + mesa);
        w.document.write(printContents);

        w.document.write(`<style> body {
            @media print {

            .oculto-impresion,
            .oculto-impresion * {
                display: none !important;
            }
            }

            * {
            font-size: 12px;
            font-family: sans-serif;
            font-weight: 800;
            }

            input, .oculto, a  {
                display: none;
            }

            

            img {
            -webkit-filter: grayscale(100%);
            filter: grayscale(100%);
            }

            td,
            th,
            tr,
            table {
            border-top: 1px solid black;
            border-collapse: collapse;
            }

            td.producto,
            th.producto {
            width: 150px;
            max-width: 150px;
            }

            td.cantidad,
            th.cantidad {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
            }

            td.precio,
            th.precio {
            width: 82px;
            max-width: 100px;
            word-break: break-all;
            }

             .centrado {
             text-align: center;
             align-content: center;
             }

            .ticket {
            width: 285px;
            max-width: 357px;
            }

            img {
            max-width: inherit;
            width: inherit;
            }

            p {
            margin-bottom: 0px;
            margin-top: 0px;
            }
         } </style>`)
        // w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10
        w.print();
        // w.close();
        return true;
    }
</script>

<script>
    $(document).ready(function() {
        // $('#myModal').modal('toggle')
    });




    new SlimSelect({
        select: '#cliente_id'
    });

    // combinación de teclas ctrl + i , para guardar
    document.addEventListener('keyup', event => {
        // event.ctrlKey && , para nadir control
        if (event.keyCode === 119) {
            document.getElementById("bt_submit").click();
        }
    }, false)
    var total = 0;
    var cont = 0;
    var subtotal = Array;
    const formulario = document.querySelector('#producto')
    const result = document.querySelector('#result')
    const preciog = document.querySelector('#preciog')
    const existenciag = document.querySelector('#existenciag')
    const cantidadg = document.querySelector('#cantidadg')
    const descuentog = document.querySelector('#descuentog')
    const id_producto = document.querySelector('#id_producto')
    const container = document.querySelector('#container')
    const totalg = document.querySelector('#total')
    const tabla_venta = $('#tabla_venta')
    const addDesc = document.querySelector('#addDesc');
    const cancela = document.querySelector('#cancela')
    const cambio = document.querySelector('#cambio')
    var nombreg = '';
    var descripciong = '';
    cantidadg.value = 1;
    var product = []
    var productG;



    function seach_articulo(categoria_id) {

        result.innerHTML = '<li>SIN RESULTADOS</li>';
        formulario.value = null;

        let route = "{{route('venta.serach_to_categoria')}}"

        $.ajax({
            type: 'GET',
            url: route,

            data: {
                categoria_id: categoria_id
            },
            dataType: 'JSON',
            success: function(resp) {


                product = [];

                for (let i = 0; i < resp.length; i++) {
                    if (resp[i].stock > 0) {
                        product.push({
                            id: parseInt(resp[i].id),
                            nombre: resp[i].nombre,
                            codigo: resp[i].cod_barras,
                            stock: resp[i].stock,
                            precio: resp[i].p_venta,
                            descripcion: (resp[i].descripcion) ? resp[i].descripcion : '',
                            categoria: resp[i].categoria,
                            descripcionInterna: resp[i].descripcion_interna,
                            img: resp[i].img,
                            minimo1: resp[i].minimo1,
                            maximo1: resp[i].maximo1,
                            precio1: resp[i].precio1,
                            minimo2: resp[i].minimo2,
                            maximo2: resp[i].maximo2,
                            precio2: resp[i].precio2,
                            minimo3: resp[i].minimo3,
                            maximo3: resp[i].maximo3,
                            precio3: resp[i].precio3,
                            deleted_at: resp[i].deleted_at
                        })
                    }
                }

                result.innerHTML = '';
                const texto = formulario.value.toLowerCase();
                for (let data of product) {
                    let nombre = data.nombre.toLowerCase();
                    let desc = data.descripcion;
                    let code = data.codigo.toLowerCase();
                    let deleted_At = data.deleted_at;
                    if (nombre.indexOf(texto) !== -1 || desc.indexOf(texto) !== -1 || code.indexOf(texto) !== -1 && !deleted_At) {

                        if (data.descripcionInterna) {
                            result.innerHTML += `
                                <div class="col-4 col-md-6  cursot-pointer mt-2" >
                                    <div class="card" onclick="add(${data.id})">
                                        <img class=""  src="${data.img}" alt="">
                                    <div class="card-body">
                                        <h6 class="card-title">${data.nombre}</h6>
                                        <p class="card-text">${data.descripcion} Q. ${data.precio.toLocaleString()}
                                        </p>
                                    </div>
                                </div>

                                <p class="text-center mt-1">
                                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#contentId${data.id}" aria-expanded="false" aria-controls="contentId">
                                    DESCRIPCION
                                    </button>
                                </p>
                                <div class="collapse" id="contentId${data.id}">
                                    ${data.descripcionInterna}
                                </div>

                                </div>`
                        } else {
                            result.innerHTML += `
                                <div class="col-4 col-md-6 cursot-pointer mt-2" >
                                    <div class="card" onclick="add(${data.id})">
                                        <img class=""  src="${data.img}" alt="">
                                        <div class="card-body">
                                            <h6 class="card-title">${data.nombre}</h6>
                                            <p class="card-text">${data.descripcion} Q. ${data.precio.toLocaleString()}
                                            </p>
                                        </div>
                                    </div>
                                </div>`
                        }
                        formulario.value = null;
                    }
                }

                if (result.innerHTML == '') {
                    result.innerHTML = '<li>SIN RESULTADOS</li>';
                    formulario.value = null;
                }



            },
            error: function(resp) {
                console.log(resp);
            }

        })

    }



    function add(idpro) {
        const {
            id,
            nombre,
            codigo,
            precio,
            stock,
            descripcion,
            minimo1,
            maximo1,
            precio1,
            minimo2,
            maximo2,
            precio2,
            minimo3,
            maximo3,
            precio3,
        } = product.find(e => e.id === idpro);

        productG = {
            id,
            nombre,
            codigo,
            precio,
            stock,
            descripcion,
            minimo1,
            maximo1,
            precio1,
            minimo2,
            maximo2,
            precio2,
            minimo3,
            maximo3,
            precio3,
        }
        preciog.value = precio
        // cambiar la existencia por la del producto
        existenciag.value = stock



        id_producto.value = id
        nombreg = nombre;
        descripciong = descripcion;

        let new_cantidad = prompt('CANTIDAD', 1)

        cantidadg.value = new_cantidad;


        // PREGUNTAR CANTIDAD Y PRECIO VENTA

        addToTable();

    }

    function limpiar() {
        preciog.value = '';
        existenciag.value = '';
        cantidadg.value = 1;
        descuentog.value = '';
        formulario.focus()
    }

    function eliminar_fila(index) {
        total = total - subtotal[index];
        totalg.innerHTML = ' <input type="number" id="totvent" name="totalventa" class="form-control d-none" style="height: 4vh;" value="' + total + '" readonly > <label>' + total.toFixed(2) + '</laberl';
        $('#fila' + index).remove();
    }


    function addToTable() {
        var newdescuento = 0;
        if (descuentog.value > 0) {
            newdescuento = (descuentog.value) * cantidadg.value;
        }

        if (id_producto.value != '' && preciog.value != '' && cantidadg.value != '' && existenciag.value != '') {

            if (parseFloat(cantidadg.value) > parseFloat(productG.stock)) {
                alert('LA CANTIDAD A VENDER SUPERA LA EXISTENCIA')
                console.log('entro');
                return
            }

            // if ((cantidadg.value >= parseFloat(productG.minimo1)) && (cantidadg.value <= parseFloat(productG.maximo1))) {
            //     preciog.value = productG.precio1
            // }

            // if ((cantidadg.value >= parseFloat(productG.minimo2)) && (cantidadg.value <= parseFloat(productG.maximo2))) {
            //     preciog.value = productG.precio2
            // }

            // if ((cantidadg.value >= parseFloat(productG.minimo3)) && (cantidadg.value <= parseFloat(productG.maximo3))) {
            //     preciog.value = productG.precio3
            // }

            subtotal[cont] = (cantidadg.value * preciog.value) - newdescuento;
            total = total + subtotal[cont];
            var fila = '<tr class="selected" id="fila' + cont + '">' +
                '<td><a href="#" class="btn btn-danger btn-sm" onclick="eliminar_fila(' + cont + ')">X</a></td>' +
                '<td><input type="hidden" name="articulo_id[]" value="' + id_producto.value + '">' + nombreg + '</td>' +
                '<td><input type="number" class="form-control d-none"  name="precioventa[]" value="' + preciog.value + '" readonly> <label> ' + parseFloat(preciog.value).toFixed(2) + '</label> </td> ' +
                '<td><input type="hidden" class="form-control d-none"  name="descuento[]" value="' + newdescuento + '" readonly > <label class="oculto"> ' + newdescuento.toFixed(2) + ' </label> </td> ' +
                '<td class="" ><input type="number" class="form-control d-none"  name="cantidad[]" value="' + cantidadg.value + '" readonly >   <label> ' + cantidadg.value + ' </label> </td> ' +
                '<td class="oculto"> <input type="hidden" name="subtotal[]" value="' + subtotal[cont] + '">' + parseFloat(subtotal[cont]).toFixed(2) + '</td>' +
                '</tr>';
            cont++;
            limpiar();
            tabla_venta.prepend(fila);
            totalg.innerHTML = ' <input type="number" id="totvent" name="totalventa" class="form-control d-none" style="height: 4vh;" value="' + total + '" readonly > <label>' + total.toFixed(2) + '</laberl'
        } else {
            container.innerHTML += `
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>SELECCIONE!</strong> UN PRODUCTO.
                </div>
            `
        }

    }

    function cambio_fun() {
        let cambiof = parseFloat(cancela.value)
        let newcambio = cambiof - total;
        cambio.innerHTML = '<label> CAMBIO: Q. ' + newcambio.toFixed(2) + '</label>';
    }
</script>

@endsection