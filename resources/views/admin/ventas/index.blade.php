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

        <div class="col-md-6">
            @include('admin.ventas.import.articulos')
        </div>


        <div class="col-md-4">
            @include('admin.ventas.import.tablaventa')
        </div>

        <div class="col-md-2 ">
            @include('admin.ventas.import.ultimos _vendidos')

        </div>

    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('plugins/slim-select/slimselect.min.js')}}"></script>
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

    function buscar(numero123) {
        let route = "{{ route('venta.findArticle') }}"
        if (formulario.value.length >= 3) {
            if (event.keyCode === 13 || numero123 === 'si') {
                // Cancel the default action, if needed
                event.preventDefault();
                product = [];
                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        codigo: formulario.value
                    },
                    dataType: "JSON",
                    success: function(resp) {
                        console.log(resp);
                        for (let i = 0; i < resp.length; i++) {
                            if (resp[i].stock > 0) {
                                product.push({
                                    id: parseInt(resp[i].id),
                                    nombre: resp[i].nombre,
                                    codigo: resp[i].cod_barras,
                                    stock: resp[i].stock,
                                    precio: resp[i].p_venta,
                                    descripcion: resp[i].descripcion,
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
                            let desc = data.descripcion.toLowerCase();
                            let code = data.codigo.toLowerCase();
                            let deleted_At = data.deleted_at;
                            if (nombre.indexOf(texto) !== -1 || desc.indexOf(texto) !== -1 || code.indexOf(texto) !== -1 && !deleted_At) {

                                if (data.descripcionInterna) {
                                    result.innerHTML += `
                                        <div class="col-md-3 cursot-pointer mt-2" >
                                            <div class="card" onclick="add(${data.id})">
                                                <img class=""  src="${data.img}" alt="">
                                            <div class="card-body">
                                                <h6 class="card-title">${data.nombre}</h6>
                                                <p class="card-text">${data.descripcion} Q. ${data.precio.toLocaleString()} <br> Stock:  <b>${data.stock} </b>
                                                TIPO: <b>${data.categoria}</b>
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
                                        <div class="col-md-3 cursot-pointer mt-2" >
                                            <div class="card" onclick="add(${data.id})">
                                                <img class=""  src="${data.img}" alt="">
                                                <div class="card-body">
                                                    <h6 class="card-title">${data.nombre}</h6>
                                                    <p class="card-text">${data.descripcion} Q. ${data.precio.toLocaleString()} <br> Stock:  <b>${data.stock} </b>
                                                    </p>
                                                    TIPO: <b>${data.categoria}</b>
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
                    }
                });
            }
        } else {
            produto = [];
        }
        return

    }

    formulario.addEventListener('keyup', buscar)

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
        if (addDesc.value !== 'NORMAL') {
            let descuento = (preciog.value * addDesc.value) / 100;
            if (parseFloat(descuento) >= 0) {
                descuentog.value = parseFloat(descuento)
            } else {
                alert('NO SE APLICO EL DESCUENTO')
            }
        } else {
            addToTable();
        }
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
                '<td><input type="hidden" name="articulo_id[]" value="' + id_producto.value + '">' + nombreg + descripciong + '</td>' +
                '<td><input type="number" class="form-control d-none"  name="precioventa[]" value="' + preciog.value + '" readonly> <label> ' + parseFloat(preciog.value).toFixed(2) + '</label> </td> ' +
                '<td><input type="number" class="form-control d-none"  name="descuento[]" value="' + newdescuento + '" readonly > <label> ' + newdescuento.toFixed(2) + ' </label> </td> ' +
                '<td class="" ><input type="number" class="form-control d-none"  name="cantidad[]" value="' + cantidadg.value + '" readonly >   <label> ' + cantidadg.value + ' </label> </td> ' +
                '<td> <input type="hidden" name="subtotal[]" value="' + subtotal[cont] + '">' + parseFloat(subtotal[cont]).toFixed(2) + '</td>' +
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