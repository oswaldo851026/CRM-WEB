<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Almacen extends Migration
{
 public function up()
    {
        Schema::create('almacen', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_almacen', 250);
            $table->string('descripcion', 250);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('almacen');
    }
}
