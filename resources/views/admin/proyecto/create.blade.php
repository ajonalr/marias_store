@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/slim-select/slimselect.min.css')}}">
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <span class="card-title">Create Proyecto</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('proyectos.store') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        @include('admin.proyecto.form')

                        <div class="text-center">
                            <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> GUARDAR</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')

<script src="{{asset('plugins/slim-select/slimselect.min.js')}}"></script>

<script>
    new SlimSelect({
        select: '#cliente_id'
    });
</script>

@endsection