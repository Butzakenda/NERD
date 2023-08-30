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
        Schema::create('Solicitudes', function (Blueprint $table) {
            $table->id('IdSolicitud');
            $table->unsignedBigInteger('IdCliente');
            $table->string('Nombre', 100);
            $table->string('Tipo', 100);
            $table->string('Estado')->default('En revisión');
            $table->string('Descripcion', 500);
            $table->date('Fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('Solicitudes');
    }
};
