@extends('layouts.admin')



@section('content')
<div class="container-fluid mb-4">
    <div class="row">

        @foreach($articulos as $art)
        @if ($art->stock < $art->min_stock)
            <div class="col-md-4">
                <aside class="profile-nav alt">
                    <section class="card">
                        <div class="card-header user-header alt bg-dark">
                            <div class="media">
                                <a href="#">
                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{$art->img}}">
                                </a>
                                <div class="media-body">
                                    <h2 class="text-light display-6">{{$art->nombre}}</h2>
                                    <p class="text-light">{{$art->descripcion}}</p>
                                </div>
                            </div>
                        </div>


                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="#">
                                    <i class="fa fa-dollar-sign    "></i> Precio Venta &nbsp;
                                    <span class="badge bg-primary pull-right">Q. {{number_format($art->p_venta, 2)}}</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">
                                    <i class="fa fa-tasks"></i> Stock &nbsp;&nbsp;
                                    <span class="badge bg-danger pull-right"> {{$art->stock}}</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">
                                    <i class="fa fa-barcode" aria-hidden="true"></i> Codigo Barras
                                    <span class="badge bg-success pull-right mx-3">{{$art->cod_barras}}</span>
                                </a>
                            </li>

                        </ul>

                        @can('articulos_show')
                        <div class="card-footer text-muted">
                            <a target="_blank" href="{{route('articulo.show', ['id' => $art->id])}}" class="btn btn-sm btn-info"> <i class="fa fa-link "></i> Ir A Articulo</a>
                        </div>
                        @endcan



                    </section>
                </aside>
            </div>

            @endif
            @endforeach

    </div>
</div>

@endsection