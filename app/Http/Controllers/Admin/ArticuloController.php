<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\IngredienteArticulo;
use App\Models\Proveedor;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticuloController extends Controller
{
    public function index()
    {

        $articulo = DB::table('articulos as art')
            ->join('categoria as cat', 'art.categoria_id', '=', 'cat.id')
            ->select(
                'cat.nombre as nomCat',
                'art.nombre',
                'art.cod_barras',
                'art.descripcion',
                'art.p_venta',
                'art.stock',
                'art.id',
                'art.descripcion_interna',
                'art.min_stock',
            )
            ->where('art.deleted_at', null)
            ->get();

        return view('admin.articulos.index', ['articulos' => $articulo, 'categoria' => Categoria::all()]);
    }

    public function create()
    {
        return view('admin.articulos.create', ['categoria' => Categoria::all(), 'proveedor' => Proveedor::all()]);
    }

    public function store(Request $request)
    {

        if (Articulo::where('cod_barras', 'X' . $request->cod_barras)->first()) {
            return back()->with(['info' => "Articulo con codigo de barras ya registrado", 'color' => 'danger']);
        }

        $articulo = new Articulo();
        $articulo->nombre = $request->nombre;
        $articulo->categoria_id = $request->categoria_id;
        $articulo->proveedor_id = $request->proveedor_id;
        $code = '';
        if (!$request->cod_barras) {
            $code = 'X' . date("mYdihs");
            $articulo->cod_barras = $code;
        } else {

            $articulo->cod_barras = 'x' . $request->cod_barras;
        }

        $articulo->descripcion = $request->descripcion;
        // $articulo->descripcion_interna = "$request->descripcion_interna <br>
        // Minimo:$request->minimo1 / Maximo:$request->maximo1 / Precio:$request->precio1 <br>
        // Minimo:$request->minimo2 / Maximo:$request->maximo2 / Precio:$request->precio2 <br>
        // Minimo:$request->minimo3 / Maximo:$request->maximo3 / Precio:$request->precio3 <br>
        // ";
        $articulo->p_venta = $request->p_venta;
        $articulo->p_costo = $request->p_costo;
        $articulo->stock = $request->stock;
        $articulo->img = $request->img;
        $articulo->img2 = $request->img2;
        $articulo->min_stock = $request->min_stock;
        $articulo->p_descuento = $request->p_descuento;
        $articulo->url_articulo = $request->url_articulo;
        $articulo->fecha_ven = $request->fecha_ven;
        $articulo->fabricante = $request->fabricante;
        $articulo->stock_maximo = $request->stock_maximo;
        $articulo->medida = $request->medida;
        $articulo->unidad = $request->unidad;
        $articulo->ubicacion = $request->ubicacion;
        $articulo->eti_equivalente = $request->eti_equivalente;
        $articulo->eti_carro = $request->eti_carro;
        $articulo->minimo1 = $request->minimo1;
        $articulo->maximo1 = $request->maximo1;
        $articulo->precio1 = $request->precio1;
        $articulo->minimo2 = $request->minimo2;
        $articulo->maximo2 = $request->maximo2;
        $articulo->precio2 = $request->precio2;
        $articulo->minimo3 = $request->minimo3;
        $articulo->maximo3 = $request->maximo3;
        $articulo->precio3 = $request->precio3;

        $articulo->save();

        return back()->with(['info' => "Articulo $articulo->nombre registrado con exito", 'color' => 'success', 'articulo_id' => $articulo->id]);
    }

    public function show($id)
    {
        $articulo = DB::table('articulos as art')
            ->join('categoria as cat', 'art.categoria_id', '=', 'cat.id')
            ->join('proveedores as prove', 'art.proveedor_id', '=', 'prove.id')
            ->select(
                'cat.nombre as nomCat',
                'cat.tipo',
                'art.nombre',
                'art.cod_barras',
                'art.descripcion',
                'art.p_venta',
                'art.p_costo',
                'art.stock',
                'art.img',
                'art.img2',
                'art.id',
                'art.fecha_promo',
                'art.created_at',
                'art.descripcion_interna',
                'art.min_stock',
                'art.p_descuento',
                'art.categoria_id',
                'art.url_articulo',
                'art.stock_maximo',
                'art.fabricante',
                'art.medida',
                'art.unidad',
                'art.ubicacion',
                'art.eti_equivalente',
                'art.eti_carro',
                'prove.nombre as provName',
                'prove.empresa',
                'prove.direccion',
                'prove.telefono1',
                'prove.telefono2',
                'prove.id as proveId',
                'prove.articulos',

                'art.minimo1',
                'art.maximo1',
                'art.precio1',
                'art.minimo2',
                'art.maximo2',
                'art.precio2',
                'art.minimo3',
                'art.maximo3',
                'art.precio3',

            )
            ->where('art.id', $id)
            ->first();

            $ingre = IngredienteArticulo::where('articulo_id', $id)->get();


        return view('admin.articulos.show', ['articulo' => $articulo, 'categoria' => Categoria::all(), 'proveedor' => Proveedor::all(), 'ingredients' => $ingre]);
    }

    public function update(Request $request, $id)
    {
        $this->actualizar($request, $id);
        return back()->with(['info' => "Articulo actualizado con exito", 'color' => 'warning']);
    }

    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        $articulo->forceDelete();
        return back()->with(['info' => "Articulo $articulo->nombre  $articulo->descripcion Eliminado con exito", 'color' => 'danger']);
    }

    // retorna la vista pra el control de stock
    public function controlStock()
    {
        $articulo = Articulo::all();
        return view('admin.articulos.contro_stock', ['articulos' => $articulo]);
    }

    public function actualizar(Request $request, $id)
    {
        return  Articulo::find($id)->update($request->all());
    }

    // devuelve la lista de reportes para articulos
    public function reportes()
    {
        $data = Articulo::all();
        return view('admin.articulos.reportes', compact('data'));
    }

    // devuelve un listado de todos los articulos
    public function reportAll()
    {
        $articulos = DB::table('articulos as art')
            ->join('categoria as cat', 'art.categoria_id', '=', 'cat.id')
            ->join('proveedores as pr', 'art.proveedor_id', '=', 'pr.id')
            ->select(
                'cat.nombre as nomCat',
                'cat.tipo',
                'art.nombre',
                'art.cod_barras',
                'art.descripcion',
                'art.p_venta',
                'art.p_costo',
                'art.stock',
                'art.img',
                'art.id',
                'art.stock_maximo',
                'art.fabricante',
                'art.medida',
                'art.unidad',
                'art.ubicacion',
                'art.eti_equivalente',
                'art.eti_carro',
                'art.created_at',
                'pr.nombre as p_nombre',
                'pr.empresa as p_empresa'

            )
            ->where('art.deleted_at', null)
            ->get();
        $total = 0;

        foreach ($articulos as $art) {
            $total++;
        }

        return view('admin.reports.articulos.all', ['articulos' => $articulos, 'total' => $total]);
    }

    // devuelve un listado de todos los articulos con stock < 5
    public function reportAllmin()
    {
        $articulos = Articulo::all();
        $total = 0;


        return view('admin.reports.articulos.allmin', ['articulos' => $articulos, 'total' => $total]);
    }

    public function stockControl()
    {

        $articulos = DB::table('articulos as art')
            ->join('categoria as cat', 'art.categoria_id', '=', 'cat.id')
            ->join('proveedores as pr', 'art.proveedor_id', '=', 'pr.id')
            ->select(
                'cat.nombre as nomCat',
                'cat.tipo',
                'art.nombre',
                'art.cod_barras',
                'art.descripcion',
                'art.p_venta',
                'art.p_costo',
                'art.stock',
                'art.img',
                'art.id',
                'art.stock_maximo',
                'art.fabricante',
                'art.medida',
                'art.unidad',
                'art.ubicacion',
                'art.eti_equivalente',
                'art.eti_carro',
                'art.created_at',
                'pr.nombre as p_nombre',
                'pr.empresa as p_empresa'
            )
            ->where('art.deleted_at', null)
            ->get();

        return view('admin.reports.articulos.stock', [
            'articulos' => $articulos, 'total' => Articulo::count()
        ]);
    }

    public function articulosvendidos(Request $data)
    {
        $vendidios = DB::table('venta_articulos AS ven')
            ->join('clientes AS cli', 'ven.cliente_id', '=', 'cli.id')
            ->join('articulos AS art', 'ven.articulo_id', '=', 'art.id')
            ->join('facturas AS fac', 'ven.factura_id', '=', 'fac.id')
            ->select(
                'ven.id',
                'ven.factura_id',
                'ven.articulo_id',
                'ven.cantidad',
                'ven.created_at as fechaVenta',
                'art.nombre as nomArt',
                'art.cod_barras',
                'art.descripcion'

            )
            ->whereMonth('ven.created_at', $data->mes)
            ->whereYear('ven.created_at', $data->ano)
            ->where('art.deleted_at', null)

            ->get();


        return view('admin.reports.articulos.vendidos', ['articulos' => $vendidios]);
    }

    // imprime el codigo de barras de un articulos 
    public function dataPrint($id)
    {
        $articulo = Articulo::find($id);
        return view('admin.reports.articulos.print-data', ['articulo' => $articulo]);
    }

    // retorna el reporte de los articulos filrados por fecha
    public function registerToDate(Request $request)
    {
        $data = Articulo::whereBetween('created_at', [$request->inicio, $request->fin])->get();
        $total = 0;
        foreach ($data as $key) {
            $total++;
        }

        return view('admin.reports.articulos.all', ['articulos' => $data, 'total' => $total]);
    }

    // retorna la vista tal y como esta en la base de datos para poder actualizar y eliminar
    public function articuloDB()
    {

        $articulos = Articulo::withTrashed()->get();

        return view('admin.articulos.db', compact('articulos'));
    }

    // retorna la lista de un articulo vendido por fecha
    public function articulo_vendido(Request $request)
    {
        $data = Ventas::where('articulo_id', $request->articulo_id)->whereBetween('created_at', [$request->inicio, $request->fin])->get();
        $articulo = Articulo::find($request->articulo_id);

        $totalventasesperadas = 0;
        $totaldescuentos = 0;
        $totalventasmenosdescuentos = 0;
        $totalganancias = 0;
        $totalInversion = 0;

        foreach ($data as $ven) {
            $totalventasesperadas += $ven->total + $ven->descuento;
            $totaldescuentos +=  $ven->descuento;
            $totalventasmenosdescuentos += $ven->total;/*  */
        }

        return view('admin.reports.articulos.ventasdetail', compact('data', 'totalventasesperadas', 'totaldescuentos', 'totalventasmenosdescuentos', 'totalganancias', 'totalInversion', 'articulo'));
    }
}
