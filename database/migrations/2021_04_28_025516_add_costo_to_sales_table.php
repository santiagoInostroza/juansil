<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCostoToSalesTable extends Migration{

    public function up(){
        Schema::table('sales', function (Blueprint $table) {
            $table->integer('total_cost')->nullable();
            // $table->integer('etapa')->default(0); //  creando = 0 / creada = 1
           
        });
    }
    
    public function down(){
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('total_cost');
        });
    }
}
