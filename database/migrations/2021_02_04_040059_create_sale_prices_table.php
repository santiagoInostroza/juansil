<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('quantity');
            $table->unsignedDecimal('price');
            $table->unsignedDecimal('total_price');
            $table->unsignedInteger('special_price')->default(0); //0 no // 1 si (para comerciantes)

           // $table->unsignedInteger('sale_type');//1 por unidad, 2 por caja, 3 especial
            

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_prices');
    }
}
