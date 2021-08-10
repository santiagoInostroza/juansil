<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movement_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_price_id')->nullable();
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('cantidad');
            $table->integer('cost');
            $table->integer('total_cost');
            $table->date('fecha');
            $table->timestamps();

            $table->foreign('purchase_price_id')->references('id')->on('purchase_prices')->onDelete('cascade');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movement_sales');
    }
}
