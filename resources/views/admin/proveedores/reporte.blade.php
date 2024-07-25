@extends('layouts.admin')


@section('content')

<div class="container-fluid">
   <div class="row">
      <div class="col-md-4">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">PROVEEDORES</h4>
               <p class="card-text">Retorna el Reporte de todos lo Proveedores Registrados, obteniendo, Nombre, Direccion , Empresa y demas datos NO sensibles. </p>
               <a class="btn btn-primary" target="_blank" href="{{route('prove.reporte')}}"><i class="fa fa-print" aria-hidden="true"></i>IMPRIMIR</a>
            </div>
         </div>
      </div>

      <!-- <div class="col-md-4">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">PAGOS / ABONOS </h4>
               <p class="card-text">RETORNA EL REPORTE DE LOS PAGOS REALIZADOS A LOS PROVEEDORES FILTRADOS POR FECHA </p>

               <form action="{{route('prove.reportToAbono')}}" method="post">
                  @csrf()

                  <div class="form-group">
                     <label for="">De (Fecha de Inicio): </label>
                     <input type="date" class="form-control" name="inicio" placeholder="Fecha de Inicio" required>
                  </div>
                  <div class="form-group">
                     <label for="">Hasta (Fecha de Final): </label>
                     <input type="date" class="form-control" name="fin" placeholder="Fecha de Fin" required>
                  </div>
                  <button class="btn btn-dark" type="submit"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</button>

               </form>

            </div>
         </div>
      </div>


      <div class="col-md-4">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">FACTURAS / COMPRAS</h4>
               <p class="card-text">RETORNA EL REPORTE DE LAS COMPRAS REALIZADAS A LOS PROVEEDORES FILTRADOS POR FECHA</p>

               <form action="{{route('prove.facturas_compras')}}" method="post">
                  @csrf()

                  <div class="form-group">
                     <label for="">De (Fecha de Inicio): </label>
                     <input type="date" class="form-control" name="inicio" placeholder="Fecha de Inicio" required>
                  </div>
                  <div class="form-group">
                     <label for="">Hasta (Fecha de Final): </label>
                     <input type="date" class="form-control" name="fin" placeholder="Fecha de Fin" required>
                  </div>
                  <button class="btn btn-dark" type="submit"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</button>

               </form>

            </div>
         </div>
      </div> -->

   </div>
</div>

@endsection