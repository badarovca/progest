<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InclusaoCamposAtivado extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('coordenacaos', function (Blueprint $table) {
            $table->boolean('desativado');
        });
        Schema::table('fornecedors', function (Blueprint $table) {
            $table->boolean('desativado');
        });
        Schema::table('setors', function (Blueprint $table) {
            $table->boolean('desativado');
        });
        Schema::table('sub_items', function (Blueprint $table) {
            $table->boolean('desativado');
        });
        Schema::table('unidades', function (Blueprint $table) {
            $table->boolean('desativado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('coordenacaos', function(Blueprint $table) {
            $table->dropColumn('desativado');
        });
        Schema::table('fornecedors', function (Blueprint $table) {
            $table->dropColumn('desativado');
        });
        Schema::table('setors', function (Blueprint $table) {
            $table->dropColumn('desativado');
        });
        Schema::table('sub_items', function (Blueprint $table) {
            $table->dropColumn('desativado');
        });
        Schema::table('unidades', function (Blueprint $table) {
            $table->dropColumn('desativado');
        });
    }
}
