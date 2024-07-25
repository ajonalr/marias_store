<div class="form-group">
   <strong>Cliente :</strong>
   {{ $proyecto->cliente->nombre }}
</div>
<div class="form-group">
   <strong>Nombre:</strong>
   {{ $proyecto->nombre }}
</div>
<div class="form-group">
   <strong>Descripcion:</strong>
   {{ $proyecto->descripcion }}
</div>
<div class="form-group">
   <strong>Total:</strong>
   Q. {{ number_format($proyecto->total, 2) }}
</div>
<div class="form-group">
   <strong>Url Git:</strong>
   {{ $proyecto->url_git }}
</div>
<div class="form-group">
   <strong>Fecha Entrega:</strong>
   {{ $proyecto->fecha_entrega }}
</div>



<h1 class=text-center>TOTAL DEUDA: <span class="badge badge-secondary">Q. {{number_format($proyecto->total - $t_abono, 2)}}   </span></h1>
