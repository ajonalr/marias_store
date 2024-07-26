<div class="row">
    <div class="col-md-5">
        Articulo
        <input type="text" id="producto"  class="form-control" placeholder="PRODUCTO A BUSCAR">
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
        <input type="number" class="form-control" value="1" id="cantidadg" style="">
    </div>
</div>

@include('admin.ventas.import.datosdescrip')


<!-- aca se pinta el resultado de la busqueda / articulo -->
<div class="row scrolling-wrapper overflow-auto" id="result">

</div>
<button type="button" onclick="buscar('si')" class="btn  btn-sm btn-flotante2 mt-2">
    <i class="fa fa-search" aria-hidden="true"></i>
</button>
<button type="button" onclick="addToTable()" class="btn  btn-sm btn-flotante mt-2">
    <i class="fa fa-cart-plus" aria-hidden="true"></i>
</button>