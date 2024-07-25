<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tablas;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class TablaController extends Controller
{
   
    public function index()
    {
        return view('admin.table.index', ['data' => Tablas::all()]);
    }

 
  
    public function store(Request $request)
    {
        Tablas::create($request->all());
        return back()->with(['info' => 'TABLA CREADA' , 'color' => 'success']);

    }

  
    public function show($id)
    {
        return view('admin.table.show', ['data' => Tablas::find($id)]);
    }

 
  
    public function update(Request $request, $id)
    {
        Tablas::findOrFail($id)->update($request->all());

        return back()->with(['info' => 'DATOS ACTUALIZADOS' , 'color' => 'success']);
    }

    
    public function destroy($id)
    {
        Tablas::findOrFail($id)->delete($id);

        return back()->with(['info' => 'DATOS ELIMINADOS' , 'color' => 'success']);
    }
}
