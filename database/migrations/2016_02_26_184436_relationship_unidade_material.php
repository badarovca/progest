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
            Schema::table('users', function ($table) {
            $table->dropColumn('unidade_id');
        });
	}

}
