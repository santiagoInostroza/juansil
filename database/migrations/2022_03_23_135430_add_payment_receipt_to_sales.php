<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentReceiptToSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->string('payment_receipt_url')->nullable();
            $table->dateTime('payment_receipt_date')->nullable();
            $table->unsignedBigInteger('payment_receipt_by')->nullable();
            // $table->foreign('payment_receipt_by')->references('id')->on('users')->onDelete('cascade');
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
            $table->dropColumn('payment_receipt_url');
            $table->dropColumn('payment_receipt_date');
            $table->dropColumn('payment_receipt_by');
        });
    }
}
