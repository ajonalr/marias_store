<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbonoProveedor extends Model
{
    protected $table = 'abonos_proveedores';
    public $guarded = [];

    public function proveedor()
    {
        return $this->hasOne('App\Models\Proveedor', 'id', 'proveedor_id');
    }
}
