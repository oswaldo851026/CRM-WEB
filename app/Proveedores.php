<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proveedores extends Model
{
  protected $fillable = [
    'direccion',
    'razon_social',
    'telefono',
    'nombre_contacto',
    'apellido_contacto',
    ];

  

}

