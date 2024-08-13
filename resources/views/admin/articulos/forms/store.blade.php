<div class="row">
    <div class="col-md-5">
        <label for="inputEmail4">Nombre:</label>
        <input type="text" class="form-control" name="nombre"
            value="@isset($articulo->nombre){{ $articulo->nombre }}@endisset" required>
    </div>

    <div class="col-md-7 ">
        <label for="">Codigo de Barras</label>
        <input type="text" class="form-control" name="cod_barras"
            value="@isset($articulo->cod_barras){{ $articulo->cod_barras }}@endisset">
    </div>

</div>

<div class="row justify-content-center ">

    <div class="col-md-5">
        <label for="inputEmail4">Talla:</label>
        <select class="form-control" name="fabricante">
            @isset($articulo->fabricante)
                <option value="{{ $articulo->fabricante }}"> {{ $articulo->fabricante }}</option>
            @endisset

            <optgroup label="Tallas">
                <option value="">SELECCIONE UNA TALLA</option>
                <option value="NO APLICA">NO APLICA</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
            </optgroup>
            <optgroup label="Tallas Para Ninos">
                <option value="0-1 mes">0-1 mes</option>
                <option value="3-6 meses">3-6 meses</option>
                <option value="6-9meses">6-9meses</option>
                <option value="9-12meses">9-12meses</option>
                <option value="12-18meses">12-18meses</option>
                <option value="18-24meses">18-24meses</option>
                <option value="2-3años">2-3años</option>
                <option value="3 años">3 años</option>
                <option value="4años">4años</option>
                <option value="5años">5años</option>
                <option value="6años">6años</option>
                <option value="7años">7años</option>
                <option value="8años">8años</option>
                <option value="9años">9años</option>
                <option value="10años">10años</option>
                <option value="11años">11años</option>
                <option value="12años">12años</option>
                <option value="13años">13años</option>
                <option value="14años">14años</option>
            </optgroup>
        </select>
    </div>

    <div class="col-md-5">
        <label for="inputEmail4">URL de Compra:</label>
        <input type="text" class="form-control" name="medida"
            value="@isset($articulo->medida){{ $articulo->medida }}@endisset">
    </div>


    <div class="col-md-2 d-none">
        <label for="inputEmail4">Estanteria:</label>
        <input type="text" class="form-control" name="unidad"
            value="@isset($articulo->unidad){{ $articulo->unidad }}@endisset">
    </div>
    <div class="col-md-2 d-none">
        <label for="inputEmail4">Sub-estanteria:</label>
        <input type="text" class="form-control" name="ubicacion"
            value="@isset($articulo->ubicacion){{ $articulo->ubicacion }}@endisset">
    </div>
</div>

<hr>
<div class="row justify-content-center">
    <div class="col-md-2">
        <label for="">Precio Venta:</label>
        <input type="number" class="form-control" required name="p_venta" step="any"
            value="@isset($articulo->p_venta){{ $articulo->p_venta }}@endisset">
    </div>

    <div class="col-md-2">
        <label for="">Precio Costo:</label>
        <input type="number" class="form-control" required name="p_costo" step="any"
            value="@isset($articulo->p_costo){{ $articulo->p_costo }}@endisset">
    </div>

    <div class="col-md-2">
        <label for="">Cantidad / Stock: </label>
        <input type="number" class="form-control" name="stock" id="stock1" step="any"
            value="@isset($articulo->stock){{ $articulo->stock }}@endisset">
    </div>

    <div class="col-md-2">
        <label for="">Minimo de Stock:</label>
        <input type="number" class="form-control text-uppercase" name="min_stock"
            value="@isset($articulo->min_stock){{ $articulo->min_stock }}@endisset" value="0">
    </div>

    <div class="col-md-2">
        <label for="">Maximo de Stock:</label>
        <input type="number" class="form-control text-uppercase" name="stock_maximo"
            value="@isset($articulo->stock_maximo){{ $articulo->stock_maximo }}@endisset" value="0">
    </div>

</div>

