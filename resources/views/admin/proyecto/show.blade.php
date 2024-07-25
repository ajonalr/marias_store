@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}">
@endsection



@section('content')

<div class="container-fluid mb-5">
    <div class="row mb-5">
        <div class="col mb-5">
            <div class="card p-4 mb-5">
                <h4 class="card-title text-uppercase text-center">{{$proyecto->nombre}} </h4><br>

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">datos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="pills-deuda-tab" data-toggle="pill" href="#pills-deuda" role="tab" aria-controls="pills-deuda" aria-selected="false">Historial de Abonos</a>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade" id="pills-deuda" role="tabpanel" aria-labelledby="pills-deuda-tab">
                        <div class="d-flex justify-content-around">
                            <div>
                                ABONOS
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modelId">
                                    ABONAR
                                </button>
                            </div>
                        </div>
                        @include('admin.proyecto.components.abonos')
                    </div>



                    <div class="tab-pane fade show active text-center" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        @include('admin.proyecto.components.data')
                    </div>
    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection