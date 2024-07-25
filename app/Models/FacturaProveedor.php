<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class FacturaProveedor extends Model
{
    protected $table = 'facturas_proveedor';
    public $guarded = [];

    public function proveedor()
    {
        return $this->hasOne('App\Models\Proveedor', 'id', 'proveedor_id');
    }
}
