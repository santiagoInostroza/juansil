<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserCreateToSalesTable extends Migration{
    
    public function up(){
        Schema::table('sales', function (Blueprint $table) {
            $table->unsignedBigInteger('user_created')->nullable();
            $table->unsignedBigInteger('user_modified')->nullable();
        });
    }

    public function down(){
        Schema::table('sales', function (Blueprint $table) {
            
            $table->dropColumn('user_created');
            $table->dropColumn('user_modified');
            
        });
    }
}
