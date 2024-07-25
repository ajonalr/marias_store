@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h4 class="card-title text-center display-4"><img src="{{asset('assets/images/logo.png')}}" class="img-fluid" alt="{{config('app.name', 'LIBRERIA ELY') }}"> <br>Control de Articulos <?php echo date('d-M-Y') ?></h4>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover" id="table_id" data-page-length="15">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion </th>
                                <th>Categoria</th>
                                <th>Precio Venta</th>
                                <th>Stock</th>
                                <th>Stock_Maximo</th>
                                <th>Fabricante</th>
                                <th>Proveedor</th>
                                <th>Sub-estante</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articulos as $art)
                            <tr>
                                <td>{{$art->nombre}}</td>
                                <td><?php echo $art->descripcion ?></td>
                                <td>{{$art->nomCat}}</td>
                                <td>Q. {{number_format($art->p_venta, 2)}}</td>
                                <td>{{$art->stock}}</td>
                                <td>{{$art->stock_maximo}}</td>
                                <td>{{$art->fabricante}}</td>
                                <td>{{$art->p_nombre}}, {{$art->p_empresa}}</td>
                                <td>{{$art->ubicacion}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-right mx-4">
                        <h2>Total de Articulos: {{$total}}</h2>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection