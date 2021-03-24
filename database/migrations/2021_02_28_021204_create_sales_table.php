<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->bigInteger('total');
            $table->date('date');
            $table->integer('payment_amount')->nullable();
            $table->integer('payment_status'); // 1 pendiente  2 abonado  3 pagado
            $table->integer('pending_amount')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->integer('delivery')->default(0); // 0 no, 1 si
            $table->date('delivery_date')->nullable();
            $table->dateTime('date_delivered')->nullable();
            $table->integer('delivery_stage')->nullable();// etapa de entrega  0= por entregar\n1= entregado
            $table->text('comments')->nullable();// etapa de entrega  0= por entregar\n1= entregado
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
