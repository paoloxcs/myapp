<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIsoPartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iso_part', function (Blueprint $table) {
            $table->unsignedInteger('iso_id');
            $table->unsignedInteger('part_id');

            $table->foreign('iso_id')->references('id')->on('isos')->onDelete('cascade');
            $table->foreign('part_id')->references('id')->on('product_parts')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iso_part');
    }
}
