<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputEmail4">Nombre</label>
        <input type="text" class="form-control" name="nombre" value="@isset($cliente->nombre){{ $cliente->nombre }}@endisset" required>
    </div>

    <div class="form-group col-md-6">
        <label for="inputPassword4">Nit</label>
        <input type="text" class="form-control" name="nit" value="@isset($cliente->nit){{ $cliente->nit }}@endisset">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-3">
        <label for="inputCity">Telefono 1:</label>
        <input type="number" class="form-control"name="telefono1" step="any" value="@isset($cliente->telefono1){{ $cliente->telefono1 }}@endisset">
    </div>
    <div class="form-group col-md-3">
        <label for="inputState">Telefono 2</label>
        <input type="number" class="form-control" name="telefono2" step="any" value="@isset($cliente->telefono2){{ $cliente->telefono2 }}@endisset">
    </div>
    <div class="form-group col-md-6">
        <label for="inputZip">Direccion</label>
        <input type="text" class="form-control" required name="direccion" min="1" value="@isset($cliente->direccion){{ $cliente->direccion }}@endisset">
    </div>
</div>

