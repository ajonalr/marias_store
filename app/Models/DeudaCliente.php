<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeudaCliente extends Model
{
    use HasFactory;

    protected $table = 'deuda_cliente';
    public $guarded = ['salto'];

    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');
    }

}
