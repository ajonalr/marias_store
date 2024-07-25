<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputEmail4">Nombre</label>
        <input type="text" class="form-control" name="nombre" value="@isset($categoria->nombre){{ $categoria->nombre }}@endisset" required>
    </div>

    <div class="form-group col-md-6">
        <label for="inputPassword4">Imagen</label>
        <input type="text" class="form-control" name="tipo" required value="@isset($categoria->tipo){{ $categoria->tipo }}@endisset">
    </div>
</div>

