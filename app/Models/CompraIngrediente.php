<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraIngrediente extends Model
{
    use HasFactory;

    public $guarded = [];


    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }


    public function ingrediente()
    {
        return $this->hasOne('App\Models\Ingrediente', 'id', 'ingrediente_id');
    }

}
