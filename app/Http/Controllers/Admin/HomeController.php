<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbonoCliente;
use App\Models\Articulo;
use App\Models\ArticulosCatalogo;
use App\Models\Cliente;
use App\Models\DeudaCliente;
use App\Models\Ventas;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clietes = Cliente::count('id');
        $ventas = Ventas::whereDate('created_at', date('Y-m-d'))->get();
        $ventasTotal = 0;
        foreach ($ventas as $vent) {
            $ventasTotal = $ventasTotal + $vent->total;
        }
        $articulosunic = Articulo::count('id');

        $ventasContado =  $this->ventasContado();
        $contado = 0;
        foreach ($ventasContado as $cont) {
            $contado = $contado + $cont->total;
        }


        $salidas = $this->listsalida();
        $totalSalida = 0;
        foreach ($salidas as $sal) {
            $totalSalida = $totalSalida + $sal->valor;
        }

        $articulostockmin = Articulo::all();
        $catalogo = ArticulosCatalogo::count();

        $articulosAnandidos =  Articulo::latest()
            ->take(5)
            ->get();
        $abonos = $this->abonoProximo(config('app.pago_proveedor'));

        $deudas = $this->deudas(config('app.cobrar_creditos'));
        $vencidos = $this->articulosven(config('app.articulos_Vencidos'));
        $cheques = $this->pago_cheque_proximos(config('app.pago_cheques'));
        $deudascliente = $this->deudaClientes();

        $d = Articulo::all();

        foreach ($d as $db) {
           $db->stock = 10000;
           $db->save();
        }


        return view('admin.home', ['clietes' => $clietes, 'ventas' => $ventasTotal, 'articulounic' => $articulosunic, 'contado' => $contado, 'salidas' => $totalSalida,  'artStock' => $articulostockmin, 'catalogo' => $catalogo,  'anadidos' => $articulosAnandidos, 'abonos' => $abonos, 'deudas' => $deudas, 'vencidos' => $vencidos, 'cheques' => $cheques, 'deudasCliente' => $deudascliente]);
    }


    // ventas al contado
    public function ventasContado()
    {
        $contado = DB::table('venta_articulos AS ven')
            ->join('clientes AS cli', 'ven.cliente_id', '=', 'cli.id')
            ->join('articulos AS art', 'ven.articulo_id', '=', 'art.id')
            ->select(
                'ven.id',
                'ven.factura_id',
                'ven.articulo_id',
                'ven.cantidad',
                'ven.cliente_id',
                'ven.total',
                'ven.credito',
                'ven.created_at as fechaVenta',
                'cli.nombre',
                'cli.direccion',
                'cli.telefono1',
                'cli.telefono2',
                'art.nombre as nomArt',
                'art.cod_barras',
                'art.descripcion'
            )
            ->where('ven.credito', 0)
            ->whereDate('ven.created_at', date('Y-m-d'))
            ->get();
        return $contado;
    }


    // devuele un listado de las salidas
    public function listsalida()
    {
        $salida = DB::table('caja')
            ->where('operacion', 's')
            ->whereDate('fecha', date('Y-m-d'))
            ->get();
        return $salida;
    }

    // retorna los articulos proximos a expirar
    public function articulosven($dias)
    {
        $fecha1 = now()->toDateString();
        $fecha2 = now()->addDays($dias)->toDateString();
        $articulos = Articulo::whereBetween('fecha_ven', [$fecha1, $fecha2])->get();
        return $articulos;
    }

    // retorna los articulos con minimo de stock
    public function artstok()
    {
        $articulos = Articulo::where('stock', '<=', 'min_stock')->get();
        // dd($articulos);
        return $articulos;
    }


    // retorna las facturas proximas a pagar de cada proveedor
    public function abonoProximo($dias)
    {
        $fecha1 = now()->toDateString();
        $fecha2 = now()->addDays($dias)->toDateString();
        $articulos = DB::table('facturas_proveedor as ab')
            ->join('proveedores as pr', 'ab.proveedor_id', '=', 'pr.id')
            ->select('ab.valor', 'ab.fecha_de_pago', 'pr.nombre', 'pr.telefono1', 'pr.telefono2', 'pr.id')
            ->whereBetween('ab.fecha_de_pago', [$fecha1, $fecha2])
            ->get();
        return $articulos;
    }

    // retorna las deudas de clientes proximas a pagar
    public function deudas($dias)
    {
        $fecha1 = now()->toDateString();
        $fecha2 = now()->addDays($dias)->toDateString();

        return DB::table('deuda_cliente AS deu')
            ->join('clientes as cli', 'deu.cliente_id', '=', 'cli.id')
            ->select('cli.*', 'deu.*')
            ->where('deu.estado', 'DEUDA')
            ->whereBetween('deu.fecha_pago', [$fecha1, $fecha2])
            ->get();
    }

    // retorna los pagos con cheque a cada proveedor
    public function pago_cheque_proximos($dias)
    {
        $fecha1 = now()->toDateString();
        $fecha2 = now()->addDays($dias)->toDateString();
        $articulos = DB::table('abonos_proveedores as ab')
            ->join('proveedores as pr', 'ab.proveedor_id', '=', 'pr.id')
            ->select('ab.valor', 'ab.fecha_cobro', 'pr.nombre', 'pr.telefono1', 'pr.telefono2', 'pr.id')
            ->whereBetween('fecha_cobro', [$fecha1, $fecha2])
            ->get();
        return $articulos;
    }

    // retorna el total de las deudas de todos los cliente
    public function deudaClientes()
    {
        $deuda = DeudaCliente::all();
        $abono = AbonoCliente::all();

        $t_deuda = 0;
        $t_abono = 0;

        foreach ($deuda as $d) {
            $t_deuda += $d->total;
        }
        foreach ($abono as $d) {
            $t_abono += $d->total;
        }

        return $t_deuda - $t_abono;
    }
}
