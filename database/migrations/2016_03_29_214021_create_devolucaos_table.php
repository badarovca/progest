<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevolucaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('devolucaos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('saida_id')->unsigned();
            $table->foreign('saida_id')->references('id')->on('saidas');
            $table->timestamps();
        });

        Schema::create('devolucao_sub_material', function(Blueprint $table) {
            $table->integer('devolucao_id')->unsigned()->index();
            $table->foreign('devolucao_id')->references('id')->on('devolucaos')->onDelete('cascade');
            $table->integer('sub_material_id')->unsigned()->index();
            $table->foreign('sub_material_id')->references('id')->on('sub_materials')->onDelete('cascade');
            $table->integer('quant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('devolucao_sub_material');
        Schema::drop('devolucaos');
    }

}
