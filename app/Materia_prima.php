<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia_prima extends Model{

/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Materia_primas';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['codigo','nombre', 'descripcion','id_proveedor', 'costo', 'comentarios','id_categoria','medidas','existencias'];

}
