<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCampos3ToUserCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_counts', function (Blueprint $table) {
            $table->text('agent')->nullable();
            $table->string('nameNavigator')->nullable();
            $table->string('version')->nullable();
            $table->string('plattform')->nullable();
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
            $table->dropColumn('agent');
            $table->dropColumn('nameNavigator');
            $table->dropColumn('version');
            $table->dropColumn('plattform');
        });
    }
}
