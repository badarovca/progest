<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsEmpenho extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('empenhos', function(Blueprint $table) {
            $table->string('numero', 15);
            $table->string('tipo', 10);
            $table->integer('cat_despesa');
            $table->integer('mod_aplicacao');
            $table->integer('el_consumo');
            $table->string('mod_licitacao');
            $table->string('num_processo', 17);
            $table->string('solicitantes');
            $table->integer('fornecedor_id')->unsigned();
        });

        Schema::create('empenho_material', function(Blueprint $table) {
            $table->integer('empenho_id')->unsigned()->index();
            $table->foreign('empenho_id')->references('id')->on('empenhos')->onDelete('cascade');
            $table->integer('material_id')->unsigned()->index();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('empenhos', function(Blueprint $table) {
            $table->dropColumn('numero');
            $table->dropColumn('tipo');
            $table->dropColumn('cat_despesa');
            $table->dropColumn('mod_aplicacao');
            $table->dropColumn('el_consumo');
            $table->dropColumn('mod_licitacao');
            $table->dropColumn('num_processo');
            $table->dropColumn('solicitantes');
            $table->dropColumn('fornecedor_id');
        });

        Schema::drop('empenho_material');
    }

}
