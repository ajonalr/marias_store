@extends('layouts.admin')


@section('content')


<div class="container-fluid">
   <div class="row justify-content-center">
      <div class="col-md-8">

         <div class="card">
            <img class="card-img-top" src="holder.js/100x180/" alt="">
            <div class="card-body">
               <h4 class="card-title">IMPUESTOS A PAGAR</h4>
               <p class="card-text">RETORNA EL TOTAL A PAGAR DE IMPUESTOS</p>

               <form action="{{route('factura.reporteMensual')}}" method="post">
                  @csrf
                  <div class="form-group">
                     <label for="">PORCENTAJE A PAGAR</label>
                     <input type="text" class="form-control" name="por" placeholder="%">
                  </div>

                  <select name="ano" class="form-control mb-2">
                     <option value="">Seleccione Año</option>
                     @for($i = 2022; $i < 2050; $i ++) <option value="{{$i}}">Año: {{$i}}</option>
                        @endfor
                  </select>

                  <select name="mes" class="form-control mb-2">
                     <option selected hidden>Mes</option>
                     <option value="01">Enero</option>
                     <option value="02">Febrero</option>
                     <option value="03">Marzo</option>
                     <option value="04">Abril</option>
                     <option value="05">Mayo</option>
                     <option value="06">Junio</option>
                     <option value="07">Julio</option>
                     <option value="08">Agosto</option>
                     <option value="09">Septiembre</option>
                     <option value="10">Octubre</option>
                     <option value="11">Noviembre</option>
                     <option value="12">Diciembre</option>
                  </select>

                  <button class="btn btn-success rounded" type="submit"> <i class="fa fa-search" aria-hidden="true"></i> BUSCAR</button>


               </form>

            </div>
         </div>

      </div>
   </div>
</div>


@endsection