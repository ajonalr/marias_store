<?php

namespace App\Http\Controllers;

use App\Models\Archivos;
use App\Models\FotoArchivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{
    public function index()
    {
        return view('admin.archivo.index', ['data' => Archivos::all()]);
    }

    public function store(Request $request)
    {
        Archivos::create($request->all());
        return back()->with(['info' => 'ARCHIVO / carperta creada', 'color' => 'success']);
    }

    public function delte($id)
    {
        Archivos::findOrFail($id)->delete();
        return back()->with(['info' => 'ARCHIVO / carperta ELIMINADA', 'color' => 'success']);
    }

    public function show($id)
    {
        $fotos = FotoArchivo::where('archivo_id', $id)->get();
        return view('admin.archivo.show', ['data' => Archivos::find($id), 'fotos' => $fotos]);
    }



    // elimina la foto del archivo
    public function deleteFotoToArchivos($id)
    {

        $foto = FotoArchivo::find($id);
        Storage::disk('public')->delete('archivos/' . $foto->foto);
        $foto->delete();
        return back()->with(['info' => 'ARCHIVO ELIMINADO', 'color' => 'success']);
    }

    public function reportes()
    {
        $archivos = Archivos::all();
        return view('admin.archivo.repostes', ['data' => $archivos]);
    }

    // retorna el reporte de las fotos de un archivo por fecha
    public function getFotoToArchivoReport(Request $request)
    {
        $fotos = FotoArchivo::whereBetween('created_at', [$request->inicio, $request->fin])->where('archivo_id', $request->archivo_id)->get();
        return view('admin.reports.archivo.filter', ['data' => $fotos]);
    }

    // GUARDA EL ARCHIVO O FOTO DE UNA CARPETA
    public function setFirma(Request $request)
    {
        if ($request->hasFile('foto')) {
            $ar_foto = new FotoArchivo();
            $file = $request->file('foto');
            $nombre = time() . $file->getClientOriginalName();
            $file->move(storage_path() . '/app/public/archivos', $nombre);
            $ar_foto->foto = $nombre;
            $ar_foto->archivo_id = $request->archivo_id;
            $ar_foto->save();
            return back()->with(['info' => 'archivos asignada', 'color' => 'success']);
        } else {
            return back()->with(['info' => 'archivo no asignada', 'color' => 'danger']);
        }
    }

    public function setFotoMultiple(Request $request)
    {
        $files = $request->file('images');
        if (count($files) >= 1) {
            foreach ($files as $file) {

                $nombre = time() . $file->getClientOriginalName();
                if (Storage::putFileAs('/public/archivos', $file, $nombre)) {
                    # code...
                    $ar_foto = new FotoArchivo();
                    $file->move(storage_path() . '/app/public/archivos', $nombre);
                    $ar_foto->foto = $nombre;
                    $ar_foto->archivo_id = $request->archivo_id;
                    $ar_foto->save();
                }
            }
            return back()->with(['info' => 'archivo asignado con exito', 'color' => 'success']);
        } else {
            return back()->with(['info' => 'archivo no asignados', 'color' => 'danger']);
        }
    }
}
