<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuentas_cobrar extends Model
{
    protected $fillable = [
    'id_cobrar',
    'id_ordencompra',
    'id_proveedor',
    'estatus',
    'monto',
    ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
