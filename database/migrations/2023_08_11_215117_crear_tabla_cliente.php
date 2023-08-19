<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('IdCliente');
            $table->unsignedBigInteger('IdDepartamento');
            $table->unsignedBigInteger('IdCiudad');
            $table->string('Documento', 20);
            $table->string('Nombres', 50);
            $table->string('Apellidos', 50);
            $table->string('CorreoELectronico', 50);
            $table->string('Telefono', 20);
            $table->string('SolicitudAlianza',100)->nullable();
            $table->date('FechaNacimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('clientes');
    }
};
