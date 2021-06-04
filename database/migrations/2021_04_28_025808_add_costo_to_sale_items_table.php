<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCostoToSaleItemsTable extends Migration{
    public function up(){
        Schema::table('sale_items', function (Blueprint $table) {
            $table->integer('costo')->nullable();
        });
    }

    
    public function down(){
        Schema::table('sale_items', function (Blueprint $table) {
            $table->dropColumn('costo');
        });
    }
}
