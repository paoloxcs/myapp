<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompatibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compatibilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('level'); // Determina en nivel | 1 = parent 2 = child
            $table->integer('parent_id')->index(); // Contiene id de child | si es parent sera 0
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
        Schema::dropIfExists('compatibilities');
    }
}
