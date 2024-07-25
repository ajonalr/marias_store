<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MobiliarioEquipo;
use Illuminate\Http\Request;

class MobiliarioEquipoController extends Controller
{
    public function index()
    {
        return view('admin.mobiliarios.index', ['mobiliarios' => MobiliarioEquipo::all()]);
    }

    public function create()
    {
        return view('admin.mobiliarios.create');
    }

    public function store(Request $request)
    {
        MobiliarioEquipo::create($request->all());
        return back()->with(['info' => 'mobiliario registrado con exito', 'color' => 'success']);
    }

    public function show($id)
    {
        return view('admin.mobiliarios.show', ['mobiliario' => MobiliarioEquipo::findOrFail($id)]);
    }

    public function delete($id)
    {
        MobiliarioEquipo::findOrFail($id)->delete();
        return back()->with(['info' => 'mobiliario eliminado con exito', 'color' => 'success']);
    }

    public function update(Request $request, $id)
    {
        MobiliarioEquipo::findOrFail($id)->update($request->all());
        return back()->with(['info' => 'mobiliario actulizado con exito', 'color' => 'success']);
    }

    // reporte
    public function reporte()
    {
        return view('admin.mobiliarios.reporte');
    }

    // retirna el reporte de toso los mobiliario registrados
    public function allreport()
    {
        return view('admin.reports.mobiliario.all', ['dat' => MobiliarioEquipo::all(), 'visible' => true]);
    }

    // retirna el reporte de toso los mobiliario registrados si datos sensibles
    public function allcontrol()
    {
        return view('admin.reports.mobiliario.all', ['dat' => MobiliarioEquipo::all(), 'visible' => false]);
    }
}
