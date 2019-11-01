<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('part_nro', 25);
            $table->longText('dimensions')->nullable();
            $table->unsignedInteger('measurement_id');
            $table->unsignedInteger('product_id');
            $table->string('ruta', 45)->nullable();
            $table->foreign('measurement_id')->references('id')->on('measurements')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_parts');
    }
}
