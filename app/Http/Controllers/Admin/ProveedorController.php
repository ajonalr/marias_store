<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbonoProveedor;
use App\Models\FacturaProveedor;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{

    public function index()
    {
        return view('admin.proveedores.index', ['data' => Proveedor::all()]);
    }

    public function create()
    {
        return view('admin.proveedores.create');
    }

    public function store(Request $data)
    {
        $proveedor =  new Proveedor($data->all());
        $proveedor->save();
        return back()->with(['info' => "Proveedor $data->nombre Creado Con Exito", 'color' => 'success']);
    }

    public function show($id)
    {
        $prove = Proveedor::find($id);
        $facturas = FacturaProveedor::where('proveedor_id', $id)
            ->orderBy('id', 'ASC')
            ->count();


        $facturas2 =
            DB::table('facturas_proveedor as fc')
            ->where('fc.proveedor_id', $id)
            ->orderBy('id', 'DESC')
            ->get();


        return view('admin.proveedores.show', ['data' => $prove, 'numero' => $facturas, 'facturas' => $facturas2]);
    }

    public function update(Request $request, $id)
    {
        Proveedor::find($id)->update($request->all());
        return back()->with(['info' => 'Datos Actualizado Con Exito', 'color' => 'warning']);
    }

    // retorna el reporte de todos los proveedores
    public function reporte()
    {
        return view('admin.reports.proveedores.index', ['data' => Proveedor::all()]);
    }


    // guarda una fatura para el proveedor
    public function facturacreate(Request $request)
    {

        $request->estado = 'PENDIENTE';
        $fatura_proveedor = new FacturaProveedor($request->all());
        $fatura_proveedor->save();

        return back()->with(['info' => 'Factura Asignada con Exito', 'color' => 'success']);
    }

    public function facturadelete($id)
    {
        $factura = FacturaProveedor::find($id);

        $factura->delete();
        return back()->with(['info' => 'Factura Eliminada con Exito', 'color' => 'danger']);
    }

    // retora un listado de las abonos de cada proveedor y apartado para poder abonar 
    public function abonos($id)
    {
        // para pasar abonos y calcular total abono
        $abono = AbonoProveedor::where('proveedor_id', $id)->get();
        $total_abono  = 0;
        foreach ($abono as $d) {
            $total_abono = $total_abono + $d->valor;
        }

        // para calcular el total de la deuda
        $facturas = FacturaProveedor::where('proveedor_id', $id)->get();
        $deuda = 0;
        foreach ($facturas as $d) {
            $deuda = $deuda + $d->valor;
        }

        $deuda = $deuda - $total_abono;

        return view('admin.reports.exports.abonosproveedor', ['data' => $abono, 'id' => $id, 'deuda' => $deuda, 'abonado' => $total_abono]);
    }

    // guarda un abono para un proveedor 
    public function abonoRegistro(Request $data)
    {
        $abono = new  AbonoProveedor($data->all());
        $abono->save();
        return back()->with(['info' => 'Abono registrado con Exito', 'color' => 'success']);
    }


    // retonra grafias estadisticas de articulos mas comprados
    public function mascomprado($id)
    {
        $data =  DB::table('compra_proveedores')
            ->join('articulos as art', 'compra_proveedores.articulo_id', '=', 'art.id')
            ->select(DB::raw('COUNT(compra_proveedores.articulo_id) as idArticulo'), 'compra_proveedores.factura', 'art.nombre', 'art.descripcion')
            ->where('compra_proveedores.proveedor_id', $id)
            ->groupBy('compra_proveedores.articulo_id')
            ->orderBy(DB::raw('compra_proveedores.articulo_id'), 'desc')
            ->limit(25)
            ->get();

        // dd($data);
        $data2 = array();

        foreach ($data as $d) {
            array_push($data2, $d);
        }
        return view('admin.reports.proveedores.mascomprado', ['masVendidos' => $data2]);
    }


    // elimina un abono
    public function deleteAbono($id)
    {
        $abono  =  AbonoProveedor::find($id);
        $abono->delete();
        return back()->with(['info' => 'Abono Eliminar con Exito', 'color' => 'danger']);
    }

    public function delete($id)
    {
        $pro = Proveedor::find($id);
        $pro->delete();
        return back()->with(['info' => 'Proveedor Eliminado Con Exito', 'color' => 'danger']);
    }


    // retorna el reporte para ver los proveedores a los que les debemos
    public function getAllDeudaToProveedo()
    {

        $proveedores =  Proveedor::all();

        $t_abono = 0;
        $t_pago = 0;
        $aux = array();

        foreach ($proveedores as $p) {

            $abonos = DB::table('abonos_proveedores')
                ->select(DB::raw('SUM(valor) as total_abono'))
                ->where('proveedor_id', $p->id)
                ->first();

            $fac = DB::table('facturas_proveedor')
                ->select(DB::raw('SUM(valor) as total_deuda'))
                ->where('proveedor_id', $p->id)
                ->first();


            array_push($aux, ['a' => $abonos, 'f' => $fac, 'p' => $p]);
        }
        // dd($aux[0]['a']);

        return view('admin.reports.proveedores.acreedores', ['data' => $aux]);
    }

    // retorna la vista para poder generar reportes
    public function reportes()
    {
        return view('admin.proveedores.reporte');
    }

    // retorna el reporte de los abonos realizados a los proveedores
    public function reportToAbono(Request $request)
    {
        $abonos = AbonoProveedor::whereBetween('created_at', [$request->inicio, $request->fin])->get();

        return view('admin.reports.proveedores.abonos', ['abonos' => $abonos]);
    }

    // cambia el estado de la factuda de un proveedor
    public function changeTipoToFactura($id)
    {
        $f = FacturaProveedor::findOrFail($id);
        $f->estado = 'PAGADA';
        $f->save();

        return back()->with(['info' => 'FACTURA ACTUALIZADA', 'color' => 'success']);
    }

    // retorna el reportes de las facturas emitidas desde compras
    public function facturas_compras(Request $request)
    {
        $fac =
            FacturaProveedor::whereBetween('created_at', [$request->inicio, $request->fin])->get();

        return view('admin.reports.proveedores.facturas', compact('fac'));
    }
}
