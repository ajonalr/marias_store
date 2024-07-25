@extends('layouts.admin')

@section('content')
<div class="container-fluid mb-5">
    <div class="row">
        <div class="col">
            <div class="card p-4 mb-5">

                <h4 class="card-title text-uppercase">{{$categoria->nombre}} </h4>

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active text-capitalize" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">datos de categoria</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Actualizar</a>
                    </li>


                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active text-center" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                        <h4> Categoria / {{$categoria->nombre}}</h4>

                        <div class="card p-3">
                            <div class="center">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Nombre:{{$categoria->nombre}}</h5>
                                

                                <img style="width: 50vh;" class="img-fluid img-thumbnail rounded" src="{{$categoria->tipo}}" alt="" srcset="">
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <h4>Actualizar Categoria</h4>


                        <form action="{{route('categoria.update', ['id' => $categoria->id])}}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('admin/categorias/components/form')

                            <button type="submit" class="btn btn-success btn-block"> <i class="fa fa-save"></i> Actualizar</button>
                        </form>


                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection