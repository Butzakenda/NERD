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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id('IdContrato');
            $table->unsignedBigInteger('IdColaborador')->nullable();
            $table->unsignedBigInteger('IdAdministrador')->nullable();
            $table->unsignedBigInteger('IdSeguimientoProductos')->nullable();
            $table->string('HojaVida');
            $table->string('SeguroMedico');
            $table->string('Documento');
            $table->string('Contrato')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
