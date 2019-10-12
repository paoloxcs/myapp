<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCompatibilitiesDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_compatibilities_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            // Nota: los valores de los campos de static y dynamic varian entre:
            $table->char('static',1)->comment('1 = Recomendado, 2 = Posible, 3 = No adecuado'); 
            $table->char('dynamic',1)->comment('1 = Recomendado, 2 = Posible, 3 = No adecuado');

            $table->unsignedInteger('compatibility_id');
            $table->foreign('compatibility_id')->references('id')->on('product_compatibilities')->onDelete('cascade');
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
        Schema::dropIfExists('product_compatibilities_detail');
    }
}
