<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbonoProyecto;
use App\Models\Cliente;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{

    public function index()
    {
        $data = Proyecto::all();
        return view('admin.proyecto.index', compact('data'));
    }


    public function create()
    {
        $clientes = Cliente::all();
        return view('admin.proyecto.create', compact('clientes'));
    }


    public function store(Request $request)
    {
        request()->validate(Proyecto::$rules);
        $proyecto = Proyecto::create($request->all());
        return redirect()->route('proyectos.index')
            ->with(['info' => 'Proyecto ' . $proyecto->nombre . ' Registrado con exito', 'color' => 'success']);
    }


    public function show($id)
    {
        $proyecto = Proyecto::find($id);
        $abonos = AbonoProyecto::where('proyecto_id', $id)->get();
        $t_abono = 0;

        foreach ($abonos as $data) {
            $t_abono += $data->valor;
        }

        


        return view('admin.proyecto.show', ['proyecto' => $proyecto, 'abonos' => $abonos, 't_abono' => $t_abono]);
    }

    public function edit($id)
    {
        $proyecto = Proyecto::find($id);


        return view('admin.proyecto.edit', ['data' => $proyecto, 'clientes' => Cliente::all()]);
    }


    public function update(Request $request, Proyecto $proyecto)
    {
        request()->validate(Proyecto::$rules);

        $proyecto->update($request->all());

        return back()->with(['info' => 'proyecto actualizado con exito', 'color' => 'success']);
    }


    public function destroy($id)
    {
        $proyecto = Proyecto::find($id)->delete();

        return redirect()->route('proyectos.index')
            ->with(['info' => 'proyecto elimiando con exito', 'color' => 'success']);
    }
}
