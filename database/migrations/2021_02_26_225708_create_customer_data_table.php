<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cantidad_compras')->nullable();
            $table->unsignedBigInteger('total_compras')->nullable();
            $table->unsignedBigInteger('monto_deuda')->nullable();
            $table->unsignedBigInteger('total_credito')->nullable();
            $table->unsignedBigInteger('credito_utilizado')->nullable();
            $table->date('fecha_ultima_compra')->nullable();
            $table->unsignedBigInteger('total_ultima_compra')->nullable();
            $table->unsignedBigInteger('id_ultima_compra')->nullable();
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
        Schema::dropIfExists('customer_data');
    }
}
