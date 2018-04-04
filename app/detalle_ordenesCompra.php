<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detalle_ordenesCompra extends Model
{
	protected $fillable = [
     'id_ordenCompra',
    'id_producto',
    'nombre_producto',
    'descripcion_producto',
    'cantidad_producto',
    'precio_producto',
    'importe'
  ];
}
