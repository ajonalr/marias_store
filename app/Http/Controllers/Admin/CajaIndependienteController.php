<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CajaIndependiente;
use Illuminate\Http\Request;

class CajaIndependienteController extends Controller
{
    public function index()
    {
        $data = CajaIndependiente::all();
        return view('admin.cajaindependiente.index', compact('data'));
    }

  

    public function store(Request $request)
    {
        CajaIndependiente::create($request->all());
        return back()->with(['info' => 'Dato de caja asignado con exito', 'color' => 'success']);
    }

    public function show($id)
    {
        $data = CajaIndependiente::findOrFail($id);
        return view('admin.cajaindependiente.show', ['data' => $data]);
    }

 

    public function update(Request $request, $id)
    {
        CajaIndependiente::findOrFail($id)->update($request->all());
        return back()->with(['info' => 'dato actualizado con exito', 'color' => 'success']);
    }

    public function destroy($id)
    {
        CajaIndependiente::findOrFail($id)->delete();
        return back()->with(['info' => 'dato eliminado', 'color' => 'success']);
    }
}
