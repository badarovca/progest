<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSubitemMaterial extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('materials', function($table) {
            $table->dropForeign('materials_sub_item_id_foreign');
            $table->dropColumn('sub_item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('materials', function($table) {
            $table->integer('sub_item_id')->unsigned();
            $table->foreign('sub_item_id')->references('id')->on('sub_items');
        });
    }

}
