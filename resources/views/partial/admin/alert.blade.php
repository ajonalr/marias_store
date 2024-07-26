@if(session('info'))
<div class="alert alert-{{session('color')}} alert-dismissible  text-uppercase    text-center" role="alert" style="border-radius: 25px;">

   {{session('info')}}.
   <button type="button" class="close btn btn-{{session('color')}}" data-dismiss="alert" aria-label="Close">
      <span class="sr-only">Close</span>
      <span aria-hidden="true">&times;</span>
   </button>
</div>

@endif


@if(session('clienteid') && session('factura'))
<div class="alert alert-info alert-dismissible fade show text-center " role="alert" style="border-radius: 25px;">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
   <a href="{{route('venta.facturaPrint', ['idFactura' => session('factura'), 'idCliente' => session('clienteid')] )}}" target="_blank"> <i class="fa fa-print" aria-hidden="true"></i> Imprimir Recibo</a>
</div>
<div class="alert alert-info alert-dismissible fade show text-center d-none" role="alert" style="border-radius: 25px;">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
   <a href="{{route('venta.showventa', session('factura') )}}" target="_blank"> <i class="fa fa-print" aria-hidden="true"></i> SEGUIR VENDIENDO - IMPRIMIR RECIBO</a>
</div>


<!-- <div class="alert alert-dark alert-dismissible fade show text-center" role="alert" style="border-radius: 25px;">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
   <a href="{{route('venta.ventaPrintComanda', ['idFactura' => session('factura'), 'idCliente' => session('clienteid')] )}}" target="_blank"> <i class="fa fa-print" aria-hidden="true"></i> Imprimir Comanda</a>
</div> -->
@endif

@if (session('cuadre_id'))
<a href="{{route('caja.printCuadre', ['id' => session('cuadre_id')])}}" target="_blank">
   <div class="alert alert-warning alert-dismissible  text-uppercase text-center" role="alert">

      <i class="fa fa-print" aria-hidden="true"></i> IMPRIMIR CUADRE.


      <button type="button" class="close btn btn-{{session('color')}}" data-dismiss="alert" aria-label="Close">
         <span class="sr-only">Close</span>
         <span aria-hidden="true">&times;</span>
      </button>
   </div>
</a>

@endif


@if (session('articulo_id'))
<a href="{{route('articulo.show', ['id' => session('articulo_id')])}}" target="_blank">
   <div class="alert alert-info alert-dismissible  text-uppercase text-center" role="alert">

     <i class="fa fa-eye" aria-hidden="true"></i> VER ARTICULO.


      <button type="button" class="close btn btn-{{session('color')}}" data-dismiss="alert" aria-label="Close">
         <span class="sr-only">Close</span>
         <span aria-hidden="true">&times;</span>
      </button>
   </div>
</a>
@endif
