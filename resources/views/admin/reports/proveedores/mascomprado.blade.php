@extends('layouts.app')

@section('styles')
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



   <div class="row mt-2 mb-4">
      <div class="col">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Articulos Mas Comprados</h4>
               <div id="myfirstchart" style="height: 250px;"></div>

            </div>
         </div>
      </div>
   </div>


</div>

@endsection

@section('scripts')
<script src="{{asset('assets/theme/vendor/charts2/chart.min.js')}}"></script>



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
</script>
@endsection