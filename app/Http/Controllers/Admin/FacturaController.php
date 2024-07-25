<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{

    // retorna la vista de las facturas con fecha actual
    public function index()
    {
        $factura = Factura::where('factura', 'SI')
            ->whereDate('created_at', date('Y-m-d'))
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.facturas.facturas', ['data' => $factura, 'filtro' => false]);
    }

    // retorna el recibo de la factura
    public function factura($id)
    {

        $deuda = DB::table('venta_articulos AS ven')
            ->join('clientes AS cli', 'ven.cliente_id', '=', 'cli.id')
            ->join('articulos AS art', 'ven.articulo_id', '=', 'art.id')
            ->join('facturas AS fac', 'ven.factura_id', '=', 'fac.id')
            ->select(
                'ven.id',
                'ven.factura_id',
                'ven.cantidad',
                'ven.cliente_id',
                'ven.total',
                'ven.credito',
                'ven.descuento',
                'ven.created_at as fechaVenta',
                'cli.nombre',
                'cli.direccion',
                'cli.telefono1',
                'cli.nit',
                'cli.telefono2',
                'art.nombre as nomArt',
                'art.cod_barras',
                'art.descripcion',
                'art.p_venta',
                'fac.descuento as facDescuento',
                'fac.total as facTotal',
                'fac.descripcion as facDesc'
            )
            ->where('ven.credito', 0)
            ->where('ven.factura_id', $id)
            ->get();

        $facturaVenta = Factura::find($id);
        $totalDeuda = 0;
        $nombre = '';
        $fecha = date('Y');
        $nit = 0;
        $descuento_articulo = 0;
        $sin_desc = 0;
        $mayorista = false;
        $facTotal = 0;
        $aux3 = 0;

        foreach ($deuda as $deu) {
            $totalDeuda =  $deu->total + $totalDeuda;
            $nombre = $deu->nombre;
            $fecha = $deu->fechaVenta;
            $nit = $deu->nit;
            $descuento_articulo = $descuento_articulo + $deu->descuento;
            $sin_desc = ($sin_desc + $deu->p_venta) * $deu->cantidad;
            $facTotal = $deu->facTotal;
        }

        return view('admin.reports.ventas.venta', ['deuda' => $deuda, 'totalDeuda' => $totalDeuda, 'cliente' => $nombre, 'factura' => $facturaVenta, 'fecha' => $fecha, 'nit' => $nit, 'descuetoArticulos' => $descuento_articulo, 'sin_desc' => $sin_desc, 'mayorista' => $mayorista, 'facTotal' => $facTotal, 'totalSinDecMayo' => $aux3]);
    }

    // retorna la vista para filtrar facturas
    public function filtrados(Request $data)
    {
        $mes  = date('m');
        if ($data->mes) {
            $mes = $data->mes;
        }

        $ano = date('Y');
        if ($data->ano) {
            $ano = $data->ano;
        }

        $factura = Factura::where('factura', 'SI')
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.facturas.facturas', ['data' => $factura, 'filtro' => true]);
    }

    // retorna la vista para generar repostes
    public function reportes()
    {
        return view('admin.facturas.reporte');
    }

    // RETORNA EL REPORTE DE PAGOS MENSUALES DE FGACTURAS
    public function reporteMensual(Request $data)
    {
        $mes  = date('m');
        if ($data->mes) {
            $mes = $data->mes;
        }

        $ano = date('Y');
        if ($data->ano) {
            $ano = $data->ano;
        }

        $factura = Factura::where('factura', 'SI')
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->orderBy('id', 'DESC')
            ->get();


        return view('admin.reports.ventas.facturasMes', ['data' => $factura, 'por' => $data->por]);
    }
}
