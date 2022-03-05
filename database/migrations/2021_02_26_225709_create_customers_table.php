<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('direccion')->nullable();
            $table->string('calle')->nullable();
            $table->string('numero')->nullable();
            $table->string('block')->nullable();
            $table->string('depto')->nullable();
            $table->string('comuna')->nullable();
            $table->text('place_id')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('comentario')->nullable();
            $table->unsignedBigInteger('customer_data_id')->nullable();
            $table->foreign('customer_data_id')->references('id')->on('customer_data')->onDelete('cascade');
            $table->timestamps();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
