<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("codigo", 100);
            $table->string('nombre', 250);
            $table->string('descripcion', 250);
            $table->integer('id_proveedor')->nullable();
            $table->float('precio');
            $table->integer('existencias')->nullable();;
            $table->string('codigo_barras', 250)->nullable();
            $table->longText('comentarios')->nullable();
            $table->string('imagen_principal', 250)->nullable();
            $table->string('tipo_producto', 250)->nullable();
            $table->integer("id_categoria")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
