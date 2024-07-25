<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Traking;
use Illuminate\Http\Request;

class TrakingController extends Controller
{
    public function index()
    {
        // retorna los tracking's que ya han sido entregados
        $trackingEntre = Traking::where('estado', true)->get();


        // retorna los trackig's que no han sido entregados
        $trackingFalt = Traking::where('estado', false)->get();


        return view('admin.trakings.index', ['entre' => $trackingEntre, 'falta' => $trackingFalt]);
    }

    public function store(Request $data)
    {
        $tracking = new Traking();
        $tracking->descripcion = $data->descripcion;
        $tracking->traking = $data->traking;
        $tracking->precio = $data->costo;
        $tracking->estado = $data->estado;
        $tracking->save();
        return back()->with(['info' => 'Datos Guardados con Exito', 'color' => 'success']);
    }

    public function entre($id)
    {
        $tracking = $this->find($id);
        $tracking->estado = !$tracking->estado;
        $tracking->save();
        return back()->with(['info' => "Tracking: $tracking->traking modificafo con exito", 'color' => 'warning']);
    }

    public function regresar($id)
    {
        $tracking = $this->find($id);
        $tracking->estado = !$tracking->estado;
        $tracking->save();
        return back()->with(['info' => "Tracking: $tracking->traking modificafo con exito", 'color' => 'warning']);
    }

    public function destroy($id)
    {
        $tracking = $this->find($id);
        $tracking->delete();
        return back()->with(['info' => "Tracking eliminado con exito", 'color' => 'danger']);

    }

    public function find($id)
    {
        return Traking::find($id);
    }
}
