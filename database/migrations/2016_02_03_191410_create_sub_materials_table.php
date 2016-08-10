<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubMaterialsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sub_materials', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('vencimento');
            $table->double('vl_total', 8, 2);
            $table->integer('qtd_estoque');
            $table->integer('qtd_solicitada');
            $table->integer('material_id')->unsigned();
            $table->foreign('material_id')->references('id')->on('materials');
            $table->integer('empenho_id')->unsigned();
            $table->foreign('empenho_id')->references('id')->on('empenhos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('sub_materials');
    }

}
