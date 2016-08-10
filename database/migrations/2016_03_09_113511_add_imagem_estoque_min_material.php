<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImagemEstoqueMinMaterial extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('materials', function ($table) {
            $table->integer('qtd_min');
            $table->string('imagem');
            $table->date('vencimento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('materials', function ($table) {
            $table->dropColumn('qtd_min');
            $table->dropColumn('imagem');
            $table->dropColumn('vencimento');
        });
    }

}
