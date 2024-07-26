@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h4 class="card-title text-center display-4"><img src="{{asset('assets/images/logo.png')}}" class="img-fluid" alt="{{config('app.name', 'LIBRERIA ELY') }}"> <br>Articulos Registrados con Poca Existencia</h4>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion </th>
                                <th>Categoria</th>
                                <th>Precio Venta</th>
                                <th>Precio Costo</th>
                                <th>Stock</th>
                                <th>Stock_Maximo</th>

                                <th>Proveedor</th>
                                <th>Sub-estante</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articulos as $art)
                            @if ($art->stock < $art->min_stock)
                                <?php $total++ ?>
                                <tr>
                                    <td>{{$art->nombre}} - {{$art->fabricante}}</td>

                                    <td><?php echo $art->descripcion ?></td>
                                    <td>{{$art->nomCat}}</td>
                                    <td>Q.{{number_format($art->p_venta, 2)}}</td>
                                    <td>Q.{{number_format($art->p_costo, 2)}}</td>
                                    <td>{{$art->stock}}</td>
                                    <td>{{$art->stock_maximo}}</td>

                                    <td>{{$art->proveedor->nombre}}, {{$art->proveedor->nombre}}</td>

                                    <td>{{$art->ubicacion}}</td>
                                </tr>
                                @endif
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