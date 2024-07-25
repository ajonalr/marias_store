<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use App\Models\Cuadre;
use App\Models\DeudaCliente;
use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CajaController extends Controller
{
    public function showEntrdas()
    {
        $entrada = $this->listentrada();
        $total = 0;

        foreach ($entrada as $ent) {
            $total =  $total + $ent->valor;
        }

        return view('admin.caja.entradas', ['entradas' => $entrada, 'total' => $total]);
    }

    public function showSalidas()
    {
        $entrada = $this->listsalida();
        $total = 0;

        foreach ($entrada as $ent) {
            $total =  $total + $ent->valor;
        }

        return view('admin.caja.salidas', ['entradas' => $entrada, 'total' => $total]);
    }

    // guarda una entrada
    public function entrada(Request $data)
    {
        $caja = new Caja();
        $caja->valor = $data->valor;
        $caja->descripcion = $data->descripcion;
        $caja->operacion = 'e';
        $caja->user_id = Auth::user()->id;
        $caja->fecha = date('Y-m-d');
        $caja->save();
        return back()->with(['info' => 'Caja Chica Registrada Con Exito', 'color' => 'success']);
    }

    // guarda una salida
    public function salida(Request $data)
    {

        $caja = new Caja();
        $caja->valor = $data->valor;
        $caja->descripcion = $data->descripcion;
        $caja->operacion = 's';
        $caja->user_id = Auth::user()->id;
        $caja->fecha = date('Y-m-d');
        $caja->tipo = $data->tipo;
        $caja->save();
        return back()->with(['info' => 'Salida de Efectivo Registrada Con Exito', 'color' => 'success']);
    }

    // devuelve un listado de las entradas
    public function listentrada()
    {
        $entrada = DB::table('caja')
            ->where('operacion', 'e')
            ->where('user_id', Auth::user()->id)
            ->whereDate('fecha', date('Y-m-d'))
            ->get();
        return $entrada;
    }

    // devuele un listado de las salidas
    public function listsalida()
    {
        $salida = DB::table('caja')
            ->where('operacion', 's')
            ->where('user_id', Auth::user()->id)
            ->whereDate('fecha', date('Y-m-d'))
            ->get();
        return $salida;
    }

    // muestra la vista para cuader de caja
    public function cuadre()
    {
        $salida = $this->listsalida();

        $totalSalida = 0;
        foreach ($salida as $sal) {
            $totalSalida = $sal->valor + $totalSalida;
        }

        $entrada = $this->listentrada();
        $totalEntrada = 0;
        foreach ($entrada as $ent) {
            $totalEntrada = $totalEntrada + $ent->valor;
        }

        $ventasDiaMino =
            DB::table('venta_articulos')
            ->whereDate('created_at', date('Y-m-d'))
            ->where('credito', 0)
            ->get();
        $totalVentas = 0;
        foreach ($ventasDiaMino as $ven) {
            $totalVentas = $totalVentas + $ven->total;
        }

        $deudas = DB::table('caja')
            ->where('operacion', 'd')
            ->where('user_id', Auth::user()->id)
            ->whereDate('fecha', date('Y-m-d'))
            ->get();

        $t_deuda = 0;
        foreach ($deudas as $deu) {
            $t_deuda += $deu->valor;
        }

        $depositos =  DB::table('facturas as fc')
            ->select(DB::raw('Sum(fc.total) as total_depo'))
            ->whereDate('fc.created_at', date('Y-m-d'))
            ->where('fc.tipo',  'DEPOSITO')
            ->first();

        $abo_cheque = DB::table('abono_clientes')
            ->select(DB::raw('Sum(total) as total_che'))
            ->where('tipo', 'CHEQUE')
            ->whereDate('created_at', date('Y-m-d'))
            ->first();

        $abo_depo = DB::table('abono_clientes')
            ->select(DB::raw('Sum(total) as total_depo'))
            ->where('tipo', 'DEPOSITO')
            ->whereDate('created_at', date('Y-m-d'))
            ->first();


        $total_propina = 0;
        $d = Caja::wheredate('fecha', date('Y-m-d'))->where('operacion', 'propi')->where('user_id', Auth::user()->id)->get();

        foreach ($d as $data) {
            $total_propina += $data->valor;
        }

        return view('admin.caja.cuadre', [
            'entradas' => $totalEntrada, 'salida' => $totalSalida, 'ventas' => $totalVentas, 'deudas' => $t_deuda, 'depositos' => $depositos, 'abo_cheque' => $abo_cheque, 'abo_depo' => $abo_depo, 'propina' => $total_propina
        ]);
    }

    // guarda un cuadre de caja
    public function cuadreStore(Request $data)
    {
        $cuadre = new Cuadre();
        $cuadre->entrada = $data->entrada;
        $cuadre->salida = $data->salida;
        $cuadre->cuadre = $data->cuadre;
        $cuadre->totalEfectico = $data->efectivo;
        $cuadre->faltante = $data->faltante;
        $cuadre->totalVisas = $data->visas;
        $cuadre->depositos = $data->depositos;
        $cuadre->user_id = Auth::user()->id;
        $cuadre->save();
        return back()->with(['info' => 'Cuadre Del Dia Registrado', 'color' => 'success', 'cuadre_id' => $cuadre->id]);
    }

    // retorna el listado de cuadres de caja
    public function cuadrereport()
    {
        $cuadres = DB::table('cuadre as cd')
            ->join('users as us', 'cd.user_id', '=', 'us.id')
            ->select(
                'cd.entrada',
                'cd.salida',
                'cd.cuadre',
                'cd.totalEfectico',
                'cd.faltante',
                'cd.totalVisas',
                'cd.created_at',
                'cd.id',
                'cd.depositos',
                'us.name'

            )
            ->orderBy('created_at', 'desc')
            ->whereMonth('cd.created_at', date('m'))
            ->get();

        return view('admin.reports.exports.cuadre', ['cuadres' => $cuadres]);
    }

    // retorna la vista para cuadre filtrado por mes y año
    public function cuadrereportFilter(Request $request)
    {
        $cuadres = DB::table('cuadre as cd')
            ->join('users as us', 'cd.user_id', '=', 'us.id')
            ->select(
                'cd.entrada',
                'cd.salida',
                'cd.cuadre',
                'cd.totalEfectico',
                'cd.faltante',
                'cd.totalVisas',
                'cd.created_at',
                'cd.id',
                'cd.depositos',
                'us.name'
            )
            ->whereMonth('cd.created_at', $request->mes)
            ->whereYear('cd.created_at', $request->ano)
            ->orderBy('created_at', 'desc')
            ->get();



        return view('admin.reports.exports.cuadre', ['cuadres' => $cuadres]);
    }

    public function deleteCuadre($id)
    {
        $caudre = Cuadre::find($id);
        $caudre->delete();
        return back()->with(['info' => "Cuadre del Dia $caudre->fecha eliminado con Exito", 'color' => 'danger']);
    }

    public function salidaDelete($id)
    {
        $caja = Caja::find($id);
        $caja->delete();
        return back()->with(['info' => "Gasto Eliminada Con exito", 'color' => 'danger']);
    }

    public function entradaDelete($id)
    {
        $caja = Caja::find($id);
        $caja->delete();
        return back()->with(['info' => "Dato Eliminada Con exito", 'color' => 'danger']);
    }

    // retorna la lista para ver hitorial de movimientos
    public function movimientos()
    {
        return view('admin.caja.movimientos');
    }

    // retorna el Reporte de Salidas Filtrado por fecha
    public function salidaReport(Request $request)
    {

        if ($request->tipo === 'TODOS') {
            $data = Caja::where('operacion', 's')
                ->join('users as us', 'caja.user_id', '=', 'us.id')
                ->whereBetween('fecha', [$request->desde, $request->hasta])
                ->get();
            $total = 0;
            foreach ($data as $ta) {
                $total = $total + $ta->valor;
            }
            return view('admin.reports.caja.salidas', ['data' => $data, 'total' => $total]);
        } else {

            $data = Caja::where('operacion', 's')
                ->join('users as us', 'caja.user_id', '=', 'us.id')
                ->where('tipo', $request->tipo)
                ->whereBetween('fecha', [$request->desde, $request->hasta])
                ->get();
            $total = 0;
            foreach ($data as $ta) {
                $total = $total + $ta->valor;
            }
            return view('admin.reports.caja.salidas', ['data' => $data, 'total' => $total]);
        }
    }

    // retorna reporte de Entradas Filtradas por fecha
    public function entradasReport(Request $request)
    {
        $data = $this->operacionFilter($request, 'e');
        $total = 0;
        foreach ($data as $ta) {
            $total = $total + $ta->valor;
        }
        return view('admin.reports.caja.entradas', ['data' => $data, 'total' => $total]);
    }


    // funcios para retornar el listado de operacion deseadas
    public function operacionFilter(Request $request, $operacion)
    {
        $data = Caja::where('operacion', $operacion)
            ->join('users as us', 'caja.user_id', '=', 'us.id')
            ->whereBetween('fecha', [$request->desde, $request->hasta])->get();
        return $data;
    }

    // retorna el total de cuadre por fecha
    public function cuadreFecha($fecha)
    {


        $salida =  DB::table('caja')
            ->where('operacion', 's')
            ->join('users as us', 'caja.user_id', '=', 'us.id')
            ->select('*')
            ->whereDate('fecha', $fecha)
            ->get();
        $entrada = DB::table('caja')
            ->where('operacion', 'e')
            ->select('*')
            ->join('users as us', 'caja.user_id', '=', 'us.id')
            ->whereDate('fecha', $fecha)
            ->get();

        $deudas =  DB::table('caja')
            ->where('operacion', 'd')
            ->whereDate('fecha', $fecha)
            ->get();

        $t_deuda = 0;

        foreach ($deudas as $deu) {
            $t_deuda += $deu->valor;
        }

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
            ->whereDate('ven.created_at', $fecha)
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

        return view('admin.reports.caja.fecha', [
            'salidas' => $salida, 'entradas' => $entrada, 'deuda' => $t_deuda, 'totalventasesperadas' => $totalventasesperadas,  'totaldescuentos' => $totaldescuentos, 'totalventasmenosdescuentos' => $totalventasmenosdescuentos, 'totalganancias' => $totalganancias, 'totalInversion' => $totalInversion, 'ventas' => $ventas
        ]);
    }

    // retorna la vista para poder imprimir el cuadre en la impresora Termica
    public function printCuadre($id)
    {
        $cuadre = Cuadre::find($id);
        return view('admin.reports.caja.cuadreprint', ['data' => $cuadre]);
    }

    // retorna los movimientos filtrados por dia en especifico
    public function movimientos_dia(Request $request)
    {
        $salida =  DB::table('caja')
            ->where('operacion', 's')
            ->join('users as us', 'caja.user_id', '=', 'us.id')
            ->select('*')
            ->whereDate('fecha', $request->fecha)
            ->get();
        $entrada = DB::table('caja')
            ->where('operacion', 'e')
            ->select('*')
            ->join('users as us', 'caja.user_id', '=', 'us.id')
            ->whereDate('fecha', $request->fecha)
            ->get();

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
            ->whereDate('ven.created_at', $request->fecha)
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



        $deudas =  DB::table('caja')
            ->where('operacion', 'd')
            ->whereDate('fecha', $request->fecha)
            ->get();

        $t_deuda = 0;

        foreach ($deudas as $deu) {
            $t_deuda += $deu->valor;
        }


        return view('admin.reports.caja.fecha', [
            'salidas' => $salida, 'entradas' => $entrada,  'deuda' => $t_deuda, 'ventas' => $ventas,
            'totalventasesperadas' => $totalventasesperadas,  'totaldescuentos' => $totaldescuentos, 'totalventasmenosdescuentos' => $totalventasmenosdescuentos, 'totalganancias' => $totalganancias, 'totalInversion' => $totalInversion

        ]);
    }

    // retorna conteo general de ganancias
    public function ganancias(Request $request)
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
            ->whereBetween('ven.created_at', [$request->inicio, $request->fin])
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

        $salida =
            Caja::where('operacion', 's')
            ->join('users as us', 'caja.user_id', '=', 'us.id')
            ->whereBetween('fecha', [$request->inicio, $request->fin])
            ->get();
        $total = 0;
        foreach ($salida as $ta) {
            $total = $total + $ta->valor;
        }


        return view('admin.reports.caja.ganancias', ['ventas' => $ventas, 'totalventasesperadas' => $totalventasesperadas, 'mes' => $request->inicio, 'ano' => $request->fin, 'totaldescuentos' => $totaldescuentos, 'totalventasmenosdescuentos' => $totalventasmenosdescuentos, 'totalganancias' => $totalganancias, 'totalInversion' => $totalInversion, 'salidas' => $salida, 'total' => $total]);
    }
}
