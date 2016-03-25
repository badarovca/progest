<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaidasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('saidas', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('responsavel_id')->unsigned();
            $table->foreign('responsavel_id')->references('id')->on('users');
            $table->integer('solicitante_id')->unsigned();
            $table->foreign('solicitante_id')->references('id')->on('users');
            $table->string('obs');
            $table->timestamps();
        });
        
        Schema::create('saida_sub_material', function(Blueprint $table) {
            $table->integer('saida_id')->unsigned()->index();
            $table->foreign('saida_id')->references('id')->on('saidas');
            $table->integer('sub_material_id')->unsigned()->index();
            $table->foreign('sub_material_id')->references('id')->on('sub_materials');
            $table->integer('quant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('saida_material');
        Schema::drop('saidas');
    }

}
