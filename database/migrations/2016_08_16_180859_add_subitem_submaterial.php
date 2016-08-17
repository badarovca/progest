<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubitemSubmaterial extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('sub_materials', function($table) {
            $table->integer('sub_item_id')->unsigned();
            $table->foreign('sub_item_id')->references('id')->on('sub_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('sub_materials', function($table) {
            $table->dropForeign('sub_item_id');
        });
    }

}
