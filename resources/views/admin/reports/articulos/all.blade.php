@extends('layouts.app')

@section('styles')
<style>
    body {
        font-size: 12px;
    }
</style>    
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h4 class="card-title text-center display-4">Articulos Registrados</h4>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover" id="table_id" data-page-length="15">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion </th>
                                <th>Categoria</th>
                                <th>Precio Venta</th>
                                <th>Precio Costo</th>
                                <th>Utilidad</th>
                                <th>Stock</th>
                                <th>Stock_Maximo</th>
                                <th>Estante</th>
                                <th>Sub-estante</th>
                                <th>Proveedor</th>
                                <th>Registro</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $pventaTotal = 0;
                            $pcostoTotal = 0 ?>
                            @foreach($articulos as $art)
                            <tr>

                                <?php
                                $pventaTotal = $pventaTotal + ($art->p_venta * $art->stock);
                                $pcostoTotal = $pcostoTotal + ($art->p_costo * $art->stock);

                                ?>
                                <td>{{$art->nombre}}</td>
                                <td><?php echo $art->descripcion ?></td>
                                <td>{{$art->nomCat}}</td>
                                <td>Q. {{number_format($art->p_venta, 2)}}</td>
                                <td>Q. {{number_format($art->p_costo, 2)}}</td>
                                <td>Q.{{number_format($art->p_venta - $art->p_costo, 2)}}</td>
                                <td>{{$art->stock}}</td>
                                <td>{{$art->stock_maximo}}</td>
                                <td>{{$art->unidad}}</td>
                                <td>{{$art->ubicacion}}</td>
                                <td>{{$art->p_nombre}}, {{$art->p_empresa}}</td>
                                <td>{{$art->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-right mx-4">
                        <h2>Total de Tipos de Articulos: Q. {{number_format($total, 2)}}</h2>
                        <h2>Total de Precio Venta: Q. {{number_format($pventaTotal, 2)}}</h2>
                        <h2>Total de Precio Costo: Q. {{number_format($pcostoTotal, 2)}}</h2>
                        <h2>Total de Utilidad: Q. {{number_format($pventaTotal - $pcostoTotal, 2)}}</h2>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>

@endsection