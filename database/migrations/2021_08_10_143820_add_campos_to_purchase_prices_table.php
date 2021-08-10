<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToPurchasePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_prices', function (Blueprint $table) {
            $table->unsignedBigInteger('purchase_id')->nullable();
            $table->integer('cantidad')->nullable();
            $table->date('fecha')->nullable();

            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_prices', function (Blueprint $table) {
            $table->dropForeign('purchase_prices_purchase_id_foreign');
            $table->dropColumn('purchase_id');
            $table->dropColumn('fecha');
            $table->dropColumn('cantidad');
        });
    }
}
