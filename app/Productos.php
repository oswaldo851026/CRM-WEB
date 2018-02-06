<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
  protected $fillable = [
    'codigo',
    'nombre',
    'descripcion',
    'id_proveedor',
    'precio',
    'existencias',
    'codigo_barras',
    'comentarios',
    'imagen_principal',
    'id_categoria',
 
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
 public function categorias()
  {
    return $this->belongsTo('App\Categorias');
  }
  public function proveedores()
  {
    return $this->belongsTo('App\Proveedores');
  }
    
    





}
