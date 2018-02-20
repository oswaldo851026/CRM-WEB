<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_cliente');
            $table->integer('id_usuario');
            $table->string('asunto', 250);
             $table->string('estatus');
            $table->longtext('descripcion')->nulleable();
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
        Schema::dropIfExists('pedidos');
    }
}
