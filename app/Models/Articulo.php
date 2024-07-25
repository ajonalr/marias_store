<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articulo extends Model
{
    use SoftDeletes;
    protected $table = 'articulos';
    protected $guarded = [];

    public function categoria()
    {
        return $this->hasOne('App\Model\Categoria', 'id', 'categoria_id');
    }

    public function proveedor()
    {
        return $this->hasOne(Proveedor::class, 'id', 'proveedor_id');
    }
}
