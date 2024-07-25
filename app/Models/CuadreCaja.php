<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuadreCaja extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $table = 'cuadresdecajas';
    
}
