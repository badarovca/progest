<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InclusaoCamposCoordenacao extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('coordenacaos', function (Blueprint $table) {
            $table->string('coordenador');
            $table->string('email');
            $table->string('telefone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('coordenacaos', function(Blueprint $table)
        {
            $table->dropColumn('coordenador');
            $table->dropColumn('email');
            $table->dropColumn('telefone');
        });
    }

}
