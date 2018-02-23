<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model

    {
  protected $fillable = [
    'nombre',
    'apellidos',
    'razon_social',
    'descuento',
    'direccion',
    'telefono'
 
  ];

     public function user()
  {
    return $this->belongsTo('App\User');
  }
}
