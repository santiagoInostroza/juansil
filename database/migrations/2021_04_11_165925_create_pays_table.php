<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysTable extends Migration{

    public function up(){
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->integer('total');
            $table->date('fecha');
            $table->integer('user_created');
            $table->integer('customer_id');
            $table->timestamps();
        });
    }
    
    
    public function down(){
        Schema::dropIfExists('pays');
    }
}
