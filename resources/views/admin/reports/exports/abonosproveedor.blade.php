@extends('layouts.app')
@section('styles')

<style>
   @media print {

      .oculto-impresion,
      .oculto-impresion * {
         display: none !important;
      }
   }
</style>

@endsection

@section('content')

<div class="container-fluid">

   <div class="row">

      <div class="col-md-9">
         <h3>Listado de Abonos</h3>

         <div class="table-responsive">
            <table class="table table-hover">
               <thead class="thead-inverse">
                  <tr>
                     <th>VALOR</th>
                     <th>TIPO</th>
                     <th>FECHA COBRO DE CHEQUE</th>
                     <th>DESCRIPCION</th>
                     <th>REGISTRO DE ABONO</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($data as $d )
                  <tr>
                     <td>Q. {{number_format($d->valor, 2)}}</td>
                     <td>{{$d->tipo}}</td>
                     <td>{{$d->fecha_cobro}}</td>
                     <td>{{$d->descripcion}}</td>
                     <td>{{$d->created_at}}</td>
                     <td>
                        <a class="btn btn-danger" href="{{route('prove.deleteAbono', ['id' => $d->id])}}" role="button" onclick="return confirm('Esta Seguro de Eliminar?')"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>

            <h4>Total Abonado: Q. {{number_format($abonado, 2)}}</h4>
         </div>

      </div>

      <div class="col-md-3 oculto-impresion">
         <div class="card">

            <div class="card-body">
               <h3>Abonar</h3>
               <form method="post" class="mb-4" action="{{route('prove.abonar')}}">
                  @csrf()

                  <input type="hidden" name="proveedor_id" value="{{$id}}">

                  <div class="form-group">
                     <label for="">Valor a Abonar</label>
                     <input type="text" class="form-control" name="valor" placeholder="VALOR DEL ABONO">
                  </div>

                  <div class="form-group">
                     <label for="">Tipo de Abono</label>
                     <select class="form-control" name="tipo">
                        <option value="EFECTIVO">EFECTIVO</option>
                        <option value="DEPOSITO">DEPOSITO</option>
                        <option value="CHEQUE">CHEQUE</option>
                     </select>
                  </div>

                  <div class="form-group">
                     <label for="">Fecha de Cobro de Cheque</label>
                     <input type="date" class="form-control" name="fecha_cobro">
                  </div>


                  <div class="form-group">
                     <label for="">Descripcion de Abono</label>
                     <textarea class="form-control" name="descripcion" id="" rows="3" placeholder="DESCRIPCION DE ABONO"></textarea>
                  </div>

                  <button type="submit" class="btn btn-primary mt-3"> ABONAR </button>

               </form>

               <h4>Total de Deuda: <br> Q. {{number_format($deuda, 2)}}</h4>

            </div>
         </div>
      </div>

   </div>
</div>

@endsection