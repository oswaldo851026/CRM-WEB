<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenesComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_compras', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_proveedor');
            $table->integer('id_usuario');
            $table->string('asunto', 250);
            $table->string('estatus', 250);
            $table->longtext('descripcion', 250)->nulleable();
            $table->float('subotal')->nulleable();
            $table->float('iva')->nulleable();
            $table->float('total')->nulleable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes_compras');
    }
}
