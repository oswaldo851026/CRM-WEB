<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriaPrimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_primas', function (Blueprint $table) {
              $table->increments('id');

            $table->string("codigo", 250);
            $table->string('nombre', 250);
            $table->string('descripcion', 250);
            $table->integer('id_proveedor')->nullable();
            $table->float('costo');
            $table->longText('comentarios')->nullable();
           
            $table->string('medida', 250)->nullable();
            $table->integer('existencias')->nullable();

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
        Schema::dropIfExists('materia_primas');
    }
}
