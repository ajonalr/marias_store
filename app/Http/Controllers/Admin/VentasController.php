<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\Auxiliar;
use App\Models\Caja;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\DeudaCliente;
use App\Models\Factura;
use App\Models\Ingrediente;
use App\Models\IngredienteArticulo;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class VentasController extends Controller
{

    public function index()
    {
        
        $clientes = Cliente::all();
        $categoria = Categoria::all();

        $ventas = Ventas::whereDate('created_at', date('Y-m-d'))->groupby('factura_id')->orderby('id', 'desc')->limit(10)->get();



        return view('admin.ventas.index', compact('clientes', 'categoria', 'ventas'));
    }


    // retorna la respuesta en json para peticion ajax
    public function serach_to_categoria(Request $request)
    {

        $articulo = Articulo::where('categoria_id', $request->categoria_id)
            ->get();

        return Response::json($articulo);
    }


    // crea una venta
    public function store(Request $data)
    {


        $des = array();
        if (!$data->cliente_id && (!$data->nombre || !$data->nit))  return back()->with(['info' => 'ingrese datos de cliente', 'color' => 'danger']);

        if ($data->is_cititation) return $this->cotizacion_store($data);

        $vuelta =  count($data->articulo_id);
        $factura = new Factura();
        $factura->descripcion = $data->descripcion;
        $factura->total = $data->totalventa;
        $factura->factura = 'NO';
        $factura->descuento = $data->descuentoglobal;
        $factura->tipo = $data->tipo;
        $factura->mesa = $data->mesa;
        // comprobamos el estado para asignar la factura | recibo
        if ($data->nombre && $data->nit) {
            $factura->factura = 'SI';
            $factura->nombre = $data->nombre;
            $factura->nit = $data->nit;
            $factura->direccion = $data->direccion;
        } else {
            $factura->factura = 'NO';
            $factura->nombre = 'CONSUMIDOR FINAL';
            $factura->nit = 'CF';
            $factura->direccion = 'CIUDAD';
        }
        $factura->save();

        $clienteg = $data->cliente_id;
        // creamos cliente 
        if (!$data->cliente_id) {
            $cliente = new Cliente();
            $cliente->nombre = $data->nombre;
            $cliente->nit = $data->nit;
            $cliente->direccion = $data->direccion;
            $cliente->save();
            $clienteg =  $cliente->id;
        }

        for ($i = 0; $i < $vuelta; $i++) {
            $venta = new Ventas();
            $venta->articulo_id = $data->articulo_id[$i];
            $venta->cliente_id = $clienteg;
            $venta->factura_id = $factura->id;
            $venta->credito = false;
            $venta->cantidad = $data->cantidad[$i];
            $venta->descuento = $data->descuento[$i];
            $venta->total = $data->subtotal[$i];
            $venta->user_id = Auth::user()->id;
            // descontamos los articulos del stock
            $art = Articulo::find($data->articulo_id[$i]);
            $art->stock -= $data->cantidad[$i];

            $ings = IngredienteArticulo::where('articulo_id', $art->id)->get();

            foreach ($ings as $igh) {
                $ing = Ingrediente::find($igh->ingrediante_id);
                $ing->stock -= ($igh->cantidad * $data->cantidad[$i]);
                $ing->save();
            }

            $venta->p_venta = $art->p_venta;
            $venta->p_costo = $art->p_costo;
            $art->save();
            $venta->save();
            array_push($des, 'Compra: ' .  $art->nombre .  ' Cantidad: ' .  $data->cantidad[$i] . '<br>');
        }

        array_push($des, "CREDITO VENTA REGISTRADA EN RECIBO: $factura->id");

        if ($data->tipo === 'CREDITO') $this->createDeudaToClient($clienteg, $factura->total, $factura->id, $des);

        return back()->with(['info' => 'Venta Registrada con Exito', 'color' => 'success', 'factura' => $factura->id, 'clienteid' => $clienteg]);
    }

    function generatePropina() {
        
        $caja = new Caja();
        $caja->user_id = Auth::user()->id;
        $caja->valor = 5;
        $caja->descripcion = "PAGO DE PROPINAS";
        $caja->operacion = 'propi';
        $caja->fecha = date('Y-m-d');
        $caja->save();

        return back()->with(['info' => 'Propina Registrada con Exito', 'color' => 'success']);

    }


    // imprime la factura de una venta realizada
    public function ventaPrint($idFactura, $idCliente)
    {
        $deuda = DB::table('venta_articulos AS ven')
            ->join('clientes AS cli', 'ven.cliente_id', '=', 'cli.id')
            ->join('articulos AS art', 'ven.articulo_id', '=', 'art.id')
            ->join('facturas AS fac', 'ven.factura_id', '=', 'fac.id')
            ->join('users  as user', 'ven.user_id', '=', 'user.id')
            ->join('categoria as cat', 'art.categoria_id', '=', 'cat.id')
            ->select(
                'ven.id',
                'ven.factura_id',
                'ven.cantidad',
                'ven.cliente_id',
                'ven.total',
                'ven.descuento',
                'ven.created_at as fechaVenta',
                'cli.nombre',
                'cli.direccion',
                'cli.telefono1',
                'cli.nit',
                'cli.telefono2',
                'art.nombre as nomArt',
                'art.p_venta',
                'art.descripcion',
                'cat.nombre as catNombre',
                'fac.descuento as facDescuento',
                'fac.total as facTotal',
                'fac.descripcion as facDesc',
                'user.name as userName',

            )
            ->where('ven.factura_id', $idFactura)
            ->get();
        $facturaVenta = Factura::find($idFactura);
        $totalDeuda = 0;
        $nombre = '';
        $fecha = date('Y');
        $nit = 0;
        $descuento_articulo = 0;
        $sin_desc = 0;
        $mayorista = false;
        $facTotal = 0;
        $usuario = '';
        $aux3 = 0;
        foreach ($deuda as $deu) {
            $totalDeuda =  $deu->total + $totalDeuda;
            $nombre = $deu->nombre;
            $fecha = $deu->fechaVenta;
            $nit = $deu->nit;
            $descuento_articulo = $descuento_articulo + $deu->descuento;
            $sin_desc = ($sin_desc + $deu->p_venta) * $deu->cantidad;
            $facTotal = $deu->facTotal;
            $facDesc = $deu->facDesc;
            $usuario = $deu->userName;
        }
        return view('admin.reports.ventas.venta', ['deuda' => $deuda, 'totalDeuda' => $totalDeuda, 'cliente' => $nombre, 'factura' => $facturaVenta, 'fecha' => $fecha, 'nit' => $nit, 'descuetoArticulos' => $descuento_articulo, 'sin_desc' => $sin_desc, 'mayorista' => $mayorista, 'facTotal' => $facTotal, 'totalSinDecMayo' => $aux3, 'usuario' => $usuario]);
    }

    public function ventaPrintComanda($idFactura, $idCliente)
    {
        $deuda = DB::table('venta_articulos AS ven')
            ->join('clientes AS cli', 'ven.cliente_id', '=', 'cli.id')
            ->join('articulos AS art', 'ven.articulo_id', '=', 'art.id')
            ->join('facturas AS fac', 'ven.factura_id', '=', 'fac.id')
            ->join('users  as user', 'ven.user_id', '=', 'user.id')
            ->join('categoria as cat', 'art.categoria_id', '=', 'cat.id')
            ->select(
                'ven.id',
                'ven.factura_id',
                'ven.cantidad',
                'ven.cliente_id',
                'ven.total',
                'ven.descuento',
                'ven.created_at as fechaVenta',
                'cli.nombre',
                'cli.direccion',
                'cli.telefono1',
                'cli.nit',
                'cli.telefono2',
                'art.nombre as nomArt',
                'art.p_venta',
                'art.descripcion',
                'cat.nombre as catNombre',
                'fac.descuento as facDescuento',
                'fac.total as facTotal',
                'fac.descripcion as facDesc',
                'user.name as userName',

            )
            ->where('ven.factura_id', $idFactura)
            ->get();
        $facturaVenta = Factura::find($idFactura);
        $totalDeuda = 0;
        $nombre = '';
        $fecha = date('Y');
        $nit = 0;
        $descuento_articulo = 0;
        $sin_desc = 0;
        $mayorista = false;
        $facTotal = 0;
        $usuario = '';
        $aux3 = 0;
        foreach ($deuda as $deu) {
            $totalDeuda =  $deu->total + $totalDeuda;
            $nombre = $deu->nombre;
            $fecha = $deu->fechaVenta;
            $nit = $deu->nit;
            $descuento_articulo = $descuento_articulo + $deu->descuento;
            $sin_desc = ($sin_desc + $deu->p_venta) * $deu->cantidad;
            $facTotal = $deu->facTotal;
            $facDesc = $deu->facDesc;
            $usuario = $deu->userName;
        }
        return view('admin.reports.ventas.comanda', ['deuda' => $deuda, 'totalDeuda' => $totalDeuda, 'cliente' => $nombre, 'factura' => $facturaVenta, 'fecha' => $fecha, 'nit' => $nit, 'descuetoArticulos' => $descuento_articulo, 'sin_desc' => $sin_desc, 'mayorista' => $mayorista, 'facTotal' => $facTotal, 'totalSinDecMayo' => $aux3, 'usuario' => $usuario]);
    }

    // devuelve el hoitorial de las ventas realizadas
    public function historial(Request $request)
    {

        $show = false;
        $contado = null;
        if ($request->fecha) {
            $show = true;
            $contado = DB::table('venta_articulos AS ven')
                ->join('clientes AS cli', 'ven.cliente_id', '=', 'cli.id')
                ->join('articulos AS art', 'ven.articulo_id', '=', 'art.id')
                ->join('facturas AS fac', 'ven.factura_id', '=', 'fac.id')
                ->select(
                    'ven.id',
                    'ven.factura_id',
                    'ven.articulo_id',
                    'ven.cantidad',
                    'ven.cliente_id',
                    'ven.total',
                    'ven.created_at as fechaVenta',
                    'cli.nombre',
                    'cli.direccion',
                    'cli.telefono1',
                    'cli.telefono2',
                    'art.nombre as nomArt',
                    'art.cod_barras',
                    'art.descripcion',
                    'fac.mesa'
                )
                ->whereDate('ven.created_at', $request->fecha)
                ->groupBy('ven.factura_id')
                ->get();
        } else {
            $show = true;
            $contado = DB::table('venta_articulos AS ven')
                ->join('clientes AS cli', 'ven.cliente_id', '=', 'cli.id')
                ->join('articulos AS art', 'ven.articulo_id', '=', 'art.id')
                ->join('facturas AS fac', 'ven.factura_id', '=', 'fac.id')

                ->select(
                    'ven.id',
                    'ven.factura_id',
                    'ven.articulo_id',
                    'ven.cantidad',
                    'ven.cliente_id',
                    'ven.total',
                    'ven.created_at as fechaVenta',
                    'cli.nombre',
                    'cli.direccion',
                    'cli.telefono1',
                    'cli.telefono2',
                    'art.nombre as nomArt',
                    'art.cod_barras',
                    'art.descripcion',
                    'fac.mesa'
                )
                ->whereDate('ven.created_at', date('Y-m-d-'))
                ->groupBy('ven.factura_id')
                ->get();
        }

        return view('admin.ventas.historial', ['contado' => $contado, 'show' => $show]);
    }

    // elimina una venta y actualiza el stock en los articulos
    public function destroy($id, $idArt)
    {
        $venta = Ventas::where('factura_id', $id)->get();



        foreach ($venta as $venta) {
            $articulo = Articulo::find($venta->articulo_id);
            $articulo->stock = $articulo->stock + $venta->cantidad;
            $articulo->save();
            $venta->delete();
        }
        Factura::find($id)->delete();
        return back()->with(['info' => 'Venta Anulda Con Exito', 'color' => 'danger']);
    }

    // devuelve la vista para los reportes
    public function reportes()
    {
        return view('admin.ventas.reportes');
    }

    // devuelve la vista para reporte de todas las ventas 
    public function reportesVentasAll(Request $data)
    {
        $ventas = DB::table('venta_articulos AS ven')
            ->join('clientes AS cli', 'ven.cliente_id', '=', 'cli.id')
            ->join('articulos AS art', 'ven.articulo_id', '=', 'art.id')
            ->join('facturas AS fac', 'ven.factura_id', '=', 'fac.id')
            ->select(
                'ven.id',
                'ven.factura_id',
                'ven.articulo_id',
                'ven.cantidad',
                'ven.cliente_id',
                'ven.total',
                'ven.descuento',

                'ven.created_at as fechaVenta',
                'cli.nombre',
                'cli.direccion',
                'cli.telefono1',
                'cli.telefono2',
                'art.nombre as nomArt',
                'art.cod_barras',
                'art.descripcion',
                'art.p_costo',

                'fac.total as facTotal',
                'fac.descuento  as facDecuento',
                'fac.id  as facid',
                'fac.descripcion as facDes',
                'fac.tipo'
            )
            ->whereBetween('ven.created_at', [$data->inicio, $data->fin])
            ->get();

        $totalventasesperadas = 0;
        $totaldescuentos = 0;
        $totalventasmenosdescuentos = 0;
        $totalganancias = 0;
        $totalInversion = 0;

        foreach ($ventas as $ven) {
            $totalventasesperadas += $ven->total + $ven->descuento;
            $totaldescuentos +=  $ven->descuento;
            $totalventasmenosdescuentos += $ven->total;
            $totalInversion += $ven->p_costo * $ven->cantidad;
            $totalganancias += $ven->total - ($ven->p_costo * $ven->cantidad);
        }

        return view('admin.reports.ventas.ventas', ['ventas' => $ventas, 'totalventasesperadas' => $totalventasesperadas, 'mes' => $data->inicio, 'ano' => $data->fin, 'totaldescuentos' => $totaldescuentos, 'totalventasmenosdescuentos' => $totalventasmenosdescuentos, 'totalganancias' => $totalganancias, 'totalInversion' => $totalInversion]);
    }

    // retorna los articulos vendidos dell dia actual
    public function ventasDia()
    {
        $ventas = DB::table('venta_articulos AS ven')
            ->join('clientes AS cli', 'ven.cliente_id', '=', 'cli.id')
            ->join('articulos AS art', 'ven.articulo_id', '=', 'art.id')
            ->join('facturas AS fac', 'ven.factura_id', '=', 'fac.id')
            ->select(
                'ven.id',
                'ven.factura_id',
                'ven.articulo_id',
                'ven.cantidad',
                'ven.cliente_id',
                'ven.total',
                'ven.descuento',

                'ven.created_at as fechaVenta',
                'cli.nombre',
                'cli.direccion',
                'cli.telefono1',
                'cli.telefono2',
                'art.nombre as nomArt',
                'art.cod_barras',
                'art.descripcion',
                'art.p_costo',

                'fac.total as facTotal',
                'fac.descuento  as facDecuento',
                'fac.id  as facid',
                'fac.descripcion as facDes',
                'fac.tipo'
            )
            ->whereDate('ven.created_at', date('Y-m-d'))
            ->get();

        $totalventasesperadas = 0;
        $totaldescuentos = 0;
        $totalventasmenosdescuentos = 0;
        $totalganancias = 0;
        $totalInversion = 0;

        foreach ($ventas as $ven) {
            $totalventasesperadas += $ven->total + $ven->descuento;
            $totaldescuentos +=  $ven->descuento;
            $totalventasmenosdescuentos += $ven->total;
            $totalInversion += $ven->p_costo * $ven->cantidad;
            $totalganancias += $ven->total - ($ven->p_costo * $ven->cantidad);
        }


        return view('admin.reports.ventas.dia', ['ventas' => $ventas, 'totalventasesperadas' => $totalventasesperadas,  'totaldescuentos' => $totaldescuentos, 'totalventasmenosdescuentos' => $totalventasmenosdescuentos, 'totalganancias' => $totalganancias, 'totalInversion' => $totalInversion]);
    }

    // ultimos movimientos
    public function movimientos()
    {
        $ventas = DB::table('venta_articulos AS ven')
            ->join('clientes AS cli', 'ven.cliente_id', '=', 'cli.id')
            ->join('articulos AS art', 'ven.articulo_id', '=', 'art.id')
            ->join('facturas AS fac', 'ven.factura_id', '=', 'fac.id')
            ->select(
                'ven.id',
                'ven.factura_id',
                'ven.articulo_id',
                'ven.cantidad',
                'ven.cliente_id',
                'ven.total',
                'ven.descuento',

                'ven.created_at as fechaVenta',
                'cli.nombre',
                'cli.direccion',
                'cli.telefono1',
                'cli.telefono2',
                'art.nombre as nomArt',
                'art.cod_barras',
                'art.descripcion',
                'art.p_venta',
                'art.p_costo',
                'fac.total as facTotal',
                'fac.descuento  as facDec',
                'fac.id  as facid',
                'fac.descripcion as facDes'
            )
            ->whereDate('ven.created_at', date('Y-m-d'))
            ->take(15)
            ->get();


        return view('admin.reports.ventas.dia', ['ventas' => $ventas]);
    }

    // retorna la vista para las estadisticas
    public function estadistica()
    {
        $estadisticasano = $this->estadis();
        $masVendidos = $this->masVendidos();
        $categoria = $this->categoriaEs();


        // dd($estadisticasano);
        // dd($masVendidos);
        // dd($categoria);

        return view('admin.reports.ventas.estadistica', ['datos' => $estadisticasano, 'masVendidos' => $masVendidos, 'categoria' => $categoria]);
    }

    // retorna los datos de entradas de efectico
    // para construir las graficas estadisticass
    public function estadis()
    {
        $ventasEnero = $this->ventasMes(1);
        $ventasFebrero = $this->ventasMes(2);
        $ventasMarzo = $this->ventasMes(3);
        $ventasAbril = $this->ventasMes(4);
        $ventasMayo = $this->ventasMes(5);
        $ventasJunio = $this->ventasMes(6);
        $ventasJulio = $this->ventasMes(7);
        $ventasAgosto = $this->ventasMes(8);
        $ventasSptiembre = $this->ventasMes(9);
        $ventasOctubre = $this->ventasMes(10);
        $ventasNoviembre = $this->ventasMes(11);
        $ventasDiciembre = $this->ventasMes(12);
        $totales = array();
        $total1 = 0;
        $total2 = 0;
        $total3 = 0;
        $total4 = 0;
        $total5 = 0;
        $total6 = 0;
        $total7 = 0;
        $total8 = 0;
        $total9 = 0;
        $total10 = 0;
        $total11 = 0;
        $total12 = 0;

        foreach ($ventasEnero as $venta) {
            $total1 = $total1 +  $venta->cuadre;
        }
        foreach ($ventasFebrero as $venta) {
            $total2 = $total2 +  $venta->cuadre;
        }
        foreach ($ventasMarzo as $venta) {
            $total3 = $total3 +  $venta->cuadre;
        }

        foreach ($ventasAbril as $venta) {
            $total4 = $total4 +  $venta->cuadre;
        }
        foreach ($ventasMayo as $venta) {
            $total5 = $total5 +  $venta->cuadre;
        }
        foreach ($ventasJunio as $venta) {
            $total6 = $total6 +  $venta->cuadre;
        }
        foreach ($ventasJulio as $venta) {
            $total7 = $total7 +  $venta->cuadre;
        }
        foreach ($ventasAgosto as $venta) {
            $total8 = $total8 +  $venta->cuadre;
        }
        foreach ($ventasSptiembre as $venta) {
            $total9 = $total9 +  $venta->cuadre;
        }
        foreach ($ventasOctubre as $venta) {
            $total10 = $total10 +  $venta->cuadre;
        }
        foreach ($ventasNoviembre as $venta) {
            $total11 = $total11 +  $venta->cuadre;
        }
        foreach ($ventasDiciembre as $venta) {
            $total12 = $total12 +  $venta->cuadre;
        }


        array_push($totales, $total1, $total2, $total3, $total4, $total5, $total6, $total7, $total8, $total9, $total10, $total11, $total12);


        return $totales;
    }

    // retorna  los cuadres de caja por mes
    public function ventasMes($mes)
    {
        $data =
            DB::table('cuadre')
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', date('Y'))
            ->get();
        return $data;
    }

    // retorna un listadode articulos mas vendidos
    public function masVendidos()
    {
        $data =  DB::table('venta_articulos')
            ->join('articulos as art', 'venta_articulos.articulo_id', '=', 'art.id')
            ->select(DB::raw('SUM(venta_articulos.cantidad) as idArticulo'), 'venta_articulos.factura_id', 'art.nombre', 'art.descripcion')
            ->groupBy('venta_articulos.articulo_id')
            ->orderBy(DB::raw('venta_articulos.articulo_id'), 'desc')
            ->whereMonth('venta_articulos.created_at', date('m'))
            ->limit(26)
            ->get();


        $data2 = array();
        foreach ($data as $d) {
            array_push($data2, $d);
        }

        return $data2;
    }

    // retorna un listado de los clientes mas grecuentes
    public function clientesPremium()
    {
        // cliente_id

        return  DB::table('venta_articulos')
            ->join('clientes', 'venta_articulos.cliente_id', '=', 'clientes.id')
            ->select(DB::raw('COUNT(venta_articulos.cliente_id) as idcliente'), 'venta_articulos.factura_id', 'clientes.nombre')
            ->where('cliente_id', '!=', 14)
            ->groupBy('venta_articulos.cliente_id')
            ->orderBy(DB::raw('venta_articulos.cliente_id'), 'desc')
            ->limit(10)
            ->get();
    }

    // retorna las ventas filtradas  por fecha de forma simple
    public function fucturasSimples(Request $request)
    {
        $fac = DB::table('facturas as fac')
            ->select('fac.*')
            ->whereBetween('created_at', [$request->desde, $request->hasta])
            ->get();
        return view('admin.reports.ventas.facturassimples', ['data' => $fac]);
    }

    // RETORNA LOS ARTICULOS QUE ESTE MAS FRECUENTES EN UN CATEGORIA
    public function categoriaEs()
    {
        return  DB::table('articulos as art')
            ->join('categoria as cat', 'art.categoria_id', '=', 'cat.id')
            ->select('cat.nombre', DB::raw('Sum(art.categoria_id) as frecu'))
            ->groupBy('art.categoria_id')
            ->get();
    }

    // retorna la respuesta en json para peticion ajax
    public function findArticle(Request $request)
    {


        $articulo = DB::table('articulos as art')
            ->join('categoria as cat', 'art.categoria_id', '=', 'cat.id')
            ->select(
                'art.nombre',
                'art.id',
                'art.descripcion',
                'art.descripcion_interna',
                'art.cod_barras',
                'cat.nombre as categoria',
                'art.img',
                'art.p_venta',
                'art.stock',
                'art.minimo1',
                'art.maximo1',
                'art.precio1',
                'art.minimo2',
                'art.maximo2',
                'art.precio2',
                'art.minimo3',
                'art.maximo3',
                'art.precio3',
                'art.deleted_at'
            )
            ->orwhere('art.descripcion', 'like', '%' . $request->codigo . '%')
            ->orwhere('art.cod_barras', 'like', '%' . $request->codigo . '%')
            ->orwhere('art.nombre', 'like', '%' . $request->codigo . '%')
            ->get();;

        // $articulo = Articulo::orwhere('descripcion', 'like', '%' . $request->codigo . '%')
        //     ->orwhere('cod_barras', 'like', '%' . $request->codigo . '%')
        //     ->orwhere('nombre', 'like', '%' . $request->codigo . '%')
        //     ->get();

        return Response::json($articulo);
    }

    // guarda una venta como cotizacion
    public function cotizacion_store(Request $data)
    {

        $vuelta =  count($data->articulo_id);
        $codigo = date("Ymdhis");
        $clienteg = $data->cliente_id;
        // creamos cliente 
        if (!$data->cliente_id) {
            $cliente = new Cliente();
            $cliente->nombre = $data->nombre;
            $cliente->nit = $data->nit;
            $cliente->direccion = $data->direccion;
            $cliente->save();
            $clienteg =  $cliente->id;
        }
        // creamos el auxiliar
        $aux = new Auxiliar();
        $aux->descripcion = $data->descripcion;
        $aux->total = $data->totalventa;
        $aux->descuento = $data->descuentoglobal;
        $aux->save();

        for ($i = 0; $i < $vuelta; $i++) {
            $venta = new Cotizacion();
            $venta->articulo_id = $data->articulo_id[$i];
            $venta->aux_id = $aux->id;
            $venta->codigo = $codigo;
            $venta->cliente_id = $clienteg;
            $venta->cantidad = $data->cantidad[$i];
            $venta->descuento = $data->descuento[$i];
            $venta->total = $data->subtotal[$i];
            $venta->save();
        }
        return back()->with(['info' => 'COTIZACION REALIZADA', 'color' => 'info', 'codigo' => $codigo]);
    }

    // asigna un credito a un cliente 
    public function createDeudaToClient($cliente_id, $total, $factura_id, $des)
    {
        $fecha_actual = date("d-m-Y");




        $deu = new DeudaCliente();
        $deu->cliente_id = $cliente_id;
        $deu->descripcion = implode(" ", $des);
        $deu->fecha_pago = date("Y-m-d", strtotime($fecha_actual . "+ 8 days"));
        $deu->total = $total;
        $deu->save();


        $cli = Cliente::findOrFail($cliente_id);
        $cli->deuda += $total;
        $cli->save();


        $caja = new Caja();
        $caja->valor = $total;
        $caja->descripcion = "CREDITO DE $cli->nombre por: $factura_id";
        $caja->operacion = 'd';
        $caja->fecha = date('Y-m-d');
        $caja->user_id = Auth::user()->id;
        $caja->save();

        // anadimos la descripcion de crediro en abono

    }

    // report ventas to tipo an date
    public function reportVentasToTipoAndDate(Request $data)
    {
        $ventas = DB::table('venta_articulos AS ven')
            ->join('clientes AS cli', 'ven.cliente_id', '=', 'cli.id')
            ->join('articulos AS art', 'ven.articulo_id', '=', 'art.id')
            ->join('facturas AS fac', 'ven.factura_id', '=', 'fac.id')
            ->select(
                'ven.id',
                'ven.factura_id',
                'ven.articulo_id',
                'ven.cantidad',
                'ven.cliente_id',
                'ven.total',
                'ven.descuento',

                'ven.created_at as fechaVenta',
                'cli.nombre',
                'cli.direccion',
                'cli.telefono1',
                'cli.telefono2',
                'art.nombre as nomArt',
                'art.cod_barras',
                'art.descripcion',
                'art.p_costo',

                'fac.total as facTotal',
                'fac.descuento  as facDecuento',
                'fac.id  as facid',
                'fac.descripcion as facDes',
                'fac.tipo'
            )
            ->where('fac.tipo', '=', $data->tipo)
            ->whereBetween('fac.created_at', [$data->inicio, $data->fin])
            ->get();

        $totalventasesperadas = 0;
        $totaldescuentos = 0;
        $totalventasmenosdescuentos = 0;
        $totalganancias = 0;
        $totalInversion = 0;



        foreach ($ventas as $ven) {
            $totalventasesperadas += $ven->total + $ven->descuento;
            $totaldescuentos +=  $ven->descuento;
            $totalventasmenosdescuentos += $ven->total;
            $totalInversion += $ven->p_costo * $ven->cantidad;
            $totalganancias += $ven->total - ($ven->p_costo * $ven->cantidad);
        }

        return view('admin.reports.ventas.ventas', ['ventas' => $ventas, 'totalventasesperadas' => $totalventasesperadas, 'mes' => $data->inicio, 'ano' => $data->fin, 'totaldescuentos' => $totaldescuentos, 'totalventasmenosdescuentos' => $totalventasmenosdescuentos, 'totalganancias' => $totalganancias, 'totalInversion' => $totalInversion]);
    }

    // retorna la vista de una venta para podela modificar
    public function showventa($id)
    {
        $deuda = Ventas::where('factura_id', $id)
            ->get();
        $recibo = Factura::find($id);
        $totalDeuda = 0;
        $descuento_articulo = 0;
        $sin_desc = 0;
        $cli = 0;
        foreach ($deuda as $deu) {
            $totalDeuda =  $deu->total + $totalDeuda;
            $descuento_articulo = $descuento_articulo + $deu->descuento;
            $sin_desc = ($sin_desc + $deu->p_venta) * $deu->cantidad;
            $cli =  $deu->cliente_id;
        }

        $articulos = Articulo::all();



        return view('admin.ventas.edit', compact('deuda', 'recibo', 'cli', 'articulos'));
    }

    // anula un articulo de forma especifica
    public function deleteVentaEspecific($id)
    {
        $venta = Ventas::find($id);
        $articulo = Articulo::find($venta->articulo_id);
        $factura = Factura::find($venta->factura_id);

        $factura->total -= $venta->total;
        $articulo->stock += $venta->cantidad;

        $factura->save();
        $articulo->save();

        $venta->delete();

        return back()->with(['info' => 'dato de venta anulada con exito', 'color' => 'succes']);
    }

    function store_venta_existfactura(Request $request)
    {

        $art = Articulo::find($request->articulos_id);
        $venta = new Ventas();
        $venta->articulo_id = $request->articulos_id;
        $venta->user_id = Auth::user()->id;
        $venta->cliente_id = $request->cliente_id;
        $venta->factura_id = $request->factura;
        $venta->credito = 'no';
        $venta->cantidad = $request->cantidad;
        $venta->total = ($art->p_venta * $request->cantidad);
        $venta->descuento = 0;


        $venta->save();
        return back()->with(['info' => 'Dato Anadido', 'color' => 'success']);
    }
}
