<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return view('admin.categorias.index', ['categorias' => Categoria::all()]);
    }

    public function show($id)
    {
        return view('admin.categorias.show', ['categoria' => Categoria::find($id)]);
    }

    public function update(Request $data, $id)
    {
        $categoria = Categoria::find($id);
        $categoria->nombre = $data->nombre;
        $categoria->tipo = $data->tipo;

        $categoria->save();

        return back()->with(['info' => "Tipode Venta $categoria->nombre Actualizada Con exito", 'color' => 'info']);
    }

    public function store(Request $data)
    {
        $categoria = new Categoria();
        $categoria->nombre = $data->nombre;
        $categoria->tipo = $data->tipo;

        $categoria->save();

        return back()->with(['info' => "Tipo de Venta $categoria->nombre Guardada Con exito", 'color' => 'success']);
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function delete($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        return back()->with(['info' => "Tipo de Venta $categoria->nombre Eliminda Con exito", 'color' => 'danger']);
    }

    public function reporte()
    {
        return view('admin.reports.categorias.categorias', ['categorias' => Categoria::all()]);
    }
}
