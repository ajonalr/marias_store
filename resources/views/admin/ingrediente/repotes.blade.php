@extends('layouts.admin')

@section('content')

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">INGREDIENTES</h4>
                <p class="card-text">RETORNA EL REPORTE DE INGREDIENTES</p>
                <a class="btn btn-primary" href="{{route('ingrediente.report_allIngredient')}}"><i class="fa fa-print" aria-hidden="true"></i></a>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">HISTORIAL DE COMPRAS</h4>
                <p class="card-text">RETORNA EL HITORIAL DE COMPRAS (ACA REALIZAMOS ELIMINACIONES)</p>
                <form class="" method="GET" action="{{route('ingrediente.reporte_hitorial')}}">
                    <div class="form-group">
                        <label for="">INICIO: </label>
                        <input type="date" name="inicio" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">FIN: </label>
                        <input type="date" name="fin" class="form-control">
                    </div>
                    <div class="text-right mt-2">
                        <button type="submit" class="btn btn-info ml-4"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection