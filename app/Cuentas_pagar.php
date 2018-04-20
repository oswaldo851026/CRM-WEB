<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuentas_pagar extends Model
{
      protected $table = 'Cuentas_pagar';
    protected $fillable = [
    'id_pagar', //id_cuentas_pagar
    'id_pedido',
    'id_clientes',
    'estatus',
    'monto',
    ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
