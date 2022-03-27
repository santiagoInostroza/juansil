<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerifyPaymentReceiptToSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
       
        Schema::table('sales', function (Blueprint $table) {
           $table->tinyInteger('verify_payment_receipt')->nullable();
           $table->unsignedBigInteger('verify_payment_receipt_by')->nullable();
           $table->dateTime('verify_payment_receipt_date')->nullable(); //   
           $table->tinyInteger('stage')->default(0); //     / pedido = 1 / en proceso = 2 / completado = 3 /  anulado =4 / pendiente = 5 /
           $table->bigInteger('difference')->nullable(); //   
           $table->double('percentage')->nullable(); //   
           $table->unsignedBigInteger('address_id')->nullable(); //

           $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            
            $table->dropColumn('verify_payment_receipt');
            $table->dropColumn('verify_payment_receipt_by');
            $table->dropColumn('verify_payment_receipt_date');
            $table->dropColumn('stage');
            $table->dropColumn('difference');
            $table->dropColumn('percentage');
            $table->dropColumn('address_id');
            // $table->dropForeign('sales_address_id_foreign');
        });
    }
}
