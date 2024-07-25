<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\Auxiliar;
use App\Models\Cliente;
use App\Models\Cotizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
    public function index()
    {
        $articulos = Articulo::all();
        return view('admin.ventas.cotizacion', ['articulos' => $articulos]);
    }

    public function store(Request $data)
    {

        $codigo = date("Ymdhis");

        $vuelta =  count($data->idArticulos);
        for ($i = 0; $i < $vuelta; $i++) {
            $coti = new Cotizacion();
            $coti->articulo_id = $data->idArticulos[$i];
            $coti->nombre = $data->nombre;
            $coti->nit = $data->nit;
            $coti->codigo = $codigo;
            $coti->cantidad = $data->cantidad[$i];
            // $coti->descuento = $data->descuento[$i];
            $coti->total = $data->subtotal[$i];
            $coti->save();
        }

        return back()->with(['info' => 'Cotizacion Guardad Controller Exito', 'color' => 'success']);
    }

    public function list()
    {
        $data = Cotizacion::groupBy('codigo')->orderBy('codigo', 'asc')->get();

        return view('admin.cotizacion.list', ['data' => $data]);
    }

    public function show($codigo)
    {
        $data = DB::table('cotizacion as cot')
            ->join('articulos as art', 'cot.articulo_id', '=', 'art.id')
            ->join('clientes as cli', 'cot.cliente_id', '=', 'cli.id')
            ->select('art.nombre', 'art.p_venta', 'cli.nombre as cliente', 'cli.nit', 'cot.cantidad', 'cot.total', 'art.descripcion', 'art.stock')
            ->where('codigo', '=', $codigo)
            ->get();

        return view('admin.cotizacion.show', ['data' => $data, 'codigo' => $codigo]);
    }


    // retorna la vista para poder imprimir una cotizacion en impresora termica
    public function print_cotizacion($codigo)
    {
        $data = DB::table('cotizacion as cot')
            ->join('articulos as art', 'cot.articulo_id', '=', 'art.id')
            ->join('clientes as cli', 'cot.cliente_id', '=', 'cli.id')
            ->select('art.nombre', 'art.p_venta', 'cli.nombre as cliente', 'cli.nit', 'cot.cantidad', 'cot.total', 'art.descripcion', 'art.stock', 'cot.cliente_id', 'cot.created_at', 'cot.aux_id')
            ->where('codigo', '=', $codigo)
            ->get();
        $cliente = Cliente::find($data[0]->cliente_id);
        $aux = Auxiliar::find($data[0]->aux_id);
        $fecha = $data[0]->created_at;

        return view('admin.reports.cotizacion.cotizacion', ['deuda' => $data, 'codigo' => $codigo, 'cliente' => $cliente, 'fecha' => $fecha, 'factura' => $aux]);
    }
}
