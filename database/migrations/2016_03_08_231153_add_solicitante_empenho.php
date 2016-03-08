<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSolicitanteEmpenho extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('empenhos', function ($table) {
            $table->dropColumn('solicitantes');
            $table->integer('solicitante_id')->unsigned();
            $table->foreign('solicitante_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('empenhos', function ($table) {
            $table->dropForeign('empenhos_solicitante_id_foreign');
            $table->string('solicitantes');
        });
    }

}
