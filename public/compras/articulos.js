var bolsa_select = $('#articulo');
var bolsa_pventa = $('#bolsa_pventa');
var abolsa_descripArt = $('#abolsa_descripArt');
var add_bolsa = $('#add_bolsa');

var total_venta_bolsa = $('#bolsa_total');
var tabla_bolsa = $('#tabla_bolsa');

var total_bolsa = 0;
var tcontador_bolsa = 0;
var subtotal_bolsa = Array;
bolsa_select.change(mostrarvalores_bolsa);

function mostrarvalores_bolsa() {
    datos_bolsa = document.getElementById('articulo').value.split('__');
    bolsa_pventa.val(datos_bolsa[2]);
    abolsa_descripArt.html(datos_bolsa[3]);
}

add_bolsa.click(function() {
    agregar_bolsa();
})



function agregar_bolsa() {
    datos_bolsa = document.getElementById('articulo').value.split('__');
    var bolsa_id_table = datos_bolsa[0];
    var bolsa_pventa_table = parseFloat($('#bolsa_pventa').val());
    var existencia_bolsa = parseInt(datos_bolsa[1]);
    var cantidad_bolsa = parseInt($('#bolsa_cantidad').val());
    var bolsa_texto = $('#articulo option:selected').text();
    var descuento_bolsa = parseFloat($('#bolsa_descuento').val());
    var new_descuento_bolsa = 0;
    if (descuento_bolsa > 0) {
        new_descuento_bolsa = descuento_bolsa * cantidad_bolsa;
    }

    if (bolsa_id_table != "" && bolsa_pventa_table != ""  && cantidad_bolsa != "") {


        subtotal_bolsa[tcontador_bolsa] = (cantidad_bolsa * bolsa_pventa_table) - new_descuento_bolsa;
        total_bolsa = total_bolsa + subtotal_bolsa[tcontador_bolsa];

        var fila = '<tr class="selected" id="fila' + tcontador_bolsa + '">' +
            '<td><a class="btn btn-danger btn-sm text-white" onclick="eliminar_fila_bolsa(' + tcontador_bolsa + ')"> <i class="fa fa-trash" aria-hidden="true"></i> </a></td>' +

            '<td><input type="hidden" name="id_bolsas[]" value="' + bolsa_id_table + '">' + bolsa_texto + '</td>' +

            '<td class="d-none" ><input type="number" class="form-control"  name="bolsa_pventa_table[]" value="' + bolsa_pventa_table + '" readonly></td> ' +

            '<td class="d-none"><input type="number" class="form-control"  name="" value="' + new_descuento_bolsa + '" readonly ></td> ' +

            '<td ><input type="hidden" class="form-control invisible"  name="cantidad_bolsa[]" value="' + cantidad_bolsa + '" readonly> ' + cantidad_bolsa + ' </td> ' +

            '<td class="d-none" > <input type="hidden" name="" value="' + subtotal_bolsa[tcontador_bolsa] + '">' + subtotal_bolsa[tcontador_bolsa] + '</td>' +

            '</tr>';
        tcontador_bolsa++;
        limpiar();


        // total_venta_bolsa.html('<label>Total a Cancelar</label><input type="number" id="totvent_bolsa" name="totalventa_bolsa" class="form-control" value="' + total_bolsa + '" readonly >');

        tabla_bolsa.append(fila);



    } else {
        alert('UNO O MAS CAMPOS SON REQUERIDOS');
    }
}

function eliminar_fila_bolsa(index) {
    total_bolsa = total_bolsa - subtotal_bolsa[index];

    total_venta_bolsa.html('<input type="number" name="totalventa" class="form-control" value="' + total_bolsa + '" readonly >');
    $('#fila' + index).remove();
}

function limpiar() {

    let bolsa = $('#bolsa_id').select(0);
    let pventa = $('#bolsa_pventa').val('');
    let cantidad = $('#bolsa_cantidad').val('1');
    var descuento = $('#bolsa_descuento').val('');
    var tventa = $('#bolsa_total').val('');
    let abolsa_descripArt = $('#abolsa_descripArt').val('');
    bolsa.focus();
}