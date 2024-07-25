<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbonoProyecto;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class AbonoProyectoController extends Controller
{



    public function store(Request $request)
    {
        AbonoProyecto::create($request->all());

        return back()->with(['info' => 'Abono Registrado con Exito', 'color' => 'success']);
    }


    public function destroy($id)
    {
        AbonoProyecto::findOrFail($id)->delete();
        return back()->with(['info' => 'abono eliminad con Exito', 'color' => 'success']);
    }

    // imprimer el recibo de un abono
    public function print_abono($id)
    {

        $abono = AbonoProyecto::findOrFail($id);

        $proyecto = Proyecto::findOrFail($abono->proyecto_id);

        return view('admin.reports.proyect.abono', ['ab' => $abono, 'pc' => $proyecto]);
    }
}
