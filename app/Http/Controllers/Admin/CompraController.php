<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\Compra;
use App\Models\CompraProveedores;
use App\Models\FacturaProveedor;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    // retorna la vista para comprar articulos
    public function index(Request $request)
    {

        $articulos = DB::table('articulos as art')
            ->join('categoria as cat', 'art.categoria_id', '=', 'cat.id')
            ->select('cat.nombre as nomCat', 'cat.tipo', 'art.nombre', 'art.cod_barras', 'art.descripcion', 'art.p_venta', 'art.p_costo', 'art.stock', 'art.img', 'art.id', 'art.fabricante as talla')
            ->where('art.deleted_at', null)
            ->get();

        return view('admin.articulos.compras', ['articulos' => $articulos, 'vis' => true]);
    }

    public function store(Request $request)
    {
        $articulo = $this->guardar($request);
        return back()->with(['info' => "Factura $articulo, registrada con Exito", 'color' => 'success']);
    }

    // retorna la vista de historial
    public function shows(Request $request)
    {
        $show = false;
        $historias = null;
        if ($request->fin && $request->inicio) {
            $show = true;
            $historias = DB::table('compra_articulos as ca')
                ->join('articulos as art', 'ca.articulo_id', '=', 'art.id')
                ->join('users as use', 'ca.user_id', '=', 'use.id')
                ->select('art.nombre', 'art.descripcion', 'art.img', 'ca.id as idCom', 'ca.factura', 'ca.cantidad', 'ca.fecha', 'art.id', 'ca.user_id', 'use.name', 'art.fabricante as talla')
                ->whereBetween('ca.created_at', [$request->inicio, $request->fin])
                ->orderBy('ca.id', 'DESC')
                ->get();
        }

        return view('admin.articulos.historialCompras', ['articlos' => $historias, 'show' => $show]);
    }

    // guarda la compra de un articulo
    public function guardar(Request $request)
    {

        for ($i = 0; $i < count($request->id_bolsas); $i++) {
            $proveedor = new CompraProveedores();
            $fecha_actual = date("d-m-Y");
            $compra = new Compra();
            $compra->articulo_id = $request->id_bolsas[$i];
            $compra->user_id = Auth::user()->id;
            $compra->cantidad = $request->cantidad_bolsa[$i];
            $compra->factura = $request->descripcion;
            $compra->fecha = date('Y-m-d');
            $compra->fecha_vencimiento =   date("Y-m-d", strtotime($fecha_actual . "+ 1 year"));
            $articulo = Articulo::where('id', $request->id_bolsas[$i])->first();
            $articulo->stock = $articulo->stock + (float) $request->cantidad_bolsa[$i];
            $proveedor->articulo_id = (int) $request->id_bolsas[$i];
            $proveedor->proveedor_id = $articulo->proveedor_id;
            $proveedor->cantidad = $request->cantidad_bolsa[$i];
            $proveedor->factura = $request->descripcion;
            $proveedor->fecha_de_compra = date('Y-m-d');
            $proveedor->save();
            $compra->save();
            $articulo->save();
        }

        return $request->descripcion;
    }

    public function delete($id, $idArt)
    {
        $compra = Compra::find($id);

        $articulo = Articulo::find($idArt);

        $articulo->stock = $articulo->stock - $compra->cantidad;

        $articulo->save();
        $compra->delete();

        return back()->with(['info' => "Compra $articulo->nombre $articulo->descripcion Eliminda con exito", 'color' => 'danger']);
    }

    public function report(Request $request)
    {
        $historias = DB::table('compra_articulos as ca')
            ->join('articulos as art', 'ca.articulo_id', '=', 'art.id')
            ->join('users as user', 'ca.user_id', '=', 'user.id')
            ->select(
                'art.nombre',
                'art.descripcion',
                'art.img',
                'ca.id as idCom',
                'ca.factura',
                'ca.cantidad',
                'ca.fecha',
                'art.id',
                'user.name as userName',
                'art.fabricante as talla'
            )
            ->whereBetween('ca.created_at', [$request->inicio, $request->fin])
            ->orderBy('ca.id', 'DESC')
            ->get();
        return view('admin.reports.articulos.comprasHistorial', ['historial' => $historias]);
    }

    // retorna la vista para registrar un factura de compra
    public function factrura_Create()
    {
        $articulos = Articulo::all();
        $proveedor = Proveedor::all();
        return view('admin.articulos.creat_factura', compact('articulos', 'proveedor'));
    }

    // guarda la facrura de un proveedor
    public function store_factura(Request $request)
    {
        $des = array();

        for ($i = 0; $i < count($request->id_bolsas); $i++) {
            $articulo = Articulo::where('id', $request->id_bolsas[$i])->first();
            array_push($des, ' Compra: ' .  $articulo->nombre . ' ' . $articulo->descripcion . ' Cantidad: ' .  $request->cantidad_bolsa[$i] . '<br> Port un Total de: Q.' . number_format($request->total, 2));
        }

        // dd($request->all());



        if ($request->credito) {
            // registra la factura para un proveedor
            $fecha_actual1 = date("d-m-Y");
            $fatura_proveedor = new FacturaProveedor();
            $fatura_proveedor->proveedor_id = $request->proveedor_id;
            $fatura_proveedor->factura = $request->descripcion;
            $fatura_proveedor->valor = $request->total;
            $fatura_proveedor->fecha_de_pago = date("Y-m-d", strtotime($fecha_actual1 . "+ 8 days"));
            $fatura_proveedor->estado = 'PENDIENTE';
            $fatura_proveedor->fecha_compra = date('Y-m-d');
            // TODO: ADD DESCRIPCION A FACTURA
            $fatura_proveedor->description = implode(" ", $des);
            $fatura_proveedor->save();
        } else {
            // registra la factura para un proveedor
            $fecha_actual1 = date("d-m-Y");
            $fatura_proveedor = new FacturaProveedor();
            $fatura_proveedor->proveedor_id = $request->proveedor_id;
            $fatura_proveedor->factura = $request->descripcion;
            $fatura_proveedor->valor = 0;
            $fatura_proveedor->fecha_de_pago = date("Y-m-d", strtotime($fecha_actual1 . "+ 8 days"));
            $fatura_proveedor->estado = 'PAGADA';
            $fatura_proveedor->fecha_compra = date('Y-m-d');
            // TODO: ADD DESCRIPCION A FACTURA
            $fatura_proveedor->description = implode(" ", $des);
            $fatura_proveedor->save();
        }
        return back()->with(['info' => "factura creada con exito", 'color' => 'success']);
    }
}
