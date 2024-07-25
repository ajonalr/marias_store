<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticulosCatalogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticulosCatalogoController extends Controller
{
   public function index()
   {
       $articulos = ArticulosCatalogo::where('id',1)->first();
           // dd($articulos->imagen);
       return view('admin.catalogo.index', ['articulos' => ArticulosCatalogo::all()]);
   }

   public function show($id)
   {
       return view('admin.catalogo.show', ['articulo' => ArticulosCatalogo::find($id)]);
   }

   public function store(Request $data)
   {
       $articulo =  new ArticulosCatalogo();
       $articulo->nombre = $data->nombre;
       $articulo->descripcion = $data->descripcion;
       $articulo->costo = $data->p_venta;
       $articulo->descuento = $data->descuento;
       if ($data->hasFile('imagen')) {
           $file = $data->file('imagen');
           // $nombre = $file->getClientOriginalName();
           // dd($nombre);
           // $file->move(storage_path() . '/app/public', $nombre);
           $nombre = $file->store('public');
           $articulo->imagen = $nombre;
           // dd($articulo->imagen);
       }
       $articulo->save();
       return back()->with(['info' => 'Articulo Guardado Con Exito', 'color' => 'success']);
   }

   public function update(Request $data)
   {
       $articulo =  ArticulosCatalogo::find($data->id);
       $articulo->nombre = $data->nombre;
       $articulo->descripcion = $data->descripcion;
       $articulo->costo = $data->p_venta;
       $articulo->descuento = $data->descuento;
       if ($data->hasFile('imagen_new')) {
           // eliminamos la imgane 
           if (Storage::exists($articulo->imagen)) {  
               Storage::delete($articulo->imagen); 
               // dd('Se Elimino');
           }
           // asignamos nuevos valores a la imagen 
           $file = $data->file('imagen_new');
           $nombre = $file->store('public');
           $articulo->imagen = $nombre;
           // dd($articulo->imagen);
       }
       $articulo->save();
       return back()->with(['info' => 'Articulo Actualizado Con Exito', 'color' => 'warning']);
   }

   public function delete($id)
   {
       $articulo =  ArticulosCatalogo::find($id);
       if ($articulo->imagen) {        
           if (Storage::exists($articulo->imagen)) {         
               Storage::delete($articulo->imagen);
               // dd('Se Elimino');
           }
       }
       $articulo->delete();
       return back()->with(['info' => 'Articulo Eliminado Con Exito', 'color' => 'danger']);
   }

   public function catalogo()
   {
       return view('admin.reports.exports.catalogo', ['articulo' => ArticulosCatalogo::all()]);
   }
}
