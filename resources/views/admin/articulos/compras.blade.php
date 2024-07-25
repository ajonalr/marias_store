@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/slim-select/slimselect.min.css') }}">
@endsection


@section('content')
<div class="container-fluid mb-5">
    <div class="row">
        <div class="col">
            <div class="card p-4 mb-5">
                <h4 class="card-title text-uppercase">comprar articuloooos</h4>

                <!-- include('admin.articulos.components.compraPeove') -->



                @include('admin.articulos.components.articulos')



            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
<script src="{{asset('plugins/bootstrap/jquery.min.js')}}"></script>

<script src="{{asset('compras/articulos.js')}}"></script>

<script src="{{asset('plugins/slim-select/slimselect.min.js') }}"></script>
<script>
    setTimeout(function() {
        new SlimSelect({
            select: '#articulo',
            placeholder: 'Select Permissions',
            deselectLabel: '<span>&times;</span>',
            hideSelectedOption: true,
        })
    }, 300);
</script>

@endsection