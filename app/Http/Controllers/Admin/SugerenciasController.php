<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sugerencias;
use Illuminate\Http\Request;

class SugerenciasController extends Controller
{

    public function index()
    {
        $sugerencias = Sugerencias::orderBy('id', 'desc')->get();
        return view('admin.sugerencias.index', ['data' => $sugerencias]);
    }

    public function store(Request $data)
    {
        Sugerencias::create($data->all());
        return back()->with(['info' => 'sugerencias guardada con exito', 'color' => 'success']);
    }

    public function destroy($id)
    {
        Sugerencias::findOrFail($id)->delete();

        return back()->with(['info' => 'sugerencia eliminada', 'color' => 'success']);
    }
}
