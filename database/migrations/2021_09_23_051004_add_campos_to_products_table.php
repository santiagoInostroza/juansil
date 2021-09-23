<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
           $table->tinyInteger('ajuste')->default(0);
           $table->integer('cantAjuste')->default(0);
           $table->integer('totalAjuste')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('ajuste');
            $table->dropColumn('cantAjuste');
            $table->dropColumn('totalAjuste');
        });
    }
}
