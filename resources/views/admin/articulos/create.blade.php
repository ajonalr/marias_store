@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/slim-select/slimselect.min.css')}}">
@endsection

@section('content')

<div class="container mb-5">

    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row d-flex align-items-stretch">
                <div class="col">

                    <h4 class="card-title text-uppercase text-center display-4">nuevo menu</h4>

                    <form action="{{route('articulo.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @include('admin.articulos.forms.store')

                        <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save    "></i> Registrar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="{{ asset('plugins/ckeditor/ckeditor.js')  }}"></script>
<script>
    // CKEDITOR.replace('editor1', {
    //     uiColor: '#ee5742',
    // });
    // CKEDITOR.replace('editor2', {
    //     uiColor: '#f8bcb2',
    // });
</script>




<script src="{{asset('plugins/slim-select/slimselect.min.js')}}"></script>

<script>
    new SlimSelect({
        select: '#proveedor_id'
    });
</script>


<script>
    function cambio() {

        let stock1 = document.querySelector('#stock1');
        let stock2 = document.querySelector('#stock2');
        const button = document.querySelector('#btn1')

        if (stock2.value > 0) {
            stock1.value--;
            button.disabled = true

        }

    }
</script>

@endsection