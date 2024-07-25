@extends('layouts.admin')

@section('content')
<div class="container-fluid mb-5">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card p-4">

                <h4 class="card-title text-uppercase">nuevo cliente</h4><br>

               
                <form action="{{route('cliente.store')}}" method="post" autocomplete="off">
                    @csrf
                    @include('admin/clientes/components/form')

                    <button type="submit" name="" id="" class="btn btn-info mt-2 btn-lg btn-block"> <i class="fa fa-save"></i> Registrar</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

@endsection