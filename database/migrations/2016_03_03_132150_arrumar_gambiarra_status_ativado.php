<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArrumarGambiarraStatusAtivado extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('coordenacaos', function(Blueprint $table) {
            $table->renameColumn('desativado', 'status');
        });
        Schema::table('fornecedors', function (Blueprint $table) {
            $table->renameColumn('desativado', 'status');
        });
        Schema::table('setors', function (Blueprint $table) {
            $table->renameColumn('desativado', 'status');
        });
        Schema::table('sub_items', function (Blueprint $table) {
            $table->renameColumn('desativado', 'status');
        });
        Schema::table('unidades', function (Blueprint $table) {
            $table->renameColumn('desativado', 'status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('coordenacaos', function(Blueprint $table) {
            $table->renameColumn('status', 'desativado');
        });
        Schema::table('fornecedors', function (Blueprint $table) {
            $table->renameColumn('status', 'desativado');
        });
        Schema::table('setors', function (Blueprint $table) {
            $table->renameColumn('status', 'desativado');
        });
        Schema::table('sub_items', function (Blueprint $table) {
            $table->renameColumn('status', 'desativado');
        });
        Schema::table('unidades', function (Blueprint $table) {
            $table->renameColumn('status', 'desativado');
        });
    }

}
