<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
 

 protected $table = "almacen";
  protected $fillable = [
    'nombre_almacen',
    'descripcion',
    'prioridad_entrada',
    'prioridad_salida',
    'capacidad',
    'tipo_almacen'
    ];


}
