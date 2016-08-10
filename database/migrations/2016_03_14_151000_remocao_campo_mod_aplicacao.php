<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemocaoCampoModAplicacao extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('empenhos', function($table) {
            $table->dropColumn('mod_aplicacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('empenhos', function(Blueprint $table) {
        $table->integer('mod_aplicacao');
        });
    }

}
