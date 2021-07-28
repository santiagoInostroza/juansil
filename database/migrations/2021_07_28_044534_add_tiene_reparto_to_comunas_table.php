<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTieneRepartoToComunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comunas', function (Blueprint $table) {
            $table->integer('tiene_reparto')->default(0);
            $table->integer('valor_rebajado')->nullable();
            $table->text('dias_rebajados')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comunas', function (Blueprint $table) {
            $table->dropColumn('tiene_reparto');
            $table->dropColumn('valor_rebajado');
            $table->dropColumn('dias_rebajados');
        });
    }
}
