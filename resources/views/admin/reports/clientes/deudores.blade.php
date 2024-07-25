@extends('layouts.app')

@section('content')
<div class="container-fluid mb-5">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Deudores</h4><br>
                    <table class="table table-hover" id="table_id" data-page-length="15">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Telefono 1</th>
                                <th>Telefono 2</th>
                                <th>Deuda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $t = 0; ?>
                            @foreach($deudores as $deu)
                            <?php $t += $deu->deuda; ?>
                            <tr>
                                <td>{{$deu->nombre}}</td>
                                <td>{{$deu->direccion}}</td>
                                <td>{{$deu->telefono1}}</td>
                                <td>{{$deu->telefono2}}</td>
                                <td>Q. <b>{{number_format($deu->deuda, 2)}}</b></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="h2 text-center">Q. {{number_format($t, 2)}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection