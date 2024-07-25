@extends('layouts.admin')


@section('content')

<div class="container-fluid">

   <div class="row">
      <div class="col-md-4">
         <a href="{{route('mobiliario.allreport')}}">
            <div class="card">
               <img class="card-img-top" src="{{asset('images/lista1.png')}}" alt="">
               <div class="card-body">
                  <h4 class="card-title">MOBILIARIO Y EQUIPO</h4>
                  <p class="card-text">GENERA EL REPORTE DE MOBILIARIO Y EQUIPO CON TODOS LOS DATOS</p>
               </div>
            </div>
         </a>
      </div>
      <div class="col-md-4">
         <a href="{{route('mobiliario.allcontrol')}}">
            <div class="card">
               <img class="card-img-top" src="{{asset('images/lista2.png')}}" alt="">
               <div class="card-body">
                  <h4 class="card-title">MOBILIARIO Y EQUIPO</h4>
                  <p class="card-text">GENERA EL REPORTE DE MOBILIARIO Y EQUIPO SIN DATOS SENSIBLES</p>
               </div>
            </div>
         </a>
      </div>
   </div>
</div>

@endsection