<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_pedido');
            $table->integer('id_producto');
            $table->string('nombre_producto', 250);
            $table->string('descripcion_producto', 250);
            $table->string('cantidad_producto', 250);
            $table->float('precio_producto');
            $table->float('importe');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_pedidos');
    }
}
