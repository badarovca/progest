<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstoquesMateriais extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('materials', function(Blueprint $table) {
            $table->dropColumn('qtd');
            $table->dropColumn('vl_total');
            $table->dropColumn('vl_un');
            $table->string('qtd_1');
            $table->string('qtd_2');
            $table->string('qtd_3');
            $table->string('qtd_4');
            $table->boolean('disponivel');
            $table->dropColumn('subitem_id');
            $table->integer('sub_item_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('materials', function(Blueprint $table) {
            $table->string('qtd');
            $table->string('vl_un');
            $table->string('vl_total');
            $table->dropColumn('qtd_1');
            $table->dropColumn('qtd_2');
            $table->dropColumn('qtd_3');
            $table->dropColumn('qtd_4');
            $table->dropColumn('disponivel');
            $table->dropColumn('sub_item_id')->unsigned();
            $table->integer('subitem_id')->unsigned();
        });
    }

}
