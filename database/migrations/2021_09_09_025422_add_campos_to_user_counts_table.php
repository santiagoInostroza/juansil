<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToUserCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_counts', function (Blueprint $table) {
            
            $table->string('ip2')->nullable();
            $table->string('country')->nullable();
            $table->string('countryCode')->nullable();
            $table->string('countryAbbreviation')->nullable();
            $table->string('countryName')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_counts', function (Blueprint $table) {
            $table->dropColumn('ip2');
            $table->dropColumn('country');
            $table->dropColumn('countryCode');
            $table->dropColumn('countryAbbreviation');
            $table->dropColumn('countryName');
        });
    }
}
