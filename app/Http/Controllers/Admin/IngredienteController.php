<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\CompraIngrediente;
use App\Models\Ingrediente;
use App\Models\IngredienteArticulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IngredienteController extends Controller
{
    function index()
    {
        $data = Ingrediente::all();

        return view('admin.ingrediente.index', compact('data'));
    }

    function store(Request $request)
    {
        Ingrediente::create($request->all());

        return back()->with(['info' => 'Todo Ok', 'color' => 'success']);
    }

    function update(Request $request, $id)
    {
        Ingrediente::find($id)->update($request->all());
        return back()->with(['info' => 'Todo Ok', 'color' => 'success']);
    }

    function delete($id)
    {
        Ingrediente::find($id)->delete();
        return back()->with(['info' => 'Todo Ok', 'color' => 'success']);
    }

    function show(Ingrediente $ing)
    {

        return view('admin.ingrediente.show', compact('ing'));
    }

    function ingredienteMenuf()
    {
        $ingre = Ingrediente::all();
        $menu = Articulo::all();
        return view('admin.ingrediente.new', compact('ingre', 'menu'));
    }

    function store_ingredienteMenu(Request $request)
    {
        for ($i = 0; $i < count($request->ingrediente_v); $i++) {

            $d = new IngredienteArticulo();
            $d->articulo_id = $request->id_bolsas[$i];
            $d->ingrediante_id = $request->ingrediente_v[$i];
            $d->cantidad = $request->cantidad_bolsa[$i];
            $d->save();
        }
        return back()->with(['info' => 'Todo Ok', 'color' => 'success']);
    }

    function deleteIngredienteMenu(IngredienteArticulo $d)
    {
        $d->delete();
        return back()->with(['info' => 'Ingrediente Eliminado', 'color' => 'success']);
    }

    // compra de ingrediente

    function compra_index()
    {
        $ingredientes = Ingrediente::all();
        return view('admin.ingrediente.compra', compact('ingredientes'));
    }

    function compra_store(Request $request)
    {
        for ($i = 0; $i < count($request->id_bolsas); $i++) {

            $fecha_actual = date("d-m-Y");
            $compra = new CompraIngrediente();
            $compra->ingrediente_id = $request->id_bolsas[$i];
            $compra->user_id = Auth::user()->id;
            $compra->cantidad = $request->cantidad_bolsa[$i];
            $compra->factura = $request->descripcion;
            $compra->fecha = date('Y-m-d');
            $compra->fecha_vencimiento =   date("Y-m-d", strtotime($fecha_actual . "+ 2 month"));
            $articulo = Ingrediente::where('id', $request->id_bolsas[$i])->first();
            $articulo->stock = $articulo->stock + (float) $request->cantidad_bolsa[$i];
            $compra->save();
            $articulo->save();
        }
        return back()->with(['info' => "Compra registrada con Exito", 'color' => 'success']);
    }


    function reportes()
    {

        return view('admin.ingrediente.repotes');
    }

    function report_allIngredient()
    {
        $ingredientes = Ingrediente::all();
        return view('admin.reports.ingrediente.all', compact('ingredientes'));
    }

    function reporte_hitorial(Request $request)
    {
        $ingredientes = CompraIngrediente::whereBetween('created_at', [$request->inicio, $request->fin])
            ->get();
        return view('admin.reports.ingrediente.compras', compact('ingredientes'));
    }

    function delete_compra(CompraIngrediente $cmp)
    {


        $ingrediente =   Ingrediente::find($cmp->ingrediente_id);
        $ingrediente->stock -= $cmp->cantidad;
        $ingrediente->save();
        $cmp->delete();

        return back()->with(['info' => "Compra Eliminada con Exito", 'color' => 'success']);

    }
}
