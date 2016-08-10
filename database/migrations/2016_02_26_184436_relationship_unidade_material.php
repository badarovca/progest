<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationshipUnidadeMaterial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::table('materials', function ($table) {
                $table->integer('unidade_id')->unsigned();
                $table->foreign('unidade_id')->references('id')->on('unidades');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::table('materials', function ($table) {
                $table->dropForeign('materials_unidade_id_foreign');
                //$table->dropColumn('unidade_id');
        });
	}

}
