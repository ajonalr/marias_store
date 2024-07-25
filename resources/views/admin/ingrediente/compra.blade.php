@extends('layouts.admin')


@section('content')
<div class="container-fluid mb-5">
    <div class="row">
        <div class="col">
            <div class="card p-4 mb-5">
                <h4 class="card-title text-uppercase">comprar articuloooos</h4>

                <div class="row">
                    <div class="col">
                        <form action="{{route('ingrediente.compra_store')}}" method="post">
                            @csrf
                            <!-- articulos -->
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <p>Articulos</p>
                                    <select class="form-control" name="articulo" id="articulo" autofocus>
                                        <option value="">Seleccione Ingrediente</option>
                                        @foreach($ingredientes as $art)
                                        <option value="{{$art->id}}__{{$art->stock}}__{{$art->p_venta}}__{{$art->descripcion}}">{{$art->nombre}} <?php echo $art->descripcion; ?> --{{$art->nomCat}}--, Stock: {{$art->stock}}, {{$art->cod_barras}} </option>
                                        @endforeach
                                    </select>
                                    <br>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="">NUMERO DE FACTURA</label>
                                    <input type="text" class="form-control" name="descripcion" required>
                                </div>



                                <div class="col-md-2">
                                    <div class="col">
                                        TOTAL DE FACTURA
                                        <input type="number" step="any" class="form-control" name="total" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="col">
                                        Cantidad a Comprar
                                        <input type="number" class="form-control" name="" value="1" id="bolsa_cantidad">
                                    </div>
                                </div>

                                <div class="">
                                    <button type="button" id="add_bolsa" class="btn btn-outline-primary float-right" style="border-radius: 25px;"> <i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                                </div>


                            </div>
                            <!-- end articulos -->

                            <div class="row d-none">
                                <div class="col">
                                    <div class="form-group row mx-3">
                                        <div class="row">

                                            <div class="col d-none">
                                                Precio
                                                <input type="text" class="form-control " placeholder="Precio Venta" disabled name="" id="bolsa_pventa">

                                            </div>
                                            <div class="col d-none">
                                                Descuento
                                                <input type="number" class="form-control " placeholder="Descuento" id="bolsa_descuento">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-4 d-none">
                                <div class="col">
                                    <label for="" id="abolsa_descripArt"></label>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col table-responsive">
                                    <table class="table table-hover table-sm" id="tabla_bolsa">
                                        <thead class="">
                                            <tr>
                                                <th></th>
                                                <th>Articulo</th>
                                                <th class="d-none">Precio Venta</th>
                                                <th class="d-none">Descuento</th>
                                                <th>Cantidad</th>
                                                <th class="d-none">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div <div class="row">
                            <label id="bolsa_total"> </label>
                            <br>
                            <label id="bolsa_descuento"> </label>


                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> GUARDAR</button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection


@section('styles')
<link rel="stylesheet" href="{{asset('plugins/slim-select/slimselect.min.css') }}">
@endsection
@section('scripts')
<script src="{{asset('plugins/bootstrap/jquery.min.js')}}"></script>
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

        if (bolsa_id_table != "" && bolsa_pventa_table != "" && cantidad_bolsa != "") {


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
</script>

@endsection