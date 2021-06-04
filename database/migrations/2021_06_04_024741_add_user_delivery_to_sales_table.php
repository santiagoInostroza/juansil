<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserDeliveryToSalesTable extends Migration{

    public function up(){
        Schema::table('sales', function (Blueprint $table) {
            $table->unsignedBigInteger('delivered_user')->nullable();
            $table->integer('delivery_value')->nullable();
        });
    }
    

    public function down(){
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('delivered_user');
            $table->dropColumn('delivery_value');
        });
    }
}
