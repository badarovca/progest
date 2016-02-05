<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationshipUsuarioSetorCoordenacao extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function ($table) {
            $table->foreign('setor_id')->references('id')->on('setors');
            $table->foreign('coordenacao_id')->references('id')->on('coordenacaos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        $table->dropForeign('users_setor_id_foreign');
        $table->dropForeign('users_coordenacao_id_foreign');
    }

}
