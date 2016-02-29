<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationshipSetorCoordenacao extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('setors', function ($table) {
            $table->integer('coordenacao_id')->unsigned();
            $table->foreign('coordenacao_id')->references('id')->on('coordenacaos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('setors', function ($table) {
            $table->dropForeign('setors_coordenacao_id_foreign');
            //$table->dropColumn('coordenacao_id');
        });
    }

}
