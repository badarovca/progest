<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubMaterialsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sub_materials', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('vencimento');
            $table->integer('qtd');
            $table->integer('material_id')->unsigned();
            $table->foreign('material_id')->references('id')->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('sub_materials');
    }

}
