<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('materials', function(Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('codigo');
            $table->string('descricao', 300);
            $table->string('marca', 100);
            $table->integer('qtd');
            $table->double('vl_un', 10, 2);
            $table->double('vl_total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('materials');
    }

}
