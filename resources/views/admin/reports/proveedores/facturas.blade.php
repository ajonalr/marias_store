@extends('layouts.app')

@section('content')
<div class="container-fuild p-5">
   <div class="row">
      <div class="col">
         <h4 class="card-title text-center h1">COMPRAS REALIZADAS</h4>
         <div class="card">
            <div class="card-body">
               <table class="table table-hover" id="table_id" data-page-length="15">
                  <thead>
                     <tr>
                        <th># </th>
                        <th>Proveedor</th>
                        <th>Factura</th>
                        <th>Fecha de Compra</th>
                        <th>Estado</th>
                        <th>Descripcion</th>
                        <th>Valor</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($fac as $f)
                     <tr>
                        <td>{{$f->id}}</td>
                        <td>{{$f->proveedor->nombre}}</td>
                        <td>{{$f->factura}}</td>
                        <td>{{$f->fecha_compra}}</td>
                        <td>{{$f->estado}}</td>
                        <td><?php echo $f->description; ?></td>
                        <td>Q. {{number_format($f->valor, 2)}}</td>
                        <td>
                           <a class="btn btn-primary" href="{{route('prove.show', ['id' => $f->proveedor_id])}}">
                              <i class="fa fa-eye" aria-hidden="true"></i>
                           </a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection