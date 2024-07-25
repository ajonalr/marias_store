@extends('layouts.admin')

@section('template_title')
    Update Proyecto
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card">
                    <div class="card-header">
                        <span class="card-title">ACTUALIZAR DATOS DE PROYECTO</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('proyectos.update', $data->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.proyecto.formedit')

                            <div class="text-center">
                                <button type="submit" class="btn btn-warning"><i class="fa fa-refresh" aria-hidden="true"></i> Actualizar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
