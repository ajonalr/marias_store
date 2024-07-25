<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CuadreCaja;
use Illuminate\Http\Request;

class CuadreCajaController extends Controller
{
    public function index()
    {
        $data = CuadreCaja::all();
        return view('admin.caudrecaja.index', compact('data'));
    }

    public function store(Request $request)
    {
        CuadreCaja::create($request->all());
        return back()->with(['info' => 'Dato de CUADRE asignado con exito', 'color' => 'success']);
    }

    public function show($id)
    {
        $data = CuadreCaja::findOrFail($id);
        return view('admin.caudrecaja.show', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        CuadreCaja::findOrFail($id)->update($request->all());
        return back()->with(['info' => 'dato actualizado con exito', 'color' => 'success']);
    }

    public function destroy($id)
    {
        CuadreCaja::findOrFail($id)->delete();
        return back()->with(['info' => 'dato eliminado', 'color' => 'success']);
    }
}
