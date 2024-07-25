@extends('layouts.admin')


@section('content')
<div class="container-fluid mb-4">
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-sm-between">
                <h3 class="card-title">FILTRAR COMPRAS</h3>



                <form class="form-inline mb-5" method="GET" action="{{route('articulo.comprarHisto')}}">
                    <div class="form-group">
                        <label for="">INICIO: </label>
                        <input type="date" name="inicio" class="form-control">
                    </div>
                    <div class="form-group ml-4">
                        <label for="">FIN: </label>
                        <input type="date" name="fin" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-info ml-4"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>

                @can('articulos_compra_store')
                <div class=""><a class="btn btn-primary" href="{{route('articulo.comprar')}}"> <i class="fa fa-plus" aria-hidden="true"></i> Registrar Compra</a></div>
                @endcan

            </div>

            @if ($show)
            <div class="row">
                @foreach($articlos as $art)
                <div class="col-md-3 ">
                    <div class="card">

                        @if ($art->img)

                        <img class="card-img img-fluid" src="{{$art->img}}" alt="{{$art->nombre}}" alt="{{config('app.name', 'DeCoDev ') }}" style=" width: 25vh;">
                        @else
                        <img class="card-img img-fluid" src="https://ui-avatars.com/api/?name={{$art->nombre}}" alt="{{$art->nombre}}" alt="{{config('app.name', 'DeCoDev ') }}" style=" width: 25vh;">
                        @endif


                        @can('articulos_hitorial_delete')
                        <div class="card-img-overlay">
                            <a class="btn btn-danger btn-circle btn-xl" href="{{route('articulo.compradelete', ['id' => $art->idCom, 'idArt' => $art->id])}}" role="button" onclick="return confirm('Esta Seguro de Eliminar?')"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                        </div>
                        @endcan

                        <div class="card-body">
                            <h4 class="card-title">{{$art->nombre}}</h4>

                            <p class="card-text">Descripcion: <?php echo $art->descripcion ?> <br> Numero de Factura: {{$art->factura}}</p>
                            <p>Ingreso: {{$art->name}}</p>
                            <a href="#" class="btn btn-info">Cantidad Comprado: <span class="badge badge-success" style="background-color: #007bff;"> {{$art->cantidad}}</span></a>
                        </div>
                        <div class="card-footer text-muted d-flex justify-content-between bg-transparent  ">
                            <div class="views">Fecha de Compra: {{$art->fecha}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</div>







@endsection