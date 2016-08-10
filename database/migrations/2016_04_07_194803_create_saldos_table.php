<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaldosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('saldos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('sub_item_id')->unsigned();
            $table->foreign('sub_item_id')->references('id')->on('sub_items');
            $table->string('mes');
            $table->string('ano');
            $table->string('valor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('saldos');
    }

}
