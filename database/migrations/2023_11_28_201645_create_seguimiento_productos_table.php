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
        Schema::create('SeguimientoProductos', function (Blueprint $table) {
            $table->id('IdSeguimientoProductos');
            $table->unsignedBigInteger('IdCliente');
            $table->unsignedBigInteger('IdAdministrador');
            $table->unsignedBigInteger('IdSolicitud');
            $table->unsignedBigInteger('IdColaborador')->nullable();
            $table->string('CopiaRegistro');
            $table->string('PeticionRevision');
            $table->string('SolicitudAlianza');
            $table->date('FechaMatricula');
            $table->string('AvalRevision')->nullable();
            $table->date('FechaRevision')->nullable();
            $table->string('ProductoPatentado')->nullable();
            $table->date('FechaHoraInscripcion')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('SeguimientoProductos');
    }
};
