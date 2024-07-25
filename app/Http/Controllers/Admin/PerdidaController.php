<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perdida;
use Illuminate\Http\Request;

class PerdidaController extends Controller
{
    public function index()
    {
        $data = Perdida::all();
        return view('admin.perdida.index', compact('data'));
    }
    public function store(Request $request)
    {
        Perdida::create($request->all());
        return back()->with(['info' => 'perida guardado', 'color' => 'success']);
    }
    public function update(Request $request, $id)
    {
        Perdida::find($id)->update($request->all());
        return back()->with(['info' => 'perida guardado', 'color' => 'info']);
    }
    public function show($id)
    {
        $data = Perdida::find($id);
        return view('admin.perida.show', compact('data'));
    }
    public function delete($id)
    {
        $data = Perdida::find($id)->delete();
        return back()->with(['info' => 'perida ELIMINADA', 'color' => 'success']);
    }
}
