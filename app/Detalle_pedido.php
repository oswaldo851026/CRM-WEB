<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_pedido extends Model
{
    
protected $fillable = [
    'id_pedido',
    'id_producto',
    'nombre_producto',
    'descripcion_producto',
    'cantidad_producto',
    'precio_producto',
    'importe'
  ];



}
