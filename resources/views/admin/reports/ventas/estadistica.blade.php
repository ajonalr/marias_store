@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/charts2/chart.min.js')}}">
<link rel="stylesheet" href="{{asset('plugins/morrisChart/morris.css')}}">
<script src="{{asset('plugins/morrisChart/jquery.min.js')}}"></script>
<script src="{{asset('plugins/morrisChart/raphael-min.js')}}"></script>
<script src="{{asset('plugins/morrisChart/morris.min.js')}}"></script>
@endsection

@section('content')

<div class="container">
   <div class="row">
      <div class="col">
         <h1 class="display-4">Estadistica</h1>
      </div>
   </div>

   <div class="row">
      <div class="col">
         <div class="card ">

            <div class="card-body">
               <h3 class="card-title">
                  Control Estadisitico Mensual
               </h3>

               <div style="width:100%;">
                  <canvas id="myChart"></canvas>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row mt-2 mb-4">
      <div class="col">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Articulos Mas Vendidos</h4>
               <div id="myfirstchart" style="height: 250px;"></div>

            </div>
         </div>
      </div>
   </div>

   <div class="row mt-2 mb-4">
      <div class="col">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">CATEGORIAS</h4>
               <div id="myfirstchart2" style="height: 250px;"></div>

            </div>
         </div>
      </div>
   </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('plugins/charts2/chart.min.js')}}"></script>

<script>
   var ctx = document.getElementById('myChart').getContext('2d');
   var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
         labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
         datasets: [{
            label: 'Ocultar',
            data: [<?php echo $datos[0]; ?>, <?php echo $datos[1]; ?>, <?php echo $datos[2]; ?>, <?php echo $datos[3]; ?>, <?php echo $datos[4]; ?>, <?php echo $datos[5]; ?>, <?php echo $datos[6]; ?>, <?php echo $datos[7]; ?>, <?php echo $datos[8]; ?>, <?php echo $datos[9]; ?>, <?php echo $datos[10]; ?>, <?php echo $datos[11]; ?>],
            backgroundColor: [
               'rgba(239, 154, 154, 1)',
               'rgba(244, 143, 177, 1)',
               'rgba(206, 147, 216, 1)',
               'rgba(179, 157, 219, 1)',
               'rgba(159, 168, 218, 1)',
               'rgba(144, 202, 249, 1)',
               'rgba(129, 212, 250, 1)',
               'rgba(128, 203, 196, 1)',
               'rgba(165, 214, 167, 1)',
               'rgba(197, 225, 165, 1)',
               'rgba(255, 245, 157, 1)',
               'rgba(255, 171, 145, 1)'
            ],
            borderColor: [
               'rgba(239, 154, 154, 1)',
               'rgba(244, 143, 177, 1)',
               'rgba(206, 147, 216, 1)',
               'rgba(179, 157, 219, 1)',
               'rgba(159, 168, 218, 1)',
               'rgba(144, 202, 249, 1)',
               'rgba(129, 212, 250, 1)',
               'rgba(128, 203, 196, 1)',
               'rgba(165, 214, 167, 1)',
               'rgba(197, 225, 165, 1)',
               'rgba(255, 245, 157, 1)',
               'rgba(255, 171, 145, 1)'
            ],
            borderWidth: 1
         }]
      },
      options: {
         scales: {
            yAxes: [{
               ticks: {
                  beginAtZero: true
               }
            }]
         }
      }
   });
</script>

<script>
   new Morris.Bar({
      // ID of the element in which to draw the chart.
      element: 'myfirstchart',
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.
      data: [
         <?php
         foreach ($masVendidos as $mas) {
         ?> {
               year: <?php echo "'$mas->nombre'"; ?>,
               value: <?php echo $mas->idArticulo; ?>
            },
         <?php } ?>
      ],
      // The name of the data record attribute that contains x-values.
      xkey: 'year',
      // A list of names of data record attributes that contain y-values.
      ykeys: ['value'],
      // Labels for the ykeys -- will be displayed when you hover over the
      // chart.
      labels: ['CANTIDAD VENDIDA '], 
      barColors: ['#B28DFF']
   });
   new Morris.Bar({
      // ID of the element in which to draw the chart.
      element: 'myfirstchart2',
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.
      data: [
         <?php
         foreach ($categoria as $cat) {
         ?> {
               year: <?php echo "'$cat->nombre'"; ?>,
               value: <?php echo "'$cat->frecu'"; ?>
            },
         <?php } ?>
      ],
      // The name of the data record attribute that contains x-values.
      xkey: 'year',
      // A list of names of data record attributes that contain y-values.
      ykeys: ['value'],
      // Labels for the ykeys -- will be displayed when you hover over the
      // chart.
      labels: ['NUERO DE VISITAS'], 
      barColors: ['#FFABAB']
   });
</script>
@endsection