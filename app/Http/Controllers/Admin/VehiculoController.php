<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{


    public function index()
    {
        return view('admin.vehiculos.index', ['vehiculos' => Vehiculo::all()]);
    }

    public function create()
    {
        return view('admin.vehiculos.create');
    }

    public function store(Request $request)
    {
        Vehiculo::create($request->all());
        return back()->with(['info' => 'vehiculo registrado con exito', 'color' => 'success']);
    }

    public function show($id)
    {
        return view('admin.vehiculos.show', ['vehiculo' => Vehiculo::findOrFail($id)]);
    }

    public function delete($id)
    {
        Vehiculo::findOrFail($id)->delete();
        return back()->with(['info' => 'vehiculo eliminado con exito', 'color' => 'success']);
    }

    public function update(Request $request, $id)
    {
        Vehiculo::findOrFail($id)->update($request->all());
        return back()->with(['info' => 'vehiculos actulizado con exito', 'color' => 'success']);
    }

    public function reportAll()
    {
        $ve = Vehiculo::all();
        return view('admin.reports.vehiculos.all', ['dat' => $ve]);
    }
}