<!-- <hr> -->
<div class="d-flex justify-content-center ">

    <div class="table-responsive col-md-8 d-none">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>MINIMO</th>
                    <th>MAXIMO</th>
                    <th>PRECIO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> <input value="@isset($articulo->minimo1){{ $articulo->minimo1 }}@endisset"
                            type="number" step="any" name="minimo1" placeholder="minimo1"
                            class="form-control">
                    </td>

                    <td> <input value="@isset($articulo->maximo1){{ $articulo->maximo1 }}@endisset"
                            type="number" step="any" name="maximo1" placeholder="maximo1"
                            class="form-control">
                    </td>

                    <td> <input value="@isset($articulo->precio1){{ $articulo->precio1 }}@endisset"
                            type="number" step="any" name="precio1" placeholder="precio1"
                            class="form-control">
                    </td>
                </tr>
                <tr>
                    <td> <input value="@isset($articulo->minimo2){{ $articulo->minimo2 }}@endisset"
                            type="number" step="any" name="minimo2" placeholder="minimo2"
                            class="form-control"></td>

                    <td> <input value="@isset($articulo->maximo2){{ $articulo->maximo2 }}@endisset"
                            type="number" step="any" name="maximo2" placeholder="maximo2"
                            class="form-control"></td>

                    <td> <input value="@isset($articulo->precio2){{ $articulo->precio2 }}@endisset"
                            type="number" step="any" name="precio2" placeholder="precio2"
                            class="form-control"></td>
                </tr>
                <tr>
                    <td> <input value="@isset($articulo->minimo3){{ $articulo->minimo3 }}@endisset"
                            type="number" step="any" name="minimo3" placeholder="minimo3"
                            class="form-control"></td>

                    <td> <input value="@isset($articulo->maximo3){{ $articulo->maximo3 }}@endisset"
                            type="number" step="any" name="maximo3" placeholder="maximo3"
                            class="form-control"></td>

                    <td> <input value="@isset($articulo->precio3){{ $articulo->precio3 }}@endisset"
                            type="number" step="any" name="precio3" placeholder="precio3"
                            class="form-control"></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<!-- <hr> -->




<div class="row justify-content-center d-none">
    <hr>
    <div class="col">
        <label for="inputEmail4">Etiqueta Equivalente:</label>
        <input type="text" class="form-control" name="eti_equivalente"
            value="@isset($articulo->eti_equivalente){{ $articulo->eti_equivalente }}@endisset">
    </div>
    <div class="col">
        <label for="inputEmail4">Etiqueta de Carro:</label>
        <input type="text" class="form-control" name="eti_carro"
            value="@isset($articulo->eti_carro){{ $articulo->eti_carro }}@endisset">
    </div>
</div>


<hr>

<div class="row justify-content-center">

    <div class="col-md-5">
        <label for="">Categoria / Tipo de Venta</label>
        <select class="form-control" name="categoria_id" required>
            <option value="@isset($articulo->categoria_id){{ $articulo->categoria_id }}@endisset">
                @if (isset($articulo->categoria_id))
                    {{ $articulo->nomCat }} / {{ $articulo->tipo }}
                @else
                    Seleccione Categoria
                @endif
            </option>
            @foreach ($categoria as $cat)
                <option value="{{ $cat->id }}">{{ $cat->nombre }} </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-5">
        <label for="">Proveedor</label>
        <select class="form-control" name="proveedor_id" required id="proveedor_id">
            @if (isset($articulo->proveId))
                <option value="@isset($articulo->proveId){{ $articulo->proveId }}@endisset">
                    {{ $articulo->provName }} / {{ $articulo->telefono1 }}
                @else
                    Seleccione Proveedor
                </option>
            @endif
            @foreach ($proveedor as $pro)
                <option value="{{ $pro->id }}">{{ $pro->nombre }} / {{ $pro->telefono1 }}</option>
            @endforeach
        </select>
    </div>

</div>

<hr>


<div class="row justify-content-center">
    <div class="col-md-4">

        <div class="form-group">
            <label for="img">Imagen</label>
            <input type="file" class="form-control-file" name="img" id="img" placeholder=""
                aria-describedby="fileHelpId" accept="image/*">
            <small id="fileHelpId" class="form-text text-muted">Ingrese Foto</small>
        </div>

    </div>
    <div class="col-md-4">
        <div class="">
            <label for="">Imagen Secundaria</label>
            <input type="text" class="form-control" name="img2"
                value="@isset($articulo->img2){{ $articulo->img2 }}@endisset">
        </div>
    </div>

</div>


<div class="row">

    <div class="form-group col-6">
        <label for="">Descripcion:</label>
        <textarea class="form-control" name="descripcion" id="editor1" rows="10">
@if (isset($articulo->descripcion))
{{ $articulo->descripcion }}
@endif
</textarea>
    </div>

    <div class="form-group col-6">
        <label for="">Descripcion Interna:</label>
        <textarea class="form-control" id="editor2"
            placeholder="Colocamos Descuentos,  O informacion Util para el futuro esto no se vera en el recibo"
            name="descripcion_interna" rows="10">
@if (isset($articulo->descripcion_interna))
{{ $articulo->descripcion_interna }}
@endif
</textarea>
    </div>

</div>
