<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Proyecto extends Model
{

  static $rules = [
    'cliente_id' => 'required',
    'nombre' => 'required',
    'descripcion' => 'required',
    'total' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  public $guarded = [];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function cliente()
  {
    return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');
    
  }
}
