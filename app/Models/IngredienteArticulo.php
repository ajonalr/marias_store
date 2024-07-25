<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredienteArticulo extends Model
{
    use HasFactory;

    public function articulo()
    {
        return $this->hasOne(Articulo::class, 'id', 'articulo_id');
    }

    public function ingrediente()
    {
        return $this->hasOne(Ingrediente::class, 'id', 'ingrediante_id');
    }
}
