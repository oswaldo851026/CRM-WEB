<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordenes_compra extends Model
{
    protected $fillable = [
       'id_proveedor',
    'id_usuario',
    'asunto',
    'estatus',
    'comentarios',
    'direccion_envio',
    'subtotal',
    'iva',
    
    'total',
    'metodo_pago',
    'fecha_entrega'
 
  ];
}
