<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbonoProyecto extends Model
{
    use HasFactory;

    public $guarded = [];

    public function proyecto()
    {
        return $this->hasOne('App\Model\Proyecto', 'id', 'proyect_id');
    }
}
