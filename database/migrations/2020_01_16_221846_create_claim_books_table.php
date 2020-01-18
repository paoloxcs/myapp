<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('book_number', 20)->nullable(); // Codigo de libro de reclamaciones
            $table->string('name', 100); // Nombre del cliente
            $table->string('last_name', 100); // Apellidos del cliente
            $table->string('nrs', 100)->nullable(); // Razón Social
            $table->string('phone_number'); // Numero telefònico del cliente
            $table->string('doc_number', 11); // Numero de documento del cliente
            $table->string('email', 70); // Correo del cliente
            $table->text('address')->nullable(); // Direcciòn del cliente
            $table->string('reason', 255); // Razon del reclamo
            $table->longText('detail')->nullable();  // Dettale de reclamo
            $table->longText('request_client')->nullable(); // Solicitud o pedido del cliente.
            $table->timestamps(); // Fecha de creacion

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claim_books');
    }
}
