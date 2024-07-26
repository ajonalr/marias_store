<p>MAS RECIENTES</p>


<div class="list-group">
    @foreach ($ventas as $ven)
    <a  class="list-group-item list-group-item-action" target="_blank"  href="{{route('venta.facturaPrint', ['idFactura' => $ven->factura_id, 'idCliente' => $ven->cliente_id] )}}">{{$ven->cliente->nombre}} <br> {{ $ven->created_at->format('H:i:s') }}</a>
    @endforeach
</div>