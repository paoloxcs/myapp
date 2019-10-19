<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCompatibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_compatibilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            // Nota: los valores de los campos de static y dynamic varian entre:
            $table->string('type_field',20); 
            $table->boolean('value_field',1)->comment('1 = Recomendado, 2 = Posible, 3 = No adecuado');

            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            
            $table->unsignedInteger('compatibility_id');
            $table->foreign('compatibility_id')->references('id')->on('compatibilities')->onDelete('cascade');
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
        Schema::dropIfExists('product_compatibilities');
    }
}
