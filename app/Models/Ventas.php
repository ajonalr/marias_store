<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'venta_articulos';

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function articulo()
    {
        return $this->hasOne('App\Models\Articulo', 'id', 'articulo_id');
    }

    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');
    }
}
