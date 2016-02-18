<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('entradas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('num_nf');
            $table->integer('empenho_id')->unsigned();
            $table->foreign('empenho_id')->references('id')->on('empenhos')->onDelete('cascade');
            $table->string('natureza_op');
            $table->string('cod_chave');
            $table->double('vl_total', 10, 2);
            $table->date('dt_recebimento');
            $table->date('dt_emissao');
            $table->timestamps();
        });
        
        Schema::create('entrada_material', function(Blueprint $table) {
            $table->integer('entrada_id')->unsigned()->index();
            $table->foreign('entrada_id')->references('id')->on('entradas')->onDelete('cascade');
            $table->integer('material_id')->unsigned()->index();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->integer('quant');
            $table->double('vl_total', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('entrada_material');
        Schema::drop('entradas');
    }

}
