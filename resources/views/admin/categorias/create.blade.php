@extends('layouts.admin')

@section('content')
<div class="container-fluid mb-5">
    <div class="row">
        <div class="col mb-5">
            <div class="card p-4 mb-5">

                <h4 class="card-title text-uppercase">nuevo tipo de venta</h4>

                <form action="{{route('categoria.store')}}" method="post" autocomplete="off">
                    @csrf
                    @include('admin/categorias/components/form')
                    <button type="submit" name="" id="" class="btn btn-info mt-2 btn-lg btn-block"> <i class="fa fa-save"></i> Registrar</button>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection