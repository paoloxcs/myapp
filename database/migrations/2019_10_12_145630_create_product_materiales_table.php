<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('options')->nullable();
            $table->string('name',60)->nullable();
            $table->string('type',45)->nullable();
            $table->string('colour',60)->nullable();
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');


            //Campos opcionales a pedido del cliente
            $table->string('custom1', 255)->nullable();
            $table->string('custom2', 255)->nullable();
            $table->string('custom3', 255)->nullable();

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
        Schema::dropIfExists('product_materials');
    }
}
