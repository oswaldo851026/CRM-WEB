<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_productos');
            $table->integer('id_materias_primas');
            $table->float('cantidad')->nullable();;
            $table->string('descripcion', 250)->nullable();;
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
        Schema::dropIfExists('bill_materials');
    }
}
