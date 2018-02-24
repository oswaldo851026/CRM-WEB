<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
   


protected $fillable = [
    'id_cliente',
    'id_usuario',
    'asunto',
    'estatus',
    'comentarios',
    'direccion_envio'
    'subotal',
    'iva',
    'descuento',
    'total'
 
  ];







}
