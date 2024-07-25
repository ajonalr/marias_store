<form action="{{route('venta.store')}}" method="post" autocomplete="off">
    @csrf
    <div class="card scrolling-wrapper-table">
        <div class="table-hover p-2">
            <table class="table table-hover table-sm " id="tabla_venta">
                <thead>
                    <tr>
                        <th></th>
                        <th>ARTICULO</th>
                        <th>P. VENTA</th>
                        <th>DES.</th>
                        <th class="">CANT</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <label for="" class="mt-md-3">TOTAL A CANCELAR: Q.</label>
    <label id="total"> </label>

    <div class="form-inline">
        <div class="form-group mb-2">
            <label for="">CANCELA: </label>
            <input type="number" onkeyup="cambio_fun()" id="cancela" step="any" class="form-control ml-2">
        </div>
    </div>

    <label for="" id="cambio"></label>


    <div class="row">
        <div class="col-md-6">
            <p>
                <a class="btn btn-info btn-sm" data-toggle="collapse" href="#VENTASeSPECIALES" aria-expanded="false" aria-controls="VENTASeSPECIALES">
                    VENTAS ESPECIALES
                </a>
            </p>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" name="mesa" placeholder="NUMERO DE MESA">
            </div>
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


    <button type="submit" class="btn btn-success btn-block mt-2" id="bt_submit" onclick="return confirm('¿ESTA SEGURO DE GUARDAR VENTA?')">REGISTRAR</button>




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